<?php 
  $page_title='Adicionar Canal';

  $current_page="channel";
  $active_page="channel";

  include("includes/header.php");
	require("includes/function.php");
	require("language/language.php");

	require_once("thumbnail_images.class.php");
	
	
	//Get all Category 
	$qry="SELECT * FROM tbl_category";
	$result=mysqli_query($mysqli,$qry);
	
	 	
	if(isset($_POST['submit']) and isset($_GET['add']))
	{	
		 
		// for movies poster
      $channel_poster=rand(0,99999)."_".$_FILES['channel_poster']['name'];
      $pic1=$_FILES['channel_poster']['tmp_name'];
            
      $tpath1='images/'.$channel_poster; 
      copy($pic1,$tpath1);

      $thumbpath='images/thumbs/'.$channel_poster;
        
      $obj_img = new thumbnail_images();
      $obj_img->PathImgOld = $tpath1;
      $obj_img->PathImgNew =$thumbpath;
      $obj_img->NewWidth = 270;
      $obj_img->NewHeight = 390;
      if (!$obj_img->create_thumbnail_images()) 
      {
        echo $_SESSION['msg']="Miniatura não criada... por favor, envie a imagem novamente";
        exit;
      }

      // for movies cover
      $channel_cover=rand(0,99999)."_".$_FILES['channel_cover']['name'];
      $pic1=$_FILES['channel_cover']['tmp_name'];

            
      $tpath1='images/'.$channel_cover; 
      copy($pic1,$tpath1);

      $thumbpath='images/thumbs/'.$channel_cover;
        
      $obj_img = new thumbnail_images();
      $obj_img->PathImgOld = $tpath1;
      $obj_img->PathImgNew =$thumbpath;
      $obj_img->NewWidth = 600;
      $obj_img->NewHeight = 350;
      if (!$obj_img->create_thumbnail_images()) 
      {
        echo $_SESSION['msg']="Miniatura não criada... por favor, envie a imagem novamente";
        exit;
      }

      $agent_name=($_POST['user_agent_type']=='custom') ? trim($_POST['user_agent_name']) : '';
          
    $data = array( 
      'cat_id'  =>  cleanInput($_POST['category_id']),
      'channel_type'  =>  cleanInput($_POST['channel_type']),
      'channel_title'  =>  cleanInput($_POST['channel_title']),
      'channel_url'  =>  cleanInput($_POST['channel_url']),
      'channel_type_ios'  =>  cleanInput($_POST['channel_type_ios']),
      'channel_url_ios'  =>  cleanInput($_POST['channel_url_ios']),
      'channel_desc'  =>  addslashes($_POST['channel_desc']),
      'channel_poster'  =>  $channel_poster,
      'channel_thumbnail'  =>  $channel_cover,
      'user_agent'  =>  trim($_POST['user_agent']),
      'user_agent_type'  =>  trim($_POST['user_agent_type']),
      'user_agent_name'  =>  $agent_name,
    );		

 		$qry = Insert('tbl_channels',$data);			

		$_SESSION['msg']="10"; 
		header( "Location:canais");
		exit;	
 
	}	
	 
