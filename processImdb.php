<?php
	require("includes/connection.php");
	require("includes/function.php");
	require("language/language.php");

	// Le as chaves de API. Usa SELECT * para nao quebrar caso a coluna
	// tmdb_api_key ainda nao exista (a migracao a cria no deploy).
	$setting_result = mysqli_query($mysqli, "SELECT * FROM tbl_settings WHERE id='1'");
	$settings_details = mysqli_fetch_assoc($setting_result);

	$omdb_api_key = isset($settings_details['omdb_api_key']) ? $settings_details['omdb_api_key'] : '';
	$tmdb_api_key = isset($settings_details['tmdb_api_key']) ? $settings_details['tmdb_api_key'] : '';

	// Bases de imagem do TMDB
	define('TMDB_POSTER', 'https://image.tmdb.org/t/p/w500');
	define('TMDB_BACKDROP', 'https://image.tmdb.org/t/p/w1280');
	define('TMDB_STILL', 'https://image.tmdb.org/t/p/w780');

	function is_genre_info($name)
	{
		global $mysqli;
		$name = mysqli_real_escape_string($mysqli, $name);
		$sql = "SELECT * FROM tbl_genres WHERE genre_name LIKE '%$name%'";
		$res = mysqli_query($mysqli, $sql);
		if ($res && $res->num_rows > 0) {
			$row = mysqli_fetch_assoc($res);
			return $row['gid'];
		}
		return 0;
	}

	function is_language_info($name)
	{
		global $mysqli;
		$name = mysqli_real_escape_string($mysqli, $name);
		$sql = "SELECT * FROM tbl_language WHERE language_name LIKE '%$name%'";
		$res = mysqli_query($mysqli, $sql);
		if ($res && $res->num_rows > 0) {
			$row = mysqli_fetch_assoc($res);
			return $row['id'];
		}
		return 0;
	}

	// Requisicao GET JSON simples
	function http_get_json($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 25);
		$r = curl_exec($ch);
		curl_close($ch);
		return json_decode($r);
	}

	// Converte o codigo de idioma do TMDB (ex.: "en") em uma lista de nomes
	// candidatos (PT e EN) para casar com a tabela tbl_language do painel,
	// que pode ter os nomes tanto em portugues quanto em ingles.
	function tmdb_lang_candidates($code)
	{
		$map = array(
			'en' => array('Inglês', 'English'),
			'pt' => array('Português', 'Portuguese'),
			'es' => array('Espanhol', 'Spanish', 'Español'),
			'fr' => array('Francês', 'French'),
			'de' => array('Alemão', 'German'),
			'it' => array('Italiano', 'Italian'),
			'ja' => array('Japonês', 'Japanese'),
			'ko' => array('Coreano', 'Korean'),
			'zh' => array('Chinês', 'Chinese', 'Mandarin'),
			'ru' => array('Russo', 'Russian'),
			'hi' => array('Hindi'),
			'ar' => array('Árabe', 'Arabic'),
		);
		return isset($map[$code]) ? $map[$code] : array($code);
	}

	// Resolve o id do idioma no painel a partir do codigo do TMDB, testando
	// cada nome candidato ate encontrar um cadastrado.
	function resolve_language_id($code)
	{
		foreach (tmdb_lang_candidates($code) as $name) {
			$id = is_language_info($name);
			if ($id) {
				return $id;
			}
		}
		return '';
	}

	// Extrai o IMDb ID (ttXXXXXXX) ou devolve o texto para busca por titulo
	function parse_imdb_input($string)
	{
		preg_match_all("/tt\\d{7,8}/", $string, $ids);
		if (isset($ids[0][0])) {
			return array('is_imdb' => true, 'value' => $ids[0][0]);
		}
		return array('is_imdb' => false, 'value' => trim($string));
	}

	$response = array();
	$action = isset($_POST['action']) ? $_POST['action'] : '';
	$input = isset($_POST['id']) ? $_POST['id'] : '';

	// ==========================================================================
	//  Importacao via TMDB (portugues + capa). Retorna null se nao encontrar
	//  ou se nao houver chave TMDB configurada (para cair no fallback OMDb).
	// ==========================================================================
	function tmdb_fetch($kind, $input, $tmdb_api_key)
	{
		if ($tmdb_api_key == '') {
			return null;
		}

		$parsed = parse_imdb_input($input);
		$tmdbId = null;
		$mediaType = ($kind == 'series' || $kind == 'episode') ? 'tv' : 'movie';

		if ($parsed['is_imdb']) {
			$find = http_get_json('https://api.themoviedb.org/3/find/' . $parsed['value'] . '?api_key=' . $tmdb_api_key . '&external_source=imdb_id&language=pt-BR');

			if ($kind == 'episode') {
				if (isset($find->tv_episode_results[0])) {
					return tmdb_episode_from_find($find->tv_episode_results[0]);
				}
				return null;
			}

			$key = ($mediaType == 'tv') ? 'tv_results' : 'movie_results';
			if (isset($find->$key[0]->id)) {
				$tmdbId = $find->$key[0]->id;
			}
		} else {
			$search = http_get_json('https://api.themoviedb.org/3/search/' . $mediaType . '?api_key=' . $tmdb_api_key . '&language=pt-BR&query=' . urlencode($parsed['value']));
			if (isset($search->results[0]->id)) {
				$tmdbId = $search->results[0]->id;
			}
		}

		if (!$tmdbId) {
			return null;
		}

		$details = http_get_json('https://api.themoviedb.org/3/' . $mediaType . '/' . $tmdbId . '?api_key=' . $tmdb_api_key . '&language=pt-BR');
		if (!isset($details->id)) {
			return null;
		}

		$out = array();
		$out['title'] = ($mediaType == 'tv') ? (isset($details->name) ? $details->name : '') : (isset($details->title) ? $details->title : '');

		// Sinopse em PT; se vier vazia, busca em ingles como reserva
		$plot = isset($details->overview) ? trim($details->overview) : '';
		if ($plot == '') {
			$en = http_get_json('https://api.themoviedb.org/3/' . $mediaType . '/' . $tmdbId . '?api_key=' . $tmdb_api_key);
			$plot = isset($en->overview) ? trim($en->overview) : '';
		}
		$out['plot'] = $plot;

		$out['thumbnail'] = (!empty($details->poster_path)) ? TMDB_POSTER . $details->poster_path : '';
		$out['cover'] = (!empty($details->backdrop_path)) ? TMDB_BACKDROP . $details->backdrop_path : '';

		// Genero (TMDB ja devolve nomes em PT quando language=pt-BR)
		$genre = array();
		if (isset($details->genres) && is_array($details->genres)) {
			foreach ($details->genres as $g) {
				$gid = is_genre_info($g->name);
				if ($gid) {
					$genre[] = $gid;
				}
			}
		}
		$out['genre'] = $genre;

		// Idioma (casa com nome em PT ou EN cadastrado no painel)
		$out['language'] = isset($details->original_language) ? resolve_language_id($details->original_language) : '';

		return $out;
	}

	function tmdb_episode_from_find($ep)
	{
		$out = array();
		$out['title'] = isset($ep->name) ? $ep->name : '';
		$out['plot'] = isset($ep->overview) ? trim($ep->overview) : '';
		$out['thumbnail'] = (!empty($ep->still_path)) ? TMDB_STILL . $ep->still_path : '';
		$out['cover'] = '';
		return $out;
	}

	switch ($action) {

		case 'getEpisodeDetails':
		{
			$tmdb = tmdb_fetch('episode', $input, $tmdb_api_key);
			if ($tmdb !== null && $tmdb['title'] != '') {
				$response['status'] = '1';
				$response['message'] = 'Dados importados com sucesso.';
				$response['class'] = 'success';
				$response['title'] = $tmdb['title'];
				$response['plot'] = $tmdb['plot'];
				$response['thumbnail'] = $tmdb['thumbnail'];
				$response['cover'] = $tmdb['cover'];
				$response['thumbnail_name'] = basename(parse_url($tmdb['thumbnail'], PHP_URL_PATH));
				echo json_encode($response);
				break;
			}

			// Fallback OMDb
			$p = parse_imdb_input($input);
			$search_by = $p['is_imdb'] ? 'i' : 't';
			$imbd_id_title = $p['is_imdb'] ? $p['value'] : str_replace(' ', '+', $p['value']);
			$obj = http_get_json('http://www.omdbapi.com/?' . $search_by . '=' . $imbd_id_title . '&apikey=' . $omdb_api_key . '&plot=full&type=episode');

			if (isset($obj->Response) && $obj->Response == "True") {
				$response['status'] = '1';
				$response['message'] = 'Dados importados com sucesso.';
				$response['class'] = 'success';
				$response['title'] = $obj->Title;
				$response['thumbnail'] = $obj->Poster;
				$response['cover'] = '';
				$response['thumbnail_name'] = basename(parse_url($obj->Poster, PHP_URL_PATH));
			} else {
				$response['status'] = '0';
				$response['message'] = isset($obj->Error) ? $obj->Error : 'Nada encontrado.';
				$response['class'] = 'error';
			}
			echo json_encode($response);
			break;
		}

		case 'getSeriesDetails':
		{
			$tmdb = tmdb_fetch('series', $input, $tmdb_api_key);
			if ($tmdb !== null && $tmdb['title'] != '') {
				$response['status'] = '1';
				$response['message'] = 'Dados importados com sucesso.';
				$response['class'] = 'success';
				$response['title'] = $tmdb['title'];
				$response['plot'] = $tmdb['plot'];
				$response['thumbnail'] = $tmdb['thumbnail'];
				$response['cover'] = $tmdb['cover'];
				$response['thumbnail_name'] = basename(parse_url($tmdb['thumbnail'], PHP_URL_PATH));
				echo json_encode($response);
				break;
			}

			// Fallback OMDb
			$p = parse_imdb_input($input);
			$search_by = $p['is_imdb'] ? 'i' : 't';
			$imbd_id_title = $p['is_imdb'] ? $p['value'] : str_replace(' ', '+', $p['value']);
			$obj = http_get_json('http://www.omdbapi.com/?' . $search_by . '=' . $imbd_id_title . '&apikey=' . $omdb_api_key . '&plot=short&type=series');

			if (isset($obj->Response) && $obj->Response == "True") {
				$response['status'] = '1';
				$response['message'] = 'Dados importados com sucesso.';
				$response['class'] = 'success';
				$response['title'] = $obj->Title;
				$response['thumbnail'] = $obj->Poster;
				$response['cover'] = '';
				$response['thumbnail_name'] = basename(parse_url($obj->Poster, PHP_URL_PATH));
				$response['plot'] = $obj->Plot;
			} else {
				$response['status'] = '0';
				$response['message'] = isset($obj->Error) ? $obj->Error : 'Nada encontrado.';
				$response['class'] = 'error';
			}
			echo json_encode($response);
			break;
		}

		case 'getMovieDetails':
		{
			$tmdb = tmdb_fetch('movie', $input, $tmdb_api_key);
			if ($tmdb !== null && $tmdb['title'] != '') {
				$response['status'] = '1';
				$response['message'] = 'Dados importados com sucesso.';
				$response['class'] = 'success';
				$response['title'] = $tmdb['title'];
				$response['language'] = $tmdb['language'];
				$response['genre'] = $tmdb['genre'];
				$response['plot'] = $tmdb['plot'];
				$response['thumbnail'] = $tmdb['thumbnail'];
				$response['cover'] = $tmdb['cover'];
				$response['thumbnail_name'] = basename(parse_url($tmdb['thumbnail'], PHP_URL_PATH));
				echo json_encode($response);
				break;
			}

			// Fallback OMDb
			$p = parse_imdb_input($input);
			$search_by = $p['is_imdb'] ? 'i' : 't';
			$imbd_id_title = $p['is_imdb'] ? $p['value'] : str_replace(' ', '+', $p['value']);
			$obj = http_get_json('http://www.omdbapi.com/?' . $search_by . '=' . $imbd_id_title . '&apikey=' . $omdb_api_key . '&plot=full&type=movie');

			if (isset($obj->Response) && $obj->Response == "True") {
				$response['status'] = '1';
				$response['message'] = 'Dados importados com sucesso.';
				$response['class'] = 'success';
				$response['title'] = $obj->Title;

				$lang_list = explode(',', $obj->Language)[0];
				$response['language'] = is_language_info($lang_list) ? is_language_info($lang_list) : '';

				$genre = array();
				foreach (explode(", ", $obj->Genre) as $gname) {
					if (is_genre_info($gname)) {
						$genre[] = is_genre_info($gname);
					}
				}
				$response['genre'] = $genre;

				$response['thumbnail'] = $obj->Poster;
				$response['cover'] = '';
				$response['thumbnail_name'] = basename(parse_url($obj->Poster, PHP_URL_PATH));
				$response['plot'] = $obj->Plot;
			} else {
				$response['status'] = '0';
				$response['message'] = isset($obj->Error) ? $obj->Error : 'Nada encontrado.';
				$response['class'] = 'error';
			}
			echo json_encode($response);
			break;
		}

		default:
			break;
	}
?>
