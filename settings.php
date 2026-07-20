<?php 
      
    $page_title="Configurações";

    include("includes/header.php");
    require("includes/function.php");
    require("language/language.php");

    $qry="SELECT * FROM tbl_settings where id='1'";
    $result=mysqli_query($mysqli,$qry);
    $settings_row=mysqli_fetch_assoc($result);

    if(isset($_POST['submit']))
    {
        if($_FILES['app_logo']['name']!="")
        {
            unlink('images/'.$settings_row['app_logo']);   

            $app_logo=$_FILES['app_logo']['name'];
            $pic1=$_FILES['app_logo']['tmp_name'];

            $tpath1='images/'.$app_logo;      
            copy($pic1,$tpath1);

            $data = array(      
            'email_from'  =>  '-',   
            'app_name'  =>  cleanInput($_POST['app_name']),
            'app_logo'  =>  $app_logo,  
            'app_description'  => addslashes($_POST['app_description']),
            'app_version'  =>  cleanInput($_POST['app_version']),
            'app_author'  =>  cleanInput($_POST['app_author']),
            'app_contact'  =>  cleanInput($_POST['app_contact']),
            'app_email'  =>  cleanInput($_POST['app_email']),   
            'app_website'  =>  cleanInput($_POST['app_website']),
            'app_developed_by'  =>  cleanInput($_POST['app_developed_by'])                    

            );

        }
        else
        {

          $data = array(      
            'email_from'  =>  '-',   
            'app_name'  =>  cleanInput($_POST['app_name']),
            'app_description'  => addslashes($_POST['app_description']),
            'app_version'  =>  cleanInput($_POST['app_version']),
            'app_author'  =>  cleanInput($_POST['app_author']),
            'app_contact'  =>  cleanInput($_POST['app_contact']),
            'app_email'  =>  cleanInput($_POST['app_email']),   
            'app_website'  =>  cleanInput($_POST['app_website']),
            'app_developed_by'  =>  cleanInput($_POST['app_developed_by'])
          );
        } 

        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

        $_SESSION['msg']="11";
        header( "Location:configuracoes");
        exit;

    }
    else if(isset($_POST['admob_submit']))
    {

        $data = array(
            'publisher_id'  =>  cleanInput($_POST['publisher_id']),
            'interstital_ad'  =>  ($_POST['interstital_ad']) ? 'true' : 'false',
            'interstital_ad_type'  =>  cleanInput($_POST['interstital_ad_type']),
            'interstital_ad_id'  =>  cleanInput($_POST['interstital_ad_id']),
            'interstital_facebook_id'  =>  cleanInput($_POST['interstital_facebook_id']),
            'interstital_ad_click'  =>  cleanInput($_POST['interstital_ad_click']),
            'banner_ad'  =>  ($_POST['banner_ad']) ? 'true' : 'false',
            'banner_ad_type'  =>  cleanInput($_POST['banner_ad_type']),
            'banner_ad_id'  =>  cleanInput($_POST['banner_ad_id']),
            'banner_facebook_id'  =>  cleanInput($_POST['banner_facebook_id']),
            'banner_wortise_id' => cleanInput($_POST['banner_wortise_id']),
            'interstitial_wortise_id' => cleanInput($_POST['interstitial_wortise_id']),
            'native_wortise_id' => cleanInput($_POST['native_wortise_id']),
            'wortise_app_id' => cleanInput($_POST['wortise_app_id']) 
        );


        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");


        $_SESSION['msg']="11";
        header( "Location:configuracoes");
        exit;

    }
    else if(isset($_POST['user_agent_submit']))
    {

        $data = array(
            'user_agent' => cleanInput($_POST['user_agent'])
        );

        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

        $_SESSION['msg']="11";
        header( "Location:configuracoes");
        exit;

    }
    else if(isset($_POST['omdb_api_submit']))
    {

        $data = array(
            'omdb_api_key' => cleanInput($_POST['omdb_api_key']),
            'tmdb_api_key' => cleanInput($_POST['tmdb_api_key'])
        );

        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

        $_SESSION['msg']="11";
        header( "Location:configuracoes");
        exit;

    }   
    else if(isset($_POST['api_submit']))
    {

        $data = array(
            'api_latest_limit'  =>  cleanInput($_POST['api_latest_limit']),
            'api_page_limit'  =>  cleanInput($_POST['api_page_limit']),
            'api_cat_order_by'  =>  cleanInput($_POST['api_cat_order_by']),
            'api_cat_post_order_by'  =>  cleanInput($_POST['api_cat_post_order_by']),
            'api_lan_order_by'  =>  cleanInput($_POST['api_lan_order_by']),
            'api_gen_order_by'  =>  cleanInput($_POST['api_gen_order_by'])
        );

        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

        $_SESSION['msg']="11";
        header( "Location:configuracoes");
        exit;
    }
    else if(isset($_POST['app_pri_poly']))
    {

        $data = array(
          'app_privacy_policy'  =>  addslashes(trim($_POST['app_privacy_policy']))
        );

        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

        $_SESSION['msg']="11";
        header( "Location:configuracoes");
        exit;
    }