?>
   

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="page_title_block">
        <div class="col-md-5 col-xs-12">
          <div class="page_title"><?=$page_title?></div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="card-body mrg_bottom">
        <form class="form form-horizontal" action="" method="post"  enctype="multipart/form-data">
          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-md-3 control-label">Selecionar Categoria :-</label>
                <div class="col-md-6">
                  <select name="category_id" id="category_id" class="select2">
                    <option value="">-- Selecionar Categoria --</option>
      							<?php
      									while($row=mysqli_fetch_array($result))
      									{
      							?>
      							<option value="<?php echo $row['cid'];?>"><?php echo $row['category_name'];?></option>
      							<?php
      								}
      							?>
                  </select>
                </div>
              </div>                  
              <div class="form-group">
                <label class="col-md-3 control-label">Título do Canal :-</label>
                <div class="col-md-6">
                  <input type="text" name="channel_title" id="channel_title" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Tipo Android :-</label>
                <div class="col-md-6">
                  <select name="channel_type" id="channel_type" class="select2">
                    <option value="live_url">URL ao vivo</option>
                    <option value="youtube">YouTube</option>
                    <option value="embedded_url">URL incorporada (Open Load, Very Stream, Daily motion, Vimeo)</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">URL do Canal Android :-</label>
                <div class="col-md-6">
                  <input type="text" name="channel_url" id="channel_url" class="form-control">
                </div>
              </div>
              <div class="or_link_item">
              <h2>OU</h2>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Tipo iOS :-</label>
                <div class="col-md-6">
                  <select name="channel_type_ios" id="channel_type_ios" class="select2">
                    <option value="live_url">URL ao vivo</option>
                    <option value="youtube">YouTube</option>
                    <option value="embedded_url">URL incorporada (Open Load, Very Stream, Daily motion, Vimeo)</option>
                     
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">URL do Canal iOS :-
                  <p class="control-label-help">(M3u8,MP4)</p>
                </label>
                <div class="col-md-6">
                  <input type="text" name="channel_url_ios" id="channel_url_ios" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 control-label">Imagem do Pôster do Canal:-
                  <p class="control-label-help" id="square_lable_info">(Resolução recomendada: 185x278 retrato)</p>
                </label>
                <div class="col-md-6">
                  <div class="fileupload_block">
                    <input type="file" name="channel_poster" value="" id="fileupload">
                    <div class="fileupload_img">
                      <?php 
                        $img_src='assets/images/series-poster.jpg';
                      ?>
                      <img type="image" src="<?=$img_src?>" alt="imagem do pôster" style="width: 80px;height: 115px" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 control-label">Imagem de Capa do Canal:-
                  <p class="control-label-help" id="square_lable_info">(Resolução recomendada: 300x150 paisagem)</p>
                </label>
                <div class="col-md-6">
                  <div class="fileupload_block">
                    <input type="file" name="channel_cover" value="" id="fileupload">
                    <div class="fileupload_img">
                      <?php 
                        $img_src='assets/images/series-cover.jpg';
                      ?>
                      <img type="image" src="<?=$img_src?>" alt="imagem de capa" style="width: 150px;height: 86px" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-3">
                  <label class="control-label">Descrição do Canal :-</label>
                </div>
                <div class="col-md-6">
                  <textarea name="channel_desc" id="channel_desc" rows="5" class="form-control"></textarea>
                  <script>                             
                    CKEDITOR.replace( 'channel_desc' );
                  </script>
                </div>
              </div>
              <br/>
              <div class="form-group">
                <label class="col-md-3 control-label">User Agent :-</label>
                <div class="col-md-6">
                  <select name="user_agent" id="user_agent" class="select2">
                    <option value="false">Falso</option>
                    <option value="true">Verdadeiro</option>
                  </select>
                </div>
              </div>
              <div class="user_agent" style="display: none">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Tipo de User Agent :-</label>
                    <div class="col-md-6">
                      <select name="user_agent_type" id="user_agent_type" class="select2">
                        <option value="setting">Obter das configurações</option>
                        <option value="custom">Personalizado</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group" style="display: none">
                    <label class="col-md-3 control-label">Nome do User Agent :-</label>
                    <div class="col-md-6">
                      <input type="text" name="user_agent_name" id="user_agent_name" class="form-control">
                    </div>
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
    </div>
  </div>
</div>           
                 
        
<?php include("includes/footer.php");?>   

<script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $("input[name='channel_poster']").next(".fileupload_img").find("img").attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("input[name='channel_poster']").change(function() { 
      var file=$(this);

      if(file[0].files.length != 0){
          if(isImage($(this).val())){
            readURL(this);
          }
          else
          {
            $(this).val('');
            $('.notifyjs-corner').empty();
            $.notify(
            'Somente arquivos jpg/jpeg, png, gif e svg são permitidos!',
            { position:"top center",className: 'error'}
            );
          }
      }
  });

  function readURL1(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $("input[name='channel_cover']").next(".fileupload_img").find("img").attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("input[name='channel_cover']").change(function() { 
      var file=$(this);

      if(file[0].files.length != 0){
        if(isImage($(this).val())){
          readURL1(this);
        }
        else
        {
          $(this).val('');
          $('.notifyjs-corner').empty();
          $.notify(
          'Somente arquivos jpg/jpeg, png, gif e svg são permitidos!',
          { position:"top center",className: 'error'}
          );
        }
      }
  });


  $("select[name='user_agent']").change(function(e){
    var val=$(this).val();

    if(val==='true'){
      $(".user_agent").show();
    }
    else{
      $(".user_agent").hide();
    }

  });

  $("select[name='user_agent_type']").change(function(e){
    var val=$(this).val();

    if(val==='custom'){
      $(this).parent().parent().next(".form-group").show();
    }
    else{
      $(this).parent().parent().next(".form-group").hide();
    }

  });

</script>    
