<?php 

  include("includes/header.php");
  include("includes/function.php");

  $file_path = getBaseUrl().'api.php';
  $ios_file_path = getBaseUrl().'ios_api.php';

?>
<div class="row">
      <div class="col-sm-12 col-xs-12">
     	 	<div class="card">
		        <div class="card-header">
		          Exemplos de URLs da API
		        </div>
       			    <div class="card-body no-padding">
         		
         			 <pre>
                <code class="html">
                <?php 
                  if(file_exists('api.php'))
                  {
                    echo '<br><b>URL da API Android</b>&nbsp; '.$file_path;    
                  }
                  
                  if(file_exists('ios_api.php'))
                  {
                    echo '<br><b>URL da API iOS</b>&nbsp; '.$ios_file_path;    
                  }
                ?>

                <br><b>Início</b>(Method: get_home)
                <br><b>Canais recentes</b>(Method: get_latest_channels)(Parameter: page)
                <br><b>Filmes recentes</b>(Method: get_latest_movies)(Parameter: page)
                <br><b>Lista de categorias</b>(Method: get_category)(Parameter: page)
                <br><b>Lista de idiomas</b>(Method: get_language)(Parameter: page)
                <br><b>Lista de gêneros</b>(Method: get_genre)(Parameter: page)
                <br><b>Lista de filmes</b>(Method: get_movies)(Parameter: page)
                <br><b>Lista de séries</b>(Method: get_series)(Parameter: page)
                <br><b>Publicações relacionadas</b>(Method: get_related_post)(Parameter: post_id, type(channel, movie, series), cat_id, page)
                <br><b>Lista de episódios</b>(Method: get_episodes)(Parameter: series_id, season_id)
                <br><b>Lista de filmes por ID de idioma</b>(Method: get_movies_by_lang_id)(Parameter: lang_id, page)
                <br><b>Lista de filmes por ID de gênero</b>(Method: get_movies_by_gen_id)(Parameter: genre_id, page) (1,2,3)
                <br><b>Lista de canais por ID de categoria</b>(Method: get_channels_by_cat_id)(Parameter:cat_id, page)
                <br><b>Série (única)</b>(Method: get_single_series)(Parameter: series_id)
                <br><b>Filme (único)</b>(Method: get_single_movie)(Parameter: movie_id)
                <br><b>Canal (único)</b>(Method: get_single_channel)(Parameter: channel_id)
                <br><b>Buscar tudo</b>(Method: search_all)(Parameter:search_text)
                <br><b>Buscar séries</b>(Method: get_search_series)(Parameter:search_text, page)
                <br><b>Buscar filmes</b>(Method: get_search_movies)(Parameter:search_text, page)
                <br><b>Buscar canais</b>(Method: get_search_channels)(Parameter:search_text, page)
                <br><b>Denúncia do usuário</b>(Method: user_report)(Parameter: user_id, post_id, report, type(channel, movie, series))
                <br><b>Comentários do usuário</b>(Method: user_comment)(Parameter: post_id, user_id, comment_text, type(channel, movie, series), is_limit(true, false))
                <br><b>Obter comentários do usuário</b>(Method: get_user_comment)(Parameter: post_id, type(channel, movie, series))
                <br><b>Minha avaliação</b>(Method: my_rating)(Parameter: post_id, user_id, type(channel, movie, series))
                <br><b>Avaliação do usuário</b>(Method: user_rating)(Parameter: post_id, user_id, rate, type(channel, movie, series))
                <br><b>Cadastro de usuário</b>(Method: user_register)(Parameter:name,email,password,phone)
                <br><b>Login do usuário</b>(Method: user_login)(Parameter:email,password)
                <br><b>Perfil do usuário</b>(Method: user_profile)(Parameter:user_id)
                <br><b>Atualizar perfil do usuário</b>(Method: user_profile_update)(Parameter:user_id,name,email,password,phone)
                <br><b>Esqueci a senha</b>(Method: forgot_pass)(Parameter: user_email)
                <br><b>Excluir conta do usuário</b> (Method: delete_user_account)(Parameter: user_id)
                <br><b>Detalhes do app</b>(Method: get_app_details)(Parameter: user_id)
               </code> 
             </pre>
       		
       				</div>
          	</div>
        </div>
</div>
    <br/>
    <div class="clearfix"></div>
        
<?php include("includes/footer.php");?>       