?>

<style type="text/css">
  .field_lable {
    margin-bottom: 10px;
    margin-top: 10px;
    color: #666;
    padding-left: 15px;
    font-size: 14px;
    line-height: 24px;
  }
</style>
 

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="page_title_block">
        <div class="col-md-5 col-xs-12">
          <div class="page_title"><?=$page_title?></div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="card-body mrg_bottom" style="padding: 0px">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#app_settings" aria-controls="app_settings" role="tab" data-toggle="tab">Aplicativo</a></li>
            <li role="presentation"><a href="#admob_settings" aria-controls="admob_settings" role="tab" data-toggle="tab">Anúncios</a></li>
            <li role="presentation"><a href="#user_agent" aria-controls="user_agent" role="tab" data-toggle="tab">User Agent</a></li>
            <li role="presentation"><a href="#api_settings" aria-controls="api_settings" role="tab" data-toggle="tab">API</a></li>
            <li role="presentation"><a href="#omdb_api" aria-controls="omdb_api" role="tab" data-toggle="tab">OMDb API</a></li>             
            <li role="presentation"><a href="#api_privacy_policy" aria-controls="api_privacy_policy" role="tab" data-toggle="tab">Política de Privacidade</a></li>
        </ul>
        
        <div class="rows">
          <div class="col-md-12">
             <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="app_settings">   
                  <form action="" name="settings_from" method="post" class="form form-horizontal" enctype="multipart/form-data">
                    <div class="section">
                      <div class="section-body">
                        <div class="form-group">
                          <label class="col-md-3 control-label">Nome do App :-</label>
                          <div class="col-md-6">
                            <input type="text" name="app_name" id="app_name" value="<?php echo $settings_row['app_name'];?>" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Logo do App :-</label>
                          <div class="col-md-6">
                            <div class="fileupload_block">
                              <input type="file" name="app_logo" id="fileupload">

                              <?php if($settings_row['app_logo']!="") {?>
                                <div class="fileupload_img"><img type="image" src="images/<?php echo $settings_row['app_logo'];?>" alt="imagem" style="width: 100px;height: 100px;" /></div>
                              <?php } else {?>
                                <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="imagem" /></div>
                              <?php }?>

                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Descrição do App :-</label>
                          <div class="col-md-6">

                            <textarea name="app_description" id="app_description" class="form-control"><?php echo $settings_row['app_description'];?></textarea>

                            <script>CKEDITOR.replace( 'app_description' );</script>
                          </div>
                        </div>
                        <div class="form-group">&nbsp;</div>                 
                        <div class="form-group">
                          <label class="col-md-3 control-label">Versão do App :-</label>
                          <div class="col-md-6">
                            <input type="text" name="app_version" id="app_version" value="<?php echo $settings_row['app_version'];?>" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Autor :-</label>
                          <div class="col-md-6">
                            <input type="text" name="app_author" id="app_author" value="<?php echo $settings_row['app_author'];?>" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Contato :-</label>
                          <div class="col-md-6">
                            <input type="text" name="app_contact" id="app_contact" value="<?php echo $settings_row['app_contact'];?>" class="form-control">
                          </div>
                        </div>     
                        <div class="form-group">
                          <label class="col-md-3 control-label">E-mail :-</label>
                          <div class="col-md-6">
                            <input type="text" name="app_email" id="app_email" value="<?php echo $settings_row['app_email'];?>" class="form-control">
                          </div>
                        </div>                 
                        <div class="form-group">
                          <label class="col-md-3 control-label">Site :-</label>
                          <div class="col-md-6">
                            <input type="text" name="app_website" id="app_website" value="<?php echo $settings_row['app_website'];?>" class="form-control">
                          </div>
                        </div> 
                        <div class="form-group">
                          <label class="col-md-3 control-label">Desenvolvido por :-</label>
                          <div class="col-md-6">
                            <input type="text" name="app_developed_by" id="app_developed_by" value="<?php echo $settings_row['app_developed_by'];?>" class="form-control">
                          </div>
                        </div> 
                        <div class="form-group">
                          <div class="col-md-9 col-md-offset-3">
                            <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

                <!-- admob settings -->
                <div role="tabpanel" class="tab-pane" id="admob_settings">   
                  <form action="" name="admob_settings" method="post" class="form form-horizontal" enctype="multipart/form-data">
                    <div class="section">
                       <div class="section-body">            
                          <div class="row">
                            <div class="form-group">
                              <div class="col-md-12">                
                                <div class="col-md-12">
                                   
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">ID do Publisher :-</label>
                                    <div class="col-md-9">
                                      <input type="text" name="publisher_id" id="publisher_id" value="<?php echo $settings_row['publisher_id'];?>" class="form-control">
                                    </div>
                                    <div style="height:60px;display:inline-block;position:relative"></div>
                                  </div>
                                   
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">ID do App Wortise:-</label>
                                    <div class="col-md-9">
                                      <input type="text" name="wortise_app_id" id="wortise_app_id" value="<?php echo $settings_row['wortise_app_id']; ?>" class="form-control">
                                    </div>
                                  </div>
                             
                                </div>  

                                <div class="col-md-6">
                                  <div class="banner_ads_block">
                                    <div class="banner_ad_item">
                                      <label class="control-label">Anúncios de Banner :-</label>
                                      <div class="row toggle_btn">
                                        <input type="checkbox" id="chk_banner" name="banner_ad" value="true" class="cbx hidden" <?=($settings_row['banner_ad']=='true') ? 'checked=""' : '' ?>>
                                        <label for="chk_banner" class="lbl"></label>
                                      </div>                               
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <p class="field_lable">Tipo de Anúncio de Banner :-</p>
                                        <div class="col-md-12">
                                         <select name="banner_ad_type" id="banner_ad_type" class="select2">
                                            <option value="admob" <?php if($settings_row['banner_ad_type']=='admob'){ echo 'selected="selected"'; }?>>Admob</option>
                                            <option value="facebook" <?php if($settings_row['banner_ad_type']=='facebook'){ echo 'selected="selected"'; }?>>Facebook</option>
                                            <option value="wortise" <?php if($settings_row['banner_ad_type']=='wortise'){ echo 'selected="selected"'; }?>>Wortise</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <p class="field_lable">ID do Banner :-</p>

                                        <div class="col-md-12 banner_ad_id" style="display: none">
                                          <input type="text" name="banner_ad_id" id="banner_ad_id" value="<?php echo $settings_row['banner_ad_id'];?>" class="form-control">
                                        </div>
                                        <div class="col-md-12 banner_facebook_id" style="display: none">
                                          <input type="text" name="banner_facebook_id" id="banner_facebook_id" value="<?php echo $settings_row['banner_facebook_id'];?>" class="form-control">
                                        </div>
                                        <div class="col-md-12 banner_wortise_id" style="display: none">
                                          <input type="text" name="banner_wortise_id" id="banner_wortise_id" value="<?php echo $settings_row['banner_wortise_id']; ?>" class="form-control">
                                        </div>

                                      </div>                    
                                    </div>
                                  </div>  
                                </div>

                                <div class="col-md-6">
                                  <div class="interstital_ads_block">
                                    <div class="interstital_ad_item">
                                      <label class="control-label">Anúncios Intersticiais :-</label>
                                      <div class="row toggle_btn">
                                        <input type="checkbox" id="chk_interstitial" name="interstital_ad" value="true" class="cbx hidden" <?php if($settings_row['interstital_ad']=='true'){?>checked <?php }?>/>
                                        <label for="chk_interstitial" class="lbl"></label>
                                      </div>                  
                                    </div>  
                                    <div class="col-md-12"> 
                                      <div class="form-group">
                                        <p class="field_lable">Tipo de Anúncio Intersticial :-</p>
                                        <div class="col-md-12"> 
                                          <select name="interstital_ad_type" id="interstital_ad_type" class="select2">
                                            <option value="admob" <?php if($settings_row['interstital_ad_type']=='admob'){ echo 'selected="selected"'; }?>>Admob</option>
                                            <option value="facebook" <?php if($settings_row['interstital_ad_type']=='facebook'){ echo 'selected="selected"'; }?>>Facebook</option>
                                            <option value="wortise" <?php if($settings_row['interstital_ad_type']=='wortise'){ echo 'selected="selected"'; }?>>Wortise</option>
                                          </select>                                 
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <p class="field_lable">ID do Anúncio Intersticial :-</p>
                                        <div class="col-md-12 interstital_ad_id" style="display: none">
                                          <input type="text" name="interstital_ad_id" id="interstital_ad_id" value="<?php echo $settings_row['interstital_ad_id'];?>" class="form-control">
                                        </div>

                                        <div class="col-md-12 interstital_facebook_id" style="display: none">
                                          <input type="text" name="interstital_facebook_id" id="interstital_facebook_id" value="<?php echo $settings_row['interstital_facebook_id'];?>" class="form-control">
                                        </div>
                                        <div class="col-md-12 interstitial_wortise_id" style="display: none">
                                          <input type="text" name="interstitial_wortise_id" id="interstitial_wortise_id" value="<?php echo $settings_row['interstitial_wortise_id']; ?>" class="form-control">
                                        </div>

                                      </div>
                                      <div class="form-group">
                                        <p class="field_lable">Cliques Intersticiais :-</p>
                                        <div class="col-md-12">
                                          <input type="text" name="interstital_ad_click" id="interstital_ad_click" value="<?php echo $settings_row['interstital_ad_click'];?>" class="form-control">
                                        </div>
                                      </div>                    
                                    </div>                  
                                  </div>  
                                </div>
                              </div>


                               
                            </div>
                          </div>                        
                          <div class="form-group">
                            <div class="col-md-9">
                            <button type="submit" name="admob_submit" class="btn btn-primary">Salvar</button>
                            </div>
                          </div>
                      </div>
                    </div>
                  </form>
                </div>

                <!-- user settings -->
                <div role="tabpanel" class="tab-pane" id="user_agent">
                  <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                    <div class="section">
                    <div class="section-body">
                      <div class="form-group">
                        <label class="col-md-3 control-label">User Agent :-</label>
                        <div class="col-md-6">
                          <input type="text" name="user_agent" id="user_agent" value="<?php echo $settings_row['user_agent'];?>" placeholder="Informe o user agent comum para os canais" class="form-control">
                        </div>
                      </div>              
                      <div class="form-group">
                      <div class="col-md-9 col-md-offset-3">
                        <button type="submit" name="user_agent_submit" class="btn btn-primary">Salvar</button>
                      </div>
                      </div>
                    </div>
                    </div>
                  </form>
                </div>     

                <!-- user settings -->
                <div role="tabpanel" class="tab-pane" id="omdb_api">
                  <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                    <div class="section">
                    <div class="section-body">
                      <div class="form-group">
                        <label class="col-md-3 control-label">Chave da API OMDb :-
                          <p class="control-label-help">(Se você não sabe, <a href="http://www.omdbapi.com/apikey.aspx" target="_blank">clique aqui</a>)</p>
                        </label>
                        <div class="col-md-6">
                          <input type="text" name="omdb_api_key" id="omdb_api_key" value="<?php echo $settings_row['omdb_api_key'];?>" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Chave da API TMDB :-
                          <p class="control-label-help">Recomendada: traz título/sinopse em português e imagem de capa. (Chave gratuita, <a href="https://www.themoviedb.org/settings/api" target="_blank">clique aqui</a>)</p>
                        </label>
                        <div class="col-md-6">
                          <input type="text" name="tmdb_api_key" id="tmdb_api_key" value="<?php echo isset($settings_row['tmdb_api_key']) ? $settings_row['tmdb_api_key'] : '';?>" class="form-control" placeholder="Deixe vazio para usar apenas o OMDb (inglês, sem capa)">
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-9 col-md-offset-3">
                        <button type="submit" name="omdb_api_submit" class="btn btn-primary">Salvar</button>
                      </div>
                      </div>
                    </div>
                    </div>
                  </form>
                </div>     

              
                <!-- api settings -->
                <div role="tabpanel" class="tab-pane" id="api_settings">   
                    <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                      <input type="hidden" name="length" value="45">
                        <div class="section">
                          <div class="section-body">
                             
                            <div class="form-group">
                              <label class="col-md-3 control-label">Limite de Recentes:-</label>
                              <div class="col-md-6">
                                 
                                <input type="number" name="api_latest_limit" id="api_latest_limit" value="<?php echo $settings_row['api_latest_limit'];?>" class="form-control"> 
                              </div>
                              
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label">Limite por Página:-</label>
                              <div class="col-md-6">
                                 
                                <input type="number" name="api_page_limit" id="api_page_limit" value="<?php echo $settings_row['api_page_limit'];?>" class="form-control"> 
                              </div>
                              
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label">Ordenar Lista de Categorias por:-</label>
                              <div class="col-md-6">
                                 
                                  
                                  <select name="api_cat_order_by" id="api_cat_order_by" class="select2">
                                    <option value="cid" <?php if($settings_row['api_cat_order_by']=='cid'){?>selected<?php }?>>ID</option>
                                    <option value="category_name" <?php if($settings_row['api_cat_order_by']=='category_name'){?>selected<?php }?>>Nome</option>
                        
                                  </select>
                                  
                              </div>
                             
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label">Ordenar Publicações da Categoria por:-</label>
                              <div class="col-md-6">
                                 
                                  
                                  <select name="api_cat_post_order_by" id="api_cat_post_order_by" class="select2">
                                    <option value="id" <?php if($settings_row['api_cat_post_order_by']=='id'){?>selected<?php }?>>ID do Canal</option>
                                    <option value="channel_title" <?php if($settings_row['api_cat_post_order_by']=='channel_title'){?>selected<?php }?>>Nome do Canal</option>
                        
                                  </select>
                                  
                              </div>
                             
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label">Ordenar Lista de Idiomas por:-</label>
                              <div class="col-md-6">
                                 
                                  
                                  <select name="api_lan_order_by" id="api_lan_order_by" class="select2">
                                    <option value="id" <?php if($settings_row['api_lan_order_by']=='id'){?>selected<?php }?>>ID</option>
                                    <option value="language_name" <?php if($settings_row['api_lan_order_by']=='language_name'){?>selected<?php }?>>Nome</option>
                        
                                  </select>
                                  
                              </div>
                             
                            </div>
                            <div class="form-group">
                              <label class="col-md-3 control-label">Ordenar Lista de Gêneros por:-</label>
                              <div class="col-md-6">
                                  <select name="api_gen_order_by" id="api_gen_order_by" class="select2">
                                    <option value="id" <?php if($settings_row['api_gen_order_by']=='id'){?>selected<?php }?>>ID</option>
                                    <option value="genre_name" <?php if($settings_row['api_gen_order_by']=='genre_name'){?>selected<?php }?>>Nome</option>
                                  </select>
                                  
                              </div>
                             
                            </div>
                              
                            <div class="form-group">
                              <div class="col-md-9 col-md-offset-3">
                                <button type="submit" name="api_submit" class="btn btn-primary">Salvar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                   </form>
                </div>

                <!-- app privacy policy -->
                <div role="tabpanel" class="tab-pane" id="api_privacy_policy">   
                  <form action="" name="api_privacy_policy" method="post" class="form form-horizontal" enctype="multipart/form-data">
                    <div class="section">
                      <div class="section-body">
                        <?php 
                        if(file_exists('privacy_policy.php'))
                        {
                          ?>
                          <div class="form-group">
                            <label class="col-md-3 control-label">URL da Política de Privacidade do App :-</label>
                            <div class="col-md-9">
                              <input type="text" readonly class="form-control" value="<?=getBaseUrl().'privacy_policy.php'?>">
                            </div>
                          </div>
                        <?php } ?>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Política de Privacidade do App :-</label>
                          <div class="col-md-9">
                            <textarea name="app_privacy_policy" id="privacy_policy" class="form-control"><?php echo $settings_row['app_privacy_policy'];?></textarea>
                            <script>CKEDITOR.replace( 'privacy_policy' );</script>
                          </div>
                        </div>
                        <br/>
                        <div class="form-group">
                          <div class="col-md-9 col-md-offset-3">
                            <button type="submit" name="app_pri_poly" class="btn btn-primary">Salvar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
     
        
