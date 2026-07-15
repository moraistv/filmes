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
<link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="16x16">
<link rel="stylesheet" type="text/css" href="assets/css/vendor.css">
<link rel="stylesheet" type="text/css" href="assets/css/flat-admin.css">

<!-- Theme -->
<link rel="stylesheet" type="text/css" href="assets/css/theme/blue-sky.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/blue.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/red.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/yellow.css">

<link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert.css">

 <script src="assets/ckeditor/ckeditor.js"></script>

 <style type="text/css">
  .btn_edit, .btn_delete, .btn_cust{
    padding: 5px 10px !important;
  }
  .form-control{
    border-width: 2px !important;
    border-color: #ccc !important;
  }

  .dropdown-li{
    margin-bottom: 0px !important;
  }
  .cust-dropdown-container{
    background: #E7EDEE;
    display: none;
  }
  .cust-dropdown{
    list-style: none;
    background: #eee;
  }
  .cust-dropdown li a{
    padding: 8px 10px;
    width: 100%;
    display: block;
    color: #444;
    float: left;
    text-decoration: none;
    transition: all linear 0.2s;
    font-weight: 500;
  }
  .cust-dropdown li a:hover, .cust-dropdown li a.active{
    color: #e91e63;
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
<body>
<div class="app app-default">
  <aside class="app-sidebar" id="sidebar">
    <div class="sidebar-header"> <a class="sidebar-brand" href="home.php"><img src="images/<?php echo APP_LOGO;?>" alt="app logo" /></a>
      <button type="button" class="sidebar-toggle"> <i class="fa fa-times"></i> </button>
    </div>
    <div class="sidebar-menu">
      <ul class="sidebar-nav">
        <li <?php if(isset($active_page) && $active_page=="dashboard"){?>class="active"<?php }?>> <a href="home.php">
          <div class="icon"> <i class="fa fa-dashboard" aria-hidden="true"></i> </div>
          <div class="title">Dashboard</div>
          </a> 
        </li>
       
        <li class="dropdown-li movies <?php if(isset($active_page) && $active_page=="movies"){ echo 'active'; }?>">
          <a href="javascript:void(0)" class="dropdown-a">
            <div class="icon"> <i class="fa fa-video-camera" aria-hidden="true"></i> </div>
            <div class="title">Movies</div>
            <i class="fa fa-angle-right pull-right" style="padding-top: 7px;color: #fff;"></i>
          </a> 
        </li>
        <li class="cust-dropdown-container">

          <ul class="cust-dropdown">
            <li> 
              <a href="manage_language.php" class="<?php if(isset($current_page) && $current_page=="language"){ echo 'active'; }?>">
                <div class="title"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Languages</div>
              </a> 
            </li>

            <li>
              <a href="manage_genres.php" class="<?php if(isset($current_page) && $current_page=="genre"){ echo 'active'; }?>">
                <div class="title"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Genre</div>
              </a> 
            </li> 
             <li>
              <a href="manage_movies.php" class="<?php if(isset($current_page) && $current_page=="movies"){ echo 'active'; }?>">
                <div class="title"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Movie</div>
              </a> 
            </li>   
          </ul>
        </li>

        <li class="dropdown-li series <?php if(isset($active_page) && $active_page=="series"){ echo 'active'; }?>">
          <a href="javascript:void(0)" class="dropdown-a">
            <div class="icon"> <i class="fa fa-list" aria-hidden="true"></i> </div>
            <div class="title">TV Series</div>
            <i class="fa fa-angle-right pull-right" style="padding-top: 7px;color: #fff;"></i>
          </a> 
        </li>
        <li class="cust-dropdown-container">
          <ul class="cust-dropdown">
            <li> 
              <a href="manage_series.php" class="<?php if(isset($current_page) && $current_page=="series"){ echo 'active'; }?>">
                <div class="title"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Series</div>
              </a> 
            </li>

            <li>
              <a href="manage_season.php" class="<?php if(isset($current_page) && $current_page=="season"){ echo 'active'; }?>">
                <div class="title"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Season</div>
              </a> 
            </li> 
             <li>
              <a href="manage_episode.php" class="<?php if(isset($current_page) && $current_page=="episode"){ echo 'active'; }?>">
                <div class="title"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Episode List</div>
              </a> 
            </li>   
          </ul>
        </li>

        <li class="dropdown-li channel <?php if(isset($active_page) && $active_page=="channel"){ echo 'active'; }?>">
          <a href="javascript:void(0)" class="dropdown-a">
            <div class="icon"> <i class="fa fa-tv" aria-hidden="true"></i> </div>
            <div class="title">Live TV</div>
            <i class="fa fa-angle-right pull-right" style="padding-top: 7px;color: #fff;"></i>
          </a> 
        </li>
        <li class="cust-dropdown-container">
          <ul class="cust-dropdown">
            <li>
              <a href="manage_category.php" class="<?php if(isset($current_page) && $current_page=="category"){ echo 'active'; }?>">
                <div class="title"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Category</div>
              </a> 
            </li> 
             <li>
              <a href="manage_channels.php" class="<?php if(isset($current_page) && $current_page=="channel"){ echo 'active'; }?>">
                <div class="title"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Channel</div>
              </a> 
            </li>   
          </ul>
        </li>
               
        <li <?php if($currentFile=="manage_users.php" or $currentFile=="add_user.php"){?>class="active"<?php }?>> <a href="manage_users.php">
          <div class="icon"> <i class="fa fa-users" aria-hidden="true"></i> </div>
          <div class="title">Users</div>
          </a> 
        </li>

        <li <?php if($currentFile=="manage_comments.php"){?>class="active"<?php }?>> <a href="manage_comments.php">
          <div class="icon"> <i class="fa fa-comments" aria-hidden="true"></i> </div>
          <div class="title">Comments</div>
          </a> 
        </li>

        <li <?php if($currentFile=="manage_reports.php" OR (isset($active_page) AND $active_page=='report')){?>class="active"<?php }?>> <a href="manage_reports.php">
          <div class="icon"> <i class="fa fa-bug" aria-hidden="true"></i> </div>
          <div class="title">Reports</div>
          </a> 
        </li>
         
        <li <?php if($currentFile=="send_notification.php"){?>class="active"<?php }?>> <a href="send_notification.php">
          <div class="icon"> <i class="fa fa-bell" aria-hidden="true"></i> </div>
          <div class="title">Notification</div>
          </a> 
        </li>

        <li <?php if($currentFile=="smtp_settings.php"){?>class="active"<?php }?>> <a href="smtp_settings.php">
          <div class="icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
          <div class="title">SMTP Settings</div>
          </a> 
        </li>

        <li <?php if($currentFile=="settings.php"){?>class="active"<?php }?>> <a href="settings.php">
          <div class="icon"> <i class="fa fa-cog" aria-hidden="true"></i> </div>
          <div class="title">Settings</div>
          </a> 
        </li>

        <li <?php if($currentFile=="verification.php"){?>class="active"<?php }?>> <a href="verification.php">
          <div class="icon"> <i class="fa fa-check-square-o" aria-hidden="true"></i> </div>
          <div class="title">Verify Purchase</div>
          </a> 
        </li>

        <?php if(file_exists('api.php') OR file_exists('ios_api.php')){?>
        <li <?php if($currentFile=="api_urls.php"){?>class="active"<?php }?>> <a href="api_urls.php">
          <div class="icon"> <i class="fa fa-exchange" aria-hidden="true"></i> </div>
          <div class="title">API URLS</div>
          </a> 
        </li> 
        <?php }?>
         
      </ul>
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
            <li class="navbar-title"><?=APP_NAME?></li>
             
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown profile"> <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown"> <?php if(PROFILE_IMG){?>               
                  <img class="profile-img" src="images/<?php echo PROFILE_IMG;?>">
                <?php }else{?>
                  <img class="profile-img" src="assets/images/profile.png">
                <?php }?>
              <div class="title">Profile</div>
              </a>
              <div class="dropdown-menu">
                <div class="profile-info">
                  <h4 class="username">Admin</h4>
                </div>
                <ul class="action">
                  <li><a href="profile.php">Profile</a></li>                  
                  <li><a href="logout.php">Logout</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

