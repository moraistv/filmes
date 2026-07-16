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
<link rel="stylesheet" type="text/css" href="assets/css/admin-modern.css?v=1.1.0">

</head>
<body class="login-shell">
<div class="login-wrapper">
  <div class="login-card">

    <!-- Painel de marca -->
    <aside class="login-brand-side">
      <div class="brand-glow"></div>
      <div class="brand-content">
        <div class="login-logo"><img src="images/<?php echo APP_LOGO;?>" alt="Logo"></div>
        <h1 class="app-brand"><?php echo APP_NAME;?></h1>
        <p class="brand-tagline">Gerencie filmes, séries e canais em um só lugar.</p>
        <ul class="brand-features">
          <li><i class="fa fa-film" aria-hidden="true"></i> Catálogo completo</li>
          <li><i class="fa fa-users" aria-hidden="true"></i> Controle de usuários</li>
          <li><i class="fa fa-bar-chart" aria-hidden="true"></i> Relatórios e métricas</li>
        </ul>
      </div>
    </aside>

    <!-- Formulário -->
    <main class="login-form-side">
      <div class="app-form login-form">
        <div class="form-header">
          <h2 class="login-title">Bem-vindo de volta</h2>
          <p class="login-subtitle">Entre com suas credenciais para acessar o painel</p>
        </div>

        <?php if(isset($_SESSION['msg'])){ ?>
        <div class="alert alert-danger" role="alert">
          <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
          <span><?php echo $client_lang[$_SESSION['msg']]; ?></span>
        </div>
        <?php unset($_SESSION['msg']); } ?>

        <form action="login_db.php" method="post" autocomplete="on">
          <label class="field-label" for="username">Usuário</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
            <input type="text" name="username" id="username" class="form-control" placeholder="Digite seu usuário" autocomplete="username" required autofocus>
          </div>

          <label class="field-label" for="password">Senha</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
            <input type="password" name="password" id="password" class="form-control" placeholder="Digite sua senha" autocomplete="current-password" required>
            <button type="button" class="toggle-password" id="togglePassword" aria-label="Mostrar senha" title="Mostrar senha">
              <i class="fa fa-eye" aria-hidden="true"></i>
            </button>
          </div>

          <button type="submit" class="btn btn-submit">Entrar no painel</button>
        </form>

        <p class="login-footnote">&copy; <?php echo date('Y'); ?> <?php echo APP_NAME;?></p>
      </div>
    </main>

  </div>
</div>

<script type="text/javascript" src="assets/js/admin-pt-BR.js"></script>
<script type="text/javascript">
  (function () {
    var toggle = document.getElementById('togglePassword');
    var field = document.getElementById('password');
    if (toggle && field) {
      toggle.addEventListener('click', function () {
        var isHidden = field.getAttribute('type') === 'password';
        field.setAttribute('type', isHidden ? 'text' : 'password');
        toggle.querySelector('i').className = isHidden ? 'fa fa-eye-slash' : 'fa fa-eye';
        toggle.setAttribute('aria-label', isHidden ? 'Ocultar senha' : 'Mostrar senha');
        toggle.setAttribute('title', isHidden ? 'Ocultar senha' : 'Mostrar senha');
      });
    }
  })();
</script>
</body>
</html>
