<?php 
	if(isset($_GET['series_id'])){ 
		$page_title= 'Edit Series';
	}
	else{ 
		$page_title='Add Series'; 
	}
	$current_page="series";
	$active_page="series";

	include("includes/header.php");
	require("includes/function.php");
	require("language/language.php");

	require_once("thumbnail_images.class.php");
	
	if(isset($_POST['submit']) and isset($_GET['add']))
	{
		
		$title=addslashes(trim($_POST['series_name']));
		$desc=addslashes(trim($_POST['series_desc']));

		if($_POST['poster_img']=='' || $_FILES['series_poster']['error']!=4){
			// for series poster
			$series_poster=rand(0,99999)."_".$_FILES['series_poster']['name'];
			$pic1=$_FILES['series_poster']['tmp_name'];

						
			$tpath1='images/series/'.$series_poster; 
			copy($pic1,$tpath1);

			$thumbpath='images/series/thumbs/'.$series_poster;
				
			$obj_img = new thumbnail_images();
			$obj_img->PathImgOld = $tpath1;
			$obj_img->PathImgNew =$thumbpath;
			$obj_img->NewWidth = 270;
			$obj_img->NewHeight = 390;
			if (!$obj_img->create_thumbnail_images()) 
			{
				echo "Thumbnail not created... please upload image again";
				exit;
			}
		}
		else{
			$get_file_name = parse_url($_POST['poster_img'], PHP_URL_PATH);

	        $ext = pathinfo($get_file_name, PATHINFO_EXTENSION);
	        $series_poster=date('dmYhis').'_'.rand(0,99999).".".$ext;

	        $tpath1='images/series/'.$series_poster;

	        grab_image($_POST['poster_img'], $tpath1);

	        $thumbpath='images/series/thumbs/'.$series_poster;
	          
	        $obj_img = new thumbnail_images();
	        $obj_img->PathImgOld = $tpath1;
	        $obj_img->PathImgNew =$thumbpath;
	        $obj_img->NewWidth = 300;
	        $obj_img->NewHeight = 300;
	        if (!$obj_img->create_thumbnail_images()) 
	        {
	          echo "Thumbnail not created... please upload image again";
	          exit;
	        }
		}

		// for series cover
		$series_cover=rand(0,99999)."_".$_FILES['series_cover']['name'];
		$pic1=$_FILES['series_cover']['tmp_name'];

					
		$tpath1='images/series/'.$series_cover; 
		copy($pic1,$tpath1);

		$thumbpath='images/series/thumbs/'.$series_cover;
			
		$obj_img = new thumbnail_images();
		$obj_img->PathImgOld = $tpath1;
		$obj_img->PathImgNew =$thumbpath;
		$obj_img->NewWidth = 600;
		$obj_img->NewHeight = 350;
		if (!$obj_img->create_thumbnail_images()) 
		{
			echo "Thumbnail not created... please upload image again";
			exit;
		}
        
        $data = array( 
			    'series_name'  =>  $title,
			    'series_desc'  =>  $desc,
			   	'series_poster'  =>  $series_poster,
			   	'series_cover'  =>  $series_cover
			    );		

 		$qry = Insert('tbl_series',$data);			

		$_SESSION['msg']="10";
 
		header( "Location:manage_series.php");
		exit;	
		
	}
	
	if(isset($_GET['series_id']))
	{	 
		$qry="SELECT * FROM tbl_series where id='".$_GET['series_id']."'";
		$result=mysqli_query($mysqli,$qry);
		$row=mysqli_fetch_assoc($result);
	}
	if(isset($_POST['submit']) and isset($_POST['series_id']))
	{	
		$title=addslashes(trim($_POST['series_name']));
		$desc=addslashes(trim($_POST['series_desc']));
		
		if($_FILES['series_poster']['error']!=4){

			unlink('images/series/'.$row['series_poster']);
			unlink('images/series/thumbs/'.$row['series_poster']);

			// for series poster
			$series_poster=rand(0,99999)."_".$_FILES['series_poster']['name'];
			$pic1=$_FILES['series_poster']['tmp_name'];

						
			$tpath1='images/series/'.$series_poster; 
			copy($pic1,$tpath1);

			$thumbpath='images/series/thumbs/'.$series_poster;
				
			$obj_img = new thumbnail_images();
			$obj_img->PathImgOld = $tpath1;
			$obj_img->PathImgNew =$thumbpath;
			$obj_img->NewWidth = 270;
			$obj_img->NewHeight = 390;
			if (!$obj_img->create_thumbnail_images()) 
			{
				echo "Thumbnail not created... please upload image again";
				exit;
			}
		}else{
			$series_poster=$row['series_poster'];
		}

		if($_FILES['series_cover']['error']!=4){
			unlink('images/series/'.$row['series_cover']);
			unlink('images/series/thumbs/'.$row['series_cover']);

			// for series cover
			$series_cover=rand(0,99999)."_".$_FILES['series_cover']['name'];
			$pic1=$_FILES['series_cover']['tmp_name'];

						
			$tpath1='images/series/'.$series_cover; 
			copy($pic1,$tpath1);

			$thumbpath='images/series/thumbs/'.$series_cover;
				
			$obj_img = new thumbnail_images();
			$obj_img->PathImgOld = $tpath1;
			$obj_img->PathImgNew =$thumbpath;
			$obj_img->NewWidth = 600;
			$obj_img->NewHeight = 350;
			if (!$obj_img->create_thumbnail_images()) 
			{
				echo "Thumbnail not created... please upload image again";
				exit;
			}

		}else{
			$series_cover=$row['series_cover'];
		}

		$data = array( 
			    'series_name'  =>  $title,
			    'series_desc'  =>  $desc,
			   	'series_poster'  =>  $series_poster,
			   	'series_cover'  =>  $series_cover
			    );

		$edit=Update('tbl_series', $data, "WHERE id = '".$_POST['series_id']."'");

		$_SESSION['msg']="11"; 
		

		if(isset($_GET['redirect']))
	      header( "Location:".$_GET['redirect']);
	    else  
	      header( "Location:add_series.php?series_id=".$_POST['series_id']);
	    exit;

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

          	<?php if(isset($_GET['add']) && !isset($_GET['episode_id'])){ ?>

	        <?php if($settings_details['omdb_api_key']==''){ ?>

	        <div class="alert alert-danger">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            Please set OMDb API key <a href="settings.php#omdbapi_id" target="_blank">here</a>
	        </div>
	        <br/>
	        <?php }else{ ?>

	        <div class="col-md-12">
	          <div class="col-md-3">
	            <p>
	              <strong>Import From IMDb</strong>
	              <br/>
	              <span style="font-size: 12px">(Recommended : Search by IMDb ID for better result)</span>
	            </p>
	          </div>
	          <div class="col-md-6">
	            <input type="text" name="imdb_id_title" id="imdb_id_title" class="form-control" placeholder="Enter IMDb ID (e.g. tt2161930)" <?php if($settings_details['omdb_api_key']==''){ echo 'disabled=""';}?> style="height: 44px">
	          </div>
	          <div class="col-md-1">
	            <button type="button" <?php if($settings_details['omdb_api_key']==''){ echo 'disabled=""';}?> class="btn btn-primary btn-sm btn_fetch">Fetch</button>
	          </div>
	        </div>
	        <div class="col-md-12">
	          <hr/>
	        </div>
	        <?php } } ?>

            <form action="" name="addeditcategory" method="post" class="form form-horizontal" enctype="multipart/form-data">
            	<input  type="hidden" name="series_id" value="<?php echo $_GET['series_id'];?>" />

              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Series Name :-</label>
                    <div class="col-md-6">
                      <input type="text" name="series_name" id="series_name" value="<?php if(isset($_GET['series_id'])){echo $row['series_name'];}?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Poster Image:-
                      <p class="control-label-help" id="square_lable_info">(Recommended resolution: 185x278 portrait)</p>
                    </label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="series_poster" value="" accept=".png, .jpg, .jpeg, .svg, .gif" <?php echo (!isset($_GET['series_id'])) ? 'required="require"' : '' ?> id="fileupload">
                        <div class="fileupload_img">
                        	<?php 
                        		$img_src="";

                        		if(!isset($_GET['series_id']) || !file_exists('images/series/'.$row['series_poster'])){
                        			$img_src='assets/images/series-poster.jpg';
                        		}else{
                        			$img_src='images/series/'.$row['series_poster'];
                        		}

                        	?>

                        	<input type="hidden" name="poster_img" value="">

                          <img type="image" src="<?=$img_src?>" class="poster_img" alt="poster image" style="width: 80px;height: 115px" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Cover Image:-
                      <p class="control-label-help" id="square_lable_info">(Recommended resolution: 500x282 landscape)</p>
                    </label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="series_cover" value="" accept=".png, .jpg, .jpeg, .svg, .gif" <?php echo (!isset($_GET['series_id'])) ? 'required="require"' : '' ?> id="fileupload">
                        <div class="fileupload_img">
                        	<?php 
                        		$img_src="";

                        		if(!isset($_GET['series_id']) || !file_exists('images/series/'.$row['series_cover'])){
                        			$img_src='assets/images/series-cover.jpg';
                        		}else{
                        			$img_src='images/series/'.$row['series_cover'];
                        		}

                        	?>
                          <img type="image" src="<?=$img_src?>" alt="cover image" style="width: 150px;height: 86px" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-3">
                      <label class="control-label">Series Description :-</label>
                    </div>
                    <div class="col-md-6">
                      <textarea name="series_desc" id="series_desc" rows="5" class="form-control"><?php if(isset($_GET['series_id'])){ echo $row['series_desc']; } ?></textarea>
                      <script>
                        CKEDITOR.replace('series_desc');
                      </script>
                    </div>
                  </div>
                  <br/>
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
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
	      $("input[name='series_poster']").next(".fileupload_img").find("img").attr('src', e.target.result);
	    }
	    
	    reader.readAsDataURL(input.files[0]);
	  }
	}

	$("input[name='series_poster']").change(function() { 
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
	          'Only jpg/jpeg, png, gif and svg files are allowed!',
	          { position:"top center",className: 'error'}
	          );
	        }
	    }
	});

	function readURL1(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	      $("input[name='series_cover']").next(".fileupload_img").find("img").attr('src', e.target.result);
	    }
	    
	    reader.readAsDataURL(input.files[0]);
	  }
	}

	$("input[name='series_cover']").change(function() { 

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
	          'Only jpg/jpeg, png, gif and svg files are allowed!',
	          { position:"top center",className: 'error'}
	          );
	        }
	    }

	});
