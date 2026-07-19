<?php
  
  include("includes/connection.php");
  include("includes/session_check.php");

  $protocol = strtolower( substr( $_SERVER[ 'SERVER_PROTOCOL' ], 0, 5 ) ) == 'https' ? 'https' : 'http'; 
  
  //Get file name
  $currentFile = $_SERVER["SCRIPT_NAME"];
  $parts = Explode('/', $currentFile);
  $currentFile = $parts[count($parts) - 1];

  $requestUrl = $_SERVER["REQUEST_URI"];
  $urlparts = Explode('/', $requestUrl);
  $redirectUrl = $urlparts[count($urlparts) - 1];

  $_SESSION['class']="success";       
       
      
?>
<!DOCTYPE html>
<html>
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type"content="text/html;charset=UTF-8"/>
<meta name="viewport"content="width=device-width, initial-scale=1.0">
<title><?php if(isset($page_title)){ echo $page_title.' | ';} ?><?php echo APP_NAME;?> </title>
<link rel="icon" type="image/svg+xml" href="images/logo-getcine.svg">
<link rel="stylesheet" type="text/css" href="assets/css/vendor.css">
<link rel="stylesheet" type="text/css" href="assets/css/flat-admin.css">

<!-- Theme -->
<link rel="stylesheet" type="text/css" href="assets/css/theme/blue-sky.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/blue.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/red.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/yellow.css">

<link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@400;500;600;700;800;900&display=swap">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="assets/css/admin-modern.css?v=2.3.0">
<link rel="stylesheet" type="text/css" href="assets/css/getcine.css?v=3.0.0">

 <script src="assets/ckeditor/ckeditor.js"></script>

 <style type="text/css">
  .btn_edit, .btn_delete, .btn_cust{
    padding: 5px 10px !important;
  }

  .dropdown-li{
    margin-bottom: 0px !important;
  }
  .cust-dropdown-container{
    display: none;
  }
  .cust-dropdown{
    list-style: none;
  }
  .cust-dropdown li a{
    padding: 8px 10px;
    width: 100%;
    display: block;
    float: left;
    text-decoration: none;
    transition: all linear 0.2s;
    font-weight: 500;
  }
  p.not_data{
    font-size: 16px;
    text-align: center;
    margin-top: 10px;
  }

  /*===========Sweet Alert=========*/
  .sweet-alert h2 {
    font-size: 24px;
    line-height: 28px;
    font-weight: 500
  }
  .sweet-alert .lead, .sweet-alert .chk_confirm{
    font-size: 18px; 
    font-weight: 400
  }
  .sweet-alert .btn{
    min-width: 70px !important;
    padding: 8px 12px !important;
    border: 0 !important;
    height: auto !important;
    margin: 0px 3px !important;
    box-shadow: none !important;
    font-size: 15px;
  }
  .sweet-alert .sa-icon {
    margin: 0 auto 15px auto !important;
  }
  /*=======End sweet alert=======*/

</style>

</head>
<body class="admin-shell page-<?=htmlspecialchars(pathinfo($currentFile, PATHINFO_FILENAME), ENT_QUOTES, 'UTF-8')?>">
<div class="app app-default">
  <aside class="gc-sidebar" id="sidebar">
    <div class="gc-brand">
      <a class="gc-brand-link" href="painel"><img src="images/<?php echo APP_LOGO;?>" alt="<?php echo APP_NAME;?>"><span><?php echo APP_NAME;?></span></a>
      <button type="button" class="sidebar-toggle gc-burger-close" aria-label="Fechar menu"><i class="bi bi-x-lg"></i></button>
    </div>

    <nav class="gc-nav">
      <p class="gc-nav-group">Visão geral</p>
      <a class="gc-nav-link<?php if(isset($active_page) && $active_page=="dashboard"){echo ' is-active';}?>" href="painel"><i class="bi bi-grid-1x2-fill"></i><span>Painel</span></a>

      <p class="gc-nav-group">Filmes</p>
      <a class="gc-nav-link<?php if(isset($current_page) && $current_page=="movies"){echo ' is-active';}?>" href="filmes"><i class="bi bi-film"></i><span>Filmes</span></a>
      <a class="gc-nav-link<?php if(isset($current_page) && $current_page=="genre"){echo ' is-active';}?>" href="generos"><i class="bi bi-tags-fill"></i><span>Gêneros</span></a>
      <a class="gc-nav-link<?php if(isset($current_page) && $current_page=="language"){echo ' is-active';}?>" href="idiomas"><i class="bi bi-translate"></i><span>Idiomas</span></a>

      <p class="gc-nav-group">Séries</p>
      <a class="gc-nav-link<?php if(isset($current_page) && $current_page=="series"){echo ' is-active';}?>" href="series"><i class="bi bi-collection-play-fill"></i><span>Séries</span></a>
      <a class="gc-nav-link<?php if(isset($current_page) && $current_page=="season"){echo ' is-active';}?>" href="temporadas"><i class="bi bi-collection-fill"></i><span>Temporadas</span></a>
      <a class="gc-nav-link<?php if(isset($current_page) && $current_page=="episode"){echo ' is-active';}?>" href="episodios"><i class="bi bi-play-btn-fill"></i><span>Episódios</span></a>

      <p class="gc-nav-group">TV ao vivo</p>
      <a class="gc-nav-link<?php if(isset($current_page) && $current_page=="category"){echo ' is-active';}?>" href="categorias"><i class="bi bi-diagram-3-fill"></i><span>Categorias</span></a>
      <a class="gc-nav-link<?php if(isset($current_page) && $current_page=="channel"){echo ' is-active';}?>" href="canais"><i class="bi bi-broadcast"></i><span>Canais</span></a>

      <p class="gc-nav-group">Gestão</p>
      <a class="gc-nav-link<?php if($currentFile=="manage_users.php" or $currentFile=="add_user.php"){echo ' is-active';}?>" href="usuarios"><i class="bi bi-people-fill"></i><span>Usuários</span></a>
      <a class="gc-nav-link<?php if($currentFile=="manage_comments.php"){echo ' is-active';}?>" href="comentarios"><i class="bi bi-chat-square-text-fill"></i><span>Comentários</span></a>
      <a class="gc-nav-link<?php if($currentFile=="manage_reports.php" OR (isset($active_page) AND $active_page=='report')){echo ' is-active';}?>" href="denuncias"><i class="bi bi-flag-fill"></i><span>Denúncias</span></a>
      <a class="gc-nav-link<?php if($currentFile=="send_notification.php"){echo ' is-active';}?>" href="notificacoes"><i class="bi bi-bell-fill"></i><span>Notificações</span></a>

      <p class="gc-nav-group">Sistema</p>
      <a class="gc-nav-link<?php if($currentFile=="smtp_settings.php"){echo ' is-active';}?>" href="smtp"><i class="bi bi-envelope-fill"></i><span>SMTP</span></a>
      <a class="gc-nav-link<?php if($currentFile=="settings.php"){echo ' is-active';}?>" href="configuracoes"><i class="bi bi-gear-fill"></i><span>Configurações</span></a>
      <a class="gc-nav-link<?php if($currentFile=="verification.php"){echo ' is-active';}?>" href="identificacao"><i class="bi bi-patch-check-fill"></i><span>Identificação</span></a>
      <?php if(file_exists('api.php') OR file_exists('ios_api.php')){?>
      <a class="gc-nav-link<?php if($currentFile=="api_urls.php"){echo ' is-active';}?>" href="urls-api"><i class="bi bi-hdd-network-fill"></i><span>URLs da API</span></a>
      <?php }?>
    </nav>

    <div class="gc-user">
      <a href="perfil" class="gc-user-link">
        <?php if(PROFILE_IMG){?>
          <img src="images/<?php echo PROFILE_IMG;?>" alt="Perfil">
        <?php }else{?>
          <img src="assets/images/profile.png" alt="Perfil">
        <?php }?>
        <span class="gc-user-copy"><strong>Administrador</strong><small>Minha conta</small></span>
      </a>
      <a href="sair" class="gc-user-out" title="Sair" aria-label="Sair"><i class="bi bi-box-arrow-right"></i></a>
    </div>
  </aside>   
  <div class="app-container">
    <nav class="navbar navbar-default" id="navbar">
      <div class="container-fluid">
        <div class="navbar-collapse collapse in">
          <ul class="nav navbar-nav navbar-mobile">
            <li>
              <button type="button" class="sidebar-toggle"> <i class="fa fa-bars"></i> </button>
            </li>
            <li class="logo"> <a class="navbar-brand" href="#"><?php echo APP_NAME;?></a> </li>
            <li>
              <button type="button" class="navbar-toggle">
                <?php if(PROFILE_IMG){?>               
                  <img class="profile-img" src="images/<?php echo PROFILE_IMG;?>">
                <?php }else{?>
                  <img class="profile-img" src="assets/images/profile.png">
                <?php }?>
                  
              </button>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-left">
            <li class="navbar-title"><span class="navbar-eyebrow">Administração</span><?=isset($page_title) ? htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') : APP_NAME?></li>
             
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown profile"> <a href="perfil" class="dropdown-toggle" data-toggle="dropdown"> <?php if(PROFILE_IMG){?>               
                  <img class="profile-img" src="images/<?php echo PROFILE_IMG;?>">
                <?php }else{?>
                  <img class="profile-img" src="assets/images/profile.png">
                <?php }?>
              <div class="title">Perfil</div>
              </a>
              <div class="dropdown-menu">
                <div class="profile-info">
                  <h4 class="username">Admin</h4>
                </div>
                <ul class="action">
                  <li><a href="perfil">Perfil</a></li>                  
                  <li><a href="sair">Sair</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