<?php include("includes/footer.php");?>       

<script type="text/javascript">


  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
    document.title = $(this).text()+" | <?=APP_NAME?>";
  });

  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
  }

  /* For android */
  if($("select[name='banner_ad_type']").val()==='facebook'){
    $(".banner_ad_id").hide();
    $(".banner_facebook_id").show();
    $(".banner_wortise_id").hide();
  }
 else if($("select[name='banner_ad_type']").val()==='wortise'){
    $(".banner_ad_id").hide();
    $(".banner_facebook_id").hide();
    $(".banner_wortise_id").show();
  }
  else{
    $(".banner_facebook_id").hide();
    $(".banner_ad_id").show(); 
    $(".banner_wortise_id").hide();
  }

  $("select[name='banner_ad_type']").change(function(e){
    if($(this).val()==='facebook'){
      $(".banner_ad_id").hide();
      $(".banner_facebook_id").show();
      $(".banner_wortise_id").hide();
    }
    else if($(this).val()==='wortise'){
      $(".banner_ad_id").hide();
      $(".banner_facebook_id").hide();
      $(".banner_wortise_id").show();
    }
    else{
      $(".banner_facebook_id").hide();
      $(".banner_ad_id").show(); 
      $(".banner_wortise_id").hide();
    }
  });


  if($("select[name='interstital_ad_type']").val()==='facebook'){
    $(".interstital_ad_id").hide();
    $(".interstital_facebook_id").show();
    $(".interstitial_wortise_id").hide();
  }
  else if($("select[name='interstital_ad_type']").val()==='wortise'){
    $(".interstital_ad_id").hide();
    $(".interstital_facebook_id").hide();
    $(".interstitial_wortise_id").show();
  }
  else{
    $(".interstital_facebook_id").hide();
    $(".interstital_ad_id").show();
    $(".interstitial_wortise_id").hide();
  }

  $("select[name='interstital_ad_type']").change(function(e){

    if($(this).val()==='facebook'){
      $(".interstital_ad_id").hide();
      $(".interstital_facebook_id").show();
      $(".interstitial_wortise_id").hide();
    }
    else if($(this).val()==='wortise'){
      $(".interstital_ad_id").hide();
      $(".interstital_facebook_id").hide();
      $(".interstitial_wortise_id").show();
    }
    else{
      $(".interstital_facebook_id").hide();
      $(".interstital_ad_id").show(); 
      $(".interstitial_wortise_id").hide();
    }
  });

  /* End */
 

</script>