<?php 
      
    $page_title="Identificação do aplicativo";

    include("includes/header.php");
    require("includes/function.php");
    require("language/language.php");

    $qry="SELECT * FROM tbl_settings where id='1'";
    $result=mysqli_query($mysqli,$qry);
    $settings_row=mysqli_fetch_assoc($result);
    
  if (isset($_POST['package_submit'])) {
    $data = array(
        'package_name' => addslashes(trim($_POST['package_name']))
    );

    $settings_edit = Update('tbl_settings', $data, "WHERE id = '1'");

    $_SESSION['msg'] = "11";
    header("Location: identificacao");
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
        
      <form action="" name="package_settings" method="post" class="form form-horizontal" id="package_form">

<div class="rows">
  <div class="col-md-12">
      <div class="section">
        <div class="section-body">
          <div class="form-group">
            <label class="col-md-4 control-label">Nome do pacote Android
              <p class="control-label-help">Deve ser igual ao applicationId configurado no aplicativo Android.</p>
            </label>
            <div class="col-md-6">
              <input type="text" name="package_name" id="package_name" value="<?php echo htmlspecialchars($settings_row['package_name'], ENT_QUOTES, 'UTF-8');?>" class="form-control" placeholder="com.exemplo.meuapp" required>
            </div>
          </div>
          <div class="form-group">
          <div class="col-md-9 col-md-offset-4">
            <button type="submit" name="package_submit" class="btn btn-primary">Salvar</button>
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
