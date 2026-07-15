<?php  
  $license_filename="includes/.lic";
  if(!file_exists($license_filename))
  {
      header("Location:install/index.php");
      exit;
  }
?>
<?php
  
  include("includes/connection.php");
	include("language/language.php");

	if(isset($_SESSION['admin_name']))
  {
    header("Location:home.php");
    exit;
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type"content="text/html;charset=UTF-8"/>
<meta name="viewport"content="width=device-width, initial-scale=1.0">
<title><?php echo APP_NAME;?> | Entrar</title>
<link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="16x16">
<link rel="stylesheet" type="text/css" href="assets/css/vendor.css">
<link rel="stylesheet" type="text/css" href="assets/css/flat-admin.css">

<!-- Theme -->
<link rel="stylesheet" type="text/css" href="assets/css/theme/blue-sky.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/blue.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/red.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/yellow.css">
<link rel="stylesheet" type="text/css" href="assets/css/admin-modern.css?v=1.0.0">

</head>
<body class="login-shell">
<div class="app app-default">
  <div class="app-container app-login">
    <div class="flex-center">
      <div class="app-body">
        <div class="app-block">
          <div class="app-form login-form">
            <div class="form-header">
              <div class="login-logo"><img src="images/<?php echo APP_LOGO;?>" alt="Logo"></div>
              <div class="app-brand"><?php echo APP_NAME;?></div>
              <p class="login-subtitle">Acesse o painel de administração</p>
            </div>
            <form action="login_db.php" method="post">
			        <div class="input-group" style="border:0px;">
                <?php if(isset($_SESSION['msg'])){?>
                <div class="alert alert-danger  alert-dismissible" role="alert"> <?php echo $client_lang[$_SESSION['msg']]; ?> </div>
                <?php unset($_SESSION['msg']);}?>
              </div>
              <div class="input-group"> <span class="input-group-addon" id="basic-addon1"> <i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" name="username" id="username" class="form-control" placeholder="Usuário" aria-describedby="basic-addon1" autocomplete="username" required>
              </div>
              <div class="input-group"> <span class="input-group-addon" id="basic-addon2"> <i class="fa fa-key" aria-hidden="true"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Senha" aria-describedby="basic-addon2" autocomplete="current-password" required>
              </div>
              <div class="text-center">
                <input type="submit" class="btn btn-success btn-submit" value="Entrar no painel">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="assets/js/admin-pt-BR.js"></script>
</body>
</html>