</script>    


<script type="text/javascript">
  // fetch imdb details

  $(".btn_fetch").click(function(e){
    e.preventDefault();

    var btn=$(this);

    $(this).attr("disabled", true);
    $(this).text("Please wait..");

    var imdb_id_title=$("#imdb_id_title").val();

    if(imdb_id_title==''){
      swal("Enter IMDb ID (e.g. tt2161930)");
      btn.attr("disabled", false);
      btn.text("Fetch");
      return;
    }
    else{

      $.ajax({
        type:'post',
        url:'processImdb.php',
        dataType:'json',
        data:{'action':'getSeriesDetails', 'id' : imdb_id_title},
        success:function(res){

            btn.attr("disabled", false);
            btn.text("Fetch");

            $('.notifyjs-corner').empty();
            $.notify(
              res.message,
              { position:"top center",className: res.class}
            );
            if(res.status=='1'){
                
                $("input[name='series_poster']").attr("required",false);
                
                $("input[name='series_name']").val(res.title);
                $("input[name='poster_img']").val(res.thumbnail);
                $(".poster_img").attr('src', res.thumbnail);
                $("textarea[name='series_desc']").val(res.plot);
                CKEDITOR.instances['series_desc'].setData(res.plot);
            }
          }
      });

    }

  });

</script> 