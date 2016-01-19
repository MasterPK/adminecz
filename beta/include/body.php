<!DOCTYPE html>
<?php
$mysqli = new mysqli('localhost', 'root', 'axagoadmin23', 'ecz');
if ($mysqli->connect_error) {die('Nepodařilo se připojit k MySQL serveru (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);}
$mysqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$username=$_SESSION["username"];
$vysledek = $mysqli->query("SELECT username,Fname,Lname,ecz,IGN,athena_rank,registrace,avatar,last_activity,email FROM users WHERE username='".$_SESSION["username"]."';");
$vysledek2 = $vysledek->fetch_assoc();
$_SESSION["ecz"]=$vysledek2["ecz"];
$_SESSION["IGN"]=$vysledek2["IGN"];
$upozorneni = $mysqli->query("SELECT * FROM users WHERE ecz='0';");
$upozorneni = mysqli_num_rows($upozorneni);
$upozorneni1 = $mysqli->query("SELECT * FROM users WHERE ecz!='0';");
$upozorneni1 = mysqli_num_rows($upozorneni1);

switch ($_GET['id']) {
  case "profile":
  $nazevstranky="Profilová stránka";
  $level2_a="active";
  $level3_a="hide";
  $level2="Profil";
  break;


  case "edit_u":
  if($_SESSION["ecz"]==1){
    $nazevstranky="Zobrazit člena klanu - ".$_GET["name"];
    $level2_a="active";
    $level2="<a onclick='history.go(-1);'>Zobrazit člena klanu</a>";
    $level3_a="hide";
  }else{
    $nazevstranky="Upravit člena klanu - ".$_GET["name"];
    $level2_a="active";
    $level2="<a onclick='history.go(-1);'>Správa členů klanu</a>";
    $level3_a="active";
    $level3="Upravit člena klanu";
  };
  break;
  //nastavení
  case "set":
  $nazevstranky="Informace serveru";
  $psprava_a="active";
  $level2_a="active";
  $level2="Informace serveru";
  $level3_a="hide";
  break;
}
php?>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminECZ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
      <!-- Select2 -->
   <link rel="stylesheet" href="../plugins/select2/select2.min.css">
       <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">
          <link rel="stylesheet" href="../animate.css">
      

   

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      </head>

  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini" >
  <div class="wrapper ">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="./" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>e</b>CZ <sup class="label label-danger">BETA</sup></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>ECZ <sup><span class="label label-danger">BETA</span></sup></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Přepnout rozvržení</span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <? 
            $d = $mysqli->query("SELECT value FROM settings WHERE ID=\"2\";");
            $d = $d->fetch_assoc();
            echo"
            <!-- Dny klanu -->
            <li class='dropdown notifications-menu'>
              <!-- Menu toggle button -->
              <a href='#' class='dropdown-toggle ' data-toggle='dropdown'>
                <i class='fa fa-line-chart'></i>
                "."Od založení klanu uplynulo ".$d["value"]." dní
              </a>
            </li>";


            if($_SESSION["ecz"]==3){ echo"
              <!-- Notifications Menu -->
            <li class='dropdown notifications-menu'>
              <!-- Menu toggle button -->
              <a href='#' class='dropdown-toggle ' data-toggle='dropdown'>
                <i class='fa fa-user-plus'></i>
                <span class='label label-warning'>".$upozorneni." </span>
              </a>
              <ul class='dropdown-menu'>
                <li>
                  <!-- Inner Menu: contains the notifications -->
                  <ul class='menu'>
                    <li><!-- start notification -->
                      <a href='./?id=users_a'>
                        <i class='fa fa-user-plus text-aqua'></i>".$upozorneni." čekajících registrací na schválení
                      </a>
                    </li><!-- end notification -->
                  </ul>
                </li>
              </ul>
            </li>";
          };
          echo"
          <!-- Users Menu -->
          <li class='dropdown notifications-menu'>
            <!-- Menu toggle button -->
            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
              <i class='fa fa-user'></i>
              <span class='label label-success'>".$upozorneni1." </span>
            </a>
            <ul class='dropdown-menu'>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class='menu'>
                  <li><!-- start notification -->
                    <a href='./?id=vypis'>
                      <i class='fa fa-user text-aqua'></i>".$upozorneni1." řádných členů klanu
                    </a>
                  </li><!-- end notification -->
                </ul>
              </li>
            </ul>
          </li>";
          ?>
        

          <!-- User Account Menu -->
          <li class="dropdown user user-menu ">
            <!-- Menu Toggle Button -->
            <a href="#" id="profil_popup_click" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <?php
              echo "<img class='user-image' src='data:image/png;base64,".$vysledek2["avatar"]."'alt='User profile picture' >";
              php?>
              <span class="hidden-xs"><?php echo $vysledek2["Fname"]." ".$vysledek2["Lname"]; php?></span>
            </a>
            <ul id="profil_popup" class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <?php
                echo "<img class='img-circle' src='data:image/png;base64,".$vysledek2["avatar"]."'alt='User profile picture' >";  
                echo "<p>";
                $jmeno=$vysledek2["Fname"]." ".$vysledek2["Lname"]."<small>Registrován dne ";
                $datum_registrace=substr($vysledek2["registrace"], 8,2).".".substr($vysledek2["registrace"], 5,2).".".substr($vysledek2["registrace"], 0,4)."</small>";
                echo $jmeno.$datum_registrace; 
                php?>

              </p>
            </li>


            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="../profil/" class="btn btn-default btn-flat">Profilová stránka</a>
              </div>
              <div class="pull-right">
                <a href="./?id=logout" class="btn btn-default btn-flat">Odhlásit se</a>
              </div>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <?php
        echo "<img src='data:image/png;base64,".$vysledek2["avatar"]."'>'";
        php?>
      </div>
      <div class="pull-left info">
        <p><?php echo $vysledek2["Fname"]." ".$vysledek2["Lname"]; php?></p>
        <!-- Status -->
        <small><i class="fa fa-circle text-success"></i> Online</small>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">HLAVNÍ MENU</li>
      <!-- Optionally, you can add icons to the links -->
      <li class=<? echo $nastenka_a; ?>><a href="../"><i class="fa fa-dashboard"></i> <span>Nástěnka</span></a></li>
      <li class=<? echo $pzpravu_a; ?>><a href='../poslat_zpravu/'><i class='fa fa-inbox'></i> <span>Poslat zprávu</span></a></li>

      <?
      if($_SESSION["ecz"]>0){
        echo "
        <li  class='".$seznam_a."'><a href='../vypis/'><i class='fa fa-list'></i> <span>Jednoduchý výpis</span></a></li>";
        if($_SESSION["ecz"]>1){
          echo "
          <li class='".$pseznam_a."'><a href='../sprava_clenu/'><i class='fa fa-users'></i><span>Správa členů</span></a></li>
          ";
          if($_SESSION["ecz"]>2){
            echo "
          <li class='".$informace_levemenu."'><a href='../informace/'><i class='fa fa-gear'></i><span>Informace</span></a></li>
          ";
        };
        }else{
          echo "<li class='".$pseznam_a."'><a href='./?id=edit_u&name=".$vysledek2["IGN"]."'><i class='fa fa-users'></i><span>Výpis informací</span></a></li>";
        };
      };

      ?>




    </li>
  </ul><!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>

