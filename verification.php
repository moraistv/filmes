<?php 
      
    $page_title="Envato Verify Purchase";

    include("includes/header.php");
    require("includes/function.php");
    require("language/language.php");

    $qry="SELECT * FROM tbl_settings where id='1'";
    $result=mysqli_query($mysqli,$qry);
    $settings_row=mysqli_fetch_assoc($result);
    
  if (isset($_POST['android_verify_btn'])) {

    
    $data = array(
        'envato_buyer_name' => trim($_POST['envato_buyer_name']),
        'envato_purchase_code' => trim($_POST['envato_purchase_code']),
        'envato_purchased_status' => 1,
        'package_name' => trim($_POST['package_name'])
    );

    $settings_edit = Update('tbl_settings', $data, "WHERE id = '1'");

    $config_file_default = "includes/app.default";
    $config_file_name    = "api.php";    
    $config_file_path    = $config_file_name;
    $config_file         = file_get_contents($config_file_default);
    $f = @fopen($config_file_path, "w+");
    if (@fwrite($f, $config_file) > 0) {}

    $_SESSION['msg'] = "19";
    header("Location: verification.php");
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
      <div class="card-body mrg_bottom" style="padding: 15px">
        
      <form action="" name="verify_purchase" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">

<div class="rows">
  <div class="col-md-12">
      <div class="section">
        <div class="section-body">
          <div class="form-group">
            <label class="col-md-4 control-label">Envato Username :-
              <p class="control-label-help" style="margin-bottom: 5px">https://codecanyon.net/user/<u style="color: #e91e63">viaviwebtech</u></p>
              <p class="control-label-help">(<u style="color: #e91e63">viaviwebtech</u> is username)</p>
            </label>
            <div class="col-md-6">
              <input type="text" name="envato_buyer_name" value="<?php echo $settings_row['envato_buyer_name'];?>" class="form-control" placeholder="viaviwebtech">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Envato Purchase Code :-

              <p class="control-label-help">(<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank">Where Is My Purchase Code?</a>)</p>
            </label>
            <div class="col-md-6">
              <input type="text" name="envato_purchase_code" value="<?php echo $settings_row['envato_purchase_code'];?>" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx-xxxx">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Android Package Name :-
              <p class="control-label-help">(More info in Android Doc)</p>
            </label>
            <div class="col-md-6">
              <input type="text" name="package_name" id="package_name" value="<?php echo $settings_row['package_name'];?>" class="form-control" placeholder="com.example.myapp">
            </div>
          </div>
          <div class="form-group">
          <div class="col-md-9 col-md-offset-4">
            <button type="submit" name="android_verify_btn" class="btn btn-primary">Save</button>
          </div>
          </div>
        </div>
      </div>
  </div>
</div>
<div class="clearfix"></div>
</form> 

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
</script>