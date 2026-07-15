<?php 
  if(isset($_GET['id'])){ 
    $page_title= 'Edit Language';
  }
  else{ 
    $page_title='Add Language'; 
  }
  $current_page="language";
  $active_page="movies";

  include("includes/header.php");
  require("includes/function.php");
  require("language/language.php");

  require_once("thumbnail_images.class.php");

  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="SELECT * FROM tbl_language WHERE id='$id'";
    $res=mysqli_query($mysqli,$sql);
    $row=mysqli_fetch_assoc($res);
  }

  if(isset($_POST['submit']) and isset($_GET['add']))
  {
  
    $name=addslashes(trim($_POST['language_name']));
    $color=addslashes(trim($_POST['bg_color']));
    $data = array(
          'language_name'  =>  $name,
          'language_background'  =>  $color
    );  

    $qry = Insert('tbl_language',$data);  
    $_SESSION['msg']="10";
    header( "Location:manage_language.php");
    exit; 

  }
  if(isset($_POST['submit']) and isset($_POST['id']))
  {

    $name=addslashes(trim($_POST['language_name']));
    $color=addslashes(trim($_POST['bg_color']));
    $data = array(
          'language_name'  =>  $name,
          'language_background'  =>  $color
    );  

    $update=Update('tbl_language', $data, "WHERE id = '".$_POST['id']."'");
 
    
    $_SESSION['msg']="11"; 
    
    if(isset($_GET['redirect']))
      header( "Location:".$_GET['redirect']);
    else  
      header( "Location:add_language.php?id=".$_POST['id']);
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
        <form action="" name="addeditlanguage" method="post" class="form form-horizontal" enctype="multipart/form-data">
          <input  type="hidden" name="id" value="<?php echo $_GET['id'];?>" />

          <div class="section">
            <div class="section-body">
              <div class="form-group">
                <label class="col-md-3 control-label">Language Title :-
                
                </label>
                <div class="col-md-6">
                  <input type="text" name="language_name" placeholder="Enter language title" id="language_name" value="<?php if(isset($_GET['id'])){echo $row['language_name'];}?>" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Select Background-Color :-</label>
                <div class="col-md-6">
                  <input value="<?php if(isset($_GET['id'])){echo $row['language_background'];}else{ echo 'e91e63';}?>" name="bg_color" class="form-control jscolor {width:243, height:150, position:'right',
                  borderColor:'#000', insetColor:'#FFF', backgroundColor:'#ddd'}">
                </div>
              </div>
              <br>
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

<script type="text/javascript" src="assets/js/jscolor.js"></script>