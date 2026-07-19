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
<link rel="stylesheet" type="text/css" href="assets/css/admin-modern.css?v=2.1.0">

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
  <aside class="app-sidebar" id="sidebar">
    <div class="sidebar-header"> <a class="sidebar-brand" href="home.php"><img src="images/<?php echo APP_LOGO;?>" alt="Logo" /><span class="brand-label"><?php echo APP_NAME;?></span></a>
      <button type="button" class="sidebar-toggle"> <i class="fa fa-times"></i> </button>
    </div>
    <div class="sidebar-menu">
      <ul class="sidebar-nav">
        <li class="nav-section"><span>Visão geral</span></li>
        <li <?php if(isset($active_page) && $active_page=="dashboard"){?>class="active"<?php }?>> <a href="home.php">
          <div class="icon"> <i class="bi bi-grid-1x2-fill" aria-hidden="true"></i> </div>
          <div class="title">Painel</div>
          </a> 
        </li>
        <li class="nav-section"><span>Filmes</span></li>
        <li <?php if(isset($current_page) && $current_page=="movies"){?>class="active"<?php }?>> <a href="manage_movies.php">
          <div class="icon"> <i class="bi bi-film" aria-hidden="true"></i> </div>
          <div class="title">Filmes</div>
          </a> 
        </li>
        <li <?php if(isset($current_page) && $current_page=="genre"){?>class="active"<?php }?>> <a href="manage_genres.php">
          <div class="icon"> <i class="bi bi-tags-fill" aria-hidden="true"></i> </div>
          <div class="title">Gêneros</div>
          </a> 
        </li>
        <li <?php if(isset($current_page) && $current_page=="language"){?>class="active"<?php }?>> <a href="manage_language.php">
          <div class="icon"> <i class="bi bi-translate" aria-hidden="true"></i> </div>
          <div class="title">Idiomas</div>
          </a> 
        </li>

        <li class="nav-section"><span>Séries</span></li>
        <li <?php if(isset($current_page) && $current_page=="series"){?>class="active"<?php }?>> <a href="manage_series.php">
          <div class="icon"> <i class="bi bi-collection-play-fill" aria-hidden="true"></i> </div>
          <div class="title">Séries</div>
          </a> 
        </li>
        <li <?php if(isset($current_page) && $current_page=="season"){?>class="active"<?php }?>> <a href="manage_season.php">
          <div class="icon"> <i class="bi bi-collection-fill" aria-hidden="true"></i> </div>
          <div class="title">Temporadas</div>
          </a> 
        </li>
        <li <?php if(isset($current_page) && $current_page=="episode"){?>class="active"<?php }?>> <a href="manage_episode.php">
          <div class="icon"> <i class="bi bi-play-btn-fill" aria-hidden="true"></i> </div>
          <div class="title">Episódios</div>
          </a> 
        </li>

        <li class="nav-section"><span>TV ao vivo</span></li>
        <li <?php if(isset($current_page) && $current_page=="category"){?>class="active"<?php }?>> <a href="manage_category.php">
          <div class="icon"> <i class="bi bi-diagram-3-fill" aria-hidden="true"></i> </div>
          <div class="title">Categorias</div>
          </a> 
        </li>
        <li <?php if(isset($current_page) && $current_page=="channel"){?>class="active"<?php }?>> <a href="manage_channels.php">
          <div class="icon"> <i class="bi bi-broadcast" aria-hidden="true"></i> </div>
          <div class="title">Canais</div>
          </a> 
        </li>

        <li class="nav-section"><span>Gestão</span></li>
        <li <?php if($currentFile=="manage_users.php" or $currentFile=="add_user.php"){?>class="active"<?php }?>> <a href="manage_users.php">
          <div class="icon"> <i class="bi bi-people-fill" aria-hidden="true"></i> </div>
          <div class="title">Usuários</div>
          </a> 
        </li>

        <li <?php if($currentFile=="manage_comments.php"){?>class="active"<?php }?>> <a href="manage_comments.php">
          <div class="icon"> <i class="bi bi-chat-square-text-fill" aria-hidden="true"></i> </div>
          <div class="title">Comentários</div>
          </a> 
        </li>

        <li <?php if($currentFile=="manage_reports.php" OR (isset($active_page) AND $active_page=='report')){?>class="active"<?php }?>> <a href="manage_reports.php">
          <div class="icon"> <i class="bi bi-flag-fill" aria-hidden="true"></i> </div>
          <div class="title">Denúncias</div>
          </a> 
        </li>
         
        <li <?php if($currentFile=="send_notification.php"){?>class="active"<?php }?>> <a href="send_notification.php">
          <div class="icon"> <i class="bi bi-bell-fill" aria-hidden="true"></i> </div>
          <div class="title">Notificações</div>
          </a> 
        </li>

        <li class="nav-section"><span>Sistema</span></li>
        <li <?php if($currentFile=="smtp_settings.php"){?>class="active"<?php }?>> <a href="smtp_settings.php">
          <div class="icon"> <i class="bi bi-envelope-fill" aria-hidden="true"></i> </div>
          <div class="title">SMTP</div>
          </a> 
        </li>

        <li <?php if($currentFile=="settings.php"){?>class="active"<?php }?>> <a href="settings.php">
          <div class="icon"> <i class="bi bi-gear-fill" aria-hidden="true"></i> </div>
          <div class="title">Configurações</div>
          </a> 
        </li>

        <li <?php if($currentFile=="verification.php"){?>class="active"<?php }?>> <a href="verification.php">
          <div class="icon"> <i class="bi bi-patch-check-fill" aria-hidden="true"></i> </div>
          <div class="title">Identificação</div>
          </a> 
        </li>

        <?php if(file_exists('api.php') OR file_exists('ios_api.php')){?>
        <li <?php if($currentFile=="api_urls.php"){?>class="active"<?php }?>> <a href="api_urls.php">
          <div class="icon"> <i class="bi bi-hdd-network-fill" aria-hidden="true"></i> </div>
          <div class="title">URLs da API</div>
          </a> 
        </li> 
        <?php }?>
         
      </ul>
    </div>
    <div class="sidebar-account">
      <a href="profile.php" class="sidebar-account-link">
        <?php if(PROFILE_IMG){?>
          <img src="images/<?php echo PROFILE_IMG;?>" alt="Perfil">
        <?php }else{?>
          <img src="assets/images/profile.png" alt="Perfil">
        <?php }?>
        <span class="sidebar-account-copy"><strong>Administrador</strong><small>Minha conta</small></span>
      </a>
      <a href="logout.php" class="sidebar-logout" title="Sair" aria-label="Sair"><i class="bi bi-box-arrow-right"></i></a>
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
            <li class="dropdown profile"> <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown"> <?php if(PROFILE_IMG){?>               
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
                  <li><a href="profile.php">Perfil</a></li>                  
                  <li><a href="logout.php">Sair</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

