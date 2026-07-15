<?php 
	require("includes/connection.php");
	require("includes/function.php");
	require("language/language.php");

	$setting_qry="SELECT omdb_api_key FROM tbl_settings where id='1'";
    $setting_result=mysqli_query($mysqli,$setting_qry);
    $settings_details=mysqli_fetch_assoc($setting_result);

    $omdb_api_key=$settings_details['omdb_api_key'];

    function is_genre_info($name)
	{ 
		global $mysqli;   

		$sql="SELECT * FROM tbl_genres WHERE genre_name LIKE '%$name%'";
		 
		$res=mysqli_query($mysqli,$sql);

		if($res->num_rows > 0){
			$row=mysqli_fetch_assoc($res);
			return $row['gid'];
		}
		else{
			return 0;
		}
	}

	function is_language_info($name)
	{ 
		global $mysqli;   

		$sql="SELECT * FROM tbl_language WHERE language_name LIKE '%$name%'";
		 
		$res=mysqli_query($mysqli,$sql);

		if($res->num_rows > 0){
			$row=mysqli_fetch_assoc($res);
			return $row['id'];
		}
		else{
			return 0;
		}
	}

	$response=array();

	switch ($_POST['action']) {

		case 'getEpisodeDetails' :
		{
			$string= $_POST['id'];

	        preg_match_all("/tt\\d{7,8}/", $string, $ids);

	        if(isset($ids[0][0]))
	        {   
	            $search_by='i';
	            $imbd_id_title=$ids[0][0];
	        }
	        else
	        {   
	            $search_by='t';
	            $imbd_id_title=str_replace(' ', '+', $string);
	        }
	        //exit;

	        $type= 'episode';

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_URL, 'http://www.omdbapi.com/?'.$search_by.'='.$imbd_id_title.'&apikey='.$omdb_api_key.'&plot=full&type='.$type.'');
	        $result = curl_exec($ch);
	        curl_close($ch);

	        $obj = json_decode($result);

	        if(isset($obj->Response) && $obj->Response=="True")
	        {   

	            $response['status']    = '1';
	            $response['message']    = 'Data imported successfully.';
	            $response['class']    = 'success';

	            $response['title']          = $obj->Title;
	            
	            $image_path=$obj->Poster;
	            $response['thumbnail'] = $image_path;

	            $get_file_name = parse_url($image_path, PHP_URL_PATH);

	            // extracted basename
	            $response['thumbnail_name']  = basename($get_file_name);

	        }
	        else
	        {
	            $response['status']    = '0';
	            $response['message']    = $obj->Error;
	            $response['class']    = 'error';
	        }

	        echo json_encode($response);
	        break;
		}

		case 'getSeriesDetails' :
		{
			$string= $_POST['id'];

	        preg_match_all("/tt\\d{7,8}/", $string, $ids);

	        if(isset($ids[0][0]))
	        {   
	            $search_by='i';
	            $imbd_id_title=$ids[0][0];
	        }
	        else
	        {   
	            $search_by='t';
	            $imbd_id_title=str_replace(' ', '+', $string);
	        }
	        //exit;

	        $type= 'series';

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_URL, 'http://www.omdbapi.com/?'.$search_by.'='.$imbd_id_title.'&apikey='.$omdb_api_key.'&plot=short&type='.$type.'');
	        $result = curl_exec($ch);
	        curl_close($ch);

	        $obj = json_decode($result);

	        // print_r($obj);

	        if(isset($obj->Response) && $obj->Response=="True")
	        {   

	            $response['status']    = '1';
	            $response['message']    = 'Data imported successfully.';
	            $response['class']    = 'success';

	            $response['title']          = $obj->Title;
	            
	            $image_path=$obj->Poster;
	            $response['thumbnail'] = $image_path;

	            $get_file_name = parse_url($image_path, PHP_URL_PATH);

	            // extracted basename
	            $response['thumbnail_name']  = basename($get_file_name);

	            $response['plot']  = $obj->Plot;

	        }
	        else
	        {
	            $response['status']    = '0';
	            $response['message']    = $obj->Error;
	            $response['class']    = 'error';
	        }

	        echo json_encode($response);
	        break;
		}

		case 'getMovieDetails' :
		{
			$string= $_POST['id'];

	        preg_match_all("/tt\\d{7,8}/", $string, $ids);

	        if(isset($ids[0][0]))
	        {   
	            $search_by='i';
	            $imbd_id_title=$ids[0][0];
	        }
	        else
	        {   
	            $search_by='t';
	            $imbd_id_title=str_replace(' ', '+', $string);
	        }
	        //exit;

	        $type= 'movie';

	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_URL, 'http://www.omdbapi.com/?'.$search_by.'='.$imbd_id_title.'&apikey='.$omdb_api_key.'&plot=full&type='.$type.'');
	        $result = curl_exec($ch);
	        curl_close($ch);

	        $obj = json_decode($result);

	        // print_r($obj);

	        if(isset($obj->Response) && $obj->Response=="True")
	        {   

	            $response['status']    = '1';
	            $response['message']    = 'Data imported successfully.';
	            $response['class']    = 'success';

	            $response['title']          = $obj->Title;

	            //Get Lang
	            $lang_list=explode(',', $obj->Language)[0];
	            $response['language'] = is_language_info($lang_list) ? is_language_info($lang_list) : '';   
	            
	            //Get Genre
	            $genre_names = $obj->Genre;

	            foreach(explode(", ",$genre_names) as $gname)
	            { 
	            	if(is_genre_info($gname)){
	            		$genre[]=is_genre_info($gname);
	            	}
	            }

	            $response['genre']=$genre;
	            
	            $image_path=$obj->Poster;
	            $response['thumbnail'] = $image_path;

	            $get_file_name = parse_url($image_path, PHP_URL_PATH);

	            // extracted basename
	            $response['thumbnail_name']  = basename($get_file_name);

	            $response['plot']  = $obj->Plot;

	        }
	        else
	        {
	            $response['status']    = '0';
	            $response['message']    = $obj->Error;
	            $response['class']    = 'error';
	        }

	        echo json_encode($response);
	        break;
		}

		default:
			# code...
			break;

		
	}

?>