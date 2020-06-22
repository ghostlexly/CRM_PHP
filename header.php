<?php require("$_SERVER[DOCUMENT_ROOT]/config/database.php"); require("$_SERVER[DOCUMENT_ROOT]/check_connected.php"); ?>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title>WATS Customer Relationship Management</title>
  <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/vendors.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/morris.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/custom.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
  <!-- END Custom CSS-->
  <!-- BEGIN Custom CSS WATS -->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/custom.css">
  <!-- END Custom CSS WATS -->
  <link rel="stylesheet" type="text/css" href="/app-assets/css/animate.css">

  <!-- jQuery-->
  <script src="/assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
</head>

<?php include('posts_clean.php'); ?>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto">
            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
              <i class="ft-menu font-large-1"></i>
            </a>
          </li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="/index.php">
              <img class="brand-logo" alt="modern admin logo" src="/app-assets/images/wats/header/logo_wats_blanc.png">
              <h4 class="crm-text">Customer Relationship Management</h4>
            </a>
          </li>




          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block">
              <a class="nav-link nav-link-expand" href="#">
                <i class="ficon ft-maximize"></i>
              </a>
            </li>
            <form method="GET" action="/search/search-results.php">
              <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
                <div class="search-input">
                  <input name="q" class="input searchbar" type="text" placeholder="Rechercher..." autocomplete="off">
                </div>
              </li>
            </form>
          </ul>





          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hello,
                  <span class="user-name text-bold-700"><?php echo strtoupper($UserInfos['nom']) . ' ' . ucfirst(strtolower($UserInfos['prenom'])); ?></span>
                </span>
                <span class="avatar avatar-online">
                  <img src="/app-assets/images/wats/header/logo-w.png" alt="avatar"><i></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">
                <i class="ft-user"></i> Editer le profil</a>
                <a class="dropdown-item" href="#">
                  <i class="ft-check-square"></i> Taskworld
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/connexion/deconnexion.php">
                  <i class="ft-power"></i> Déconnexion
                </a>
              </div>
            </li>








            <!-- NOTIFICATIONS -->
            <?php include("$_SERVER[DOCUMENT_ROOT]/notifications.php"); ?>
            <li class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown" OnClick="ReadedNotifs();"><i class="ficon ft-bell"></i>
                <span class="badge badge-pill badge-default badge-default badge-up badge-glow <? if(!$notifications_readed) { echo "badge-danger"; } ?>"><?= sizeof($notifications); ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0">
                    <span class="grey darken-2">Notifications</span>
                  </h6>
                  <span class="notification-tag badge badge-default badge-danger float-right m-0"><?= sizeof($notifications); ?> Nouveau(x)</span>
                </li>
                <li class="scrollable-container media-list w-100">

                      <?php
                      foreach($notifications as $this_notif) {
                          ?>
                          <a href="/clients/details-client.php?id=<?= $this_notif['id_client']; ?>">
                              <div class="media">
                                <div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i></div>
                                <div class="media-body">
                                  <h6 class="media-heading yellow darken-3"><?= $this_notif['titre']; ?></h6>
                                  <p class="notification-text font-small-3 text-muted"><?= $this_notif['message']; ?></p>
                                </div>
                              </div>
                          </a>
                          <?
                      }
                      ?>
                </li>
                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Voir toutes les notifications</a></li>
              </ul>
            </li>



            <script>
              function ReadedNotifs() {
                $.ajax({
                          type: "POST",
                          data: "readed_notifs_post=true;",
                          url: "/notifications.php",
                          error: function(xhr, statusText) {
                            alert("Un problème est survenu: "+statusText);
                          },
                          success: function(result){
                             console.log('Readed notifications.');
                          }
                    });
              }
            </script>







          </ul>
        </div>
      </div>
    </div>
  </nav>
