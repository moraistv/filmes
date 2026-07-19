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
    header("Location:painel");
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
<link rel="icon" type="image/svg+xml" href="images/logo-getcine.svg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@400;500;600;700;800;900&display=swap">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="assets/css/getcine.css?v=<?php echo @filemtime('assets/css/getcine.css') ?: time(); ?>">

</head>
<body class="gc-login">
<div class="gc-login-card">

  <!-- Painel de marca -->
  <aside class="gc-login-brand">
    <div class="gc-login-logo"><img src="images/logo-getcine-white.svg" alt="<?php echo APP_NAME;?>"></div>
    <h1><?php echo APP_NAME;?></h1>
    <p class="gc-tagline">Gerencie filmes, séries e canais em um só lugar.</p>
    <ul class="gc-login-feats">
      <li><i class="bi bi-film"></i> Catálogo completo</li>
      <li><i class="bi bi-people-fill"></i> Controle de usuários</li>
      <li><i class="bi bi-bar-chart-fill"></i> Relatórios e métricas</li>
    </ul>
  </aside>

  <!-- Formulário -->
  <main class="gc-login-form">
    <h2>Bem-vindo de volta</h2>
    <p class="gc-sub">Entre com suas credenciais para acessar o painel</p>

    <?php if(isset($_SESSION['msg'])){ ?>
    <div class="gc-alert" role="alert">
      <i class="bi bi-exclamation-circle-fill"></i>
      <span><?php echo $client_lang[$_SESSION['msg']]; ?></span>
    </div>
    <?php unset($_SESSION['msg']); } ?>

    <form action="login_db.php" method="post" autocomplete="on">
      <label class="gc-label" for="username">Usuário</label>
      <div class="gc-field">
        <i class="bi bi-person gc-field-ic"></i>
        <input type="text" name="username" id="username" placeholder="Digite seu usuário" autocomplete="username" required autofocus>
      </div>

      <label class="gc-label" for="password">Senha</label>
      <div class="gc-field">
        <i class="bi bi-lock gc-field-ic"></i>
        <input type="password" name="password" id="password" placeholder="Digite sua senha" autocomplete="current-password" required>
        <button type="button" class="gc-eye" id="togglePassword" aria-label="Mostrar senha" title="Mostrar senha">
          <i class="bi bi-eye"></i>
        </button>
      </div>

      <button type="submit" class="gc-login-btn">Entrar no painel</button>
    </form>

    <p class="gc-login-foot">&copy; <?php echo date('Y'); ?> <?php echo APP_NAME;?></p>
  </main>

</div>

<script type="text/javascript">
  (function () {
    var toggle = document.getElementById('togglePassword');
    var field = document.getElementById('password');
    if (toggle && field) {
      toggle.addEventListener('click', function () {
        var isHidden = field.getAttribute('type') === 'password';
        field.setAttribute('type', isHidden ? 'text' : 'password');
        toggle.querySelector('i').className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
        toggle.setAttribute('aria-label', isHidden ? 'Ocultar senha' : 'Mostrar senha');
        toggle.setAttribute('title', isHidden ? 'Ocultar senha' : 'Mostrar senha');
      });
    }
  })();
</script>
</body>
</html>
