<?php
session_start();
date_default_timezone_set("Europe/Prague");
include "../include/check.php";// kontrola přihlášení a odhlášení
$pzpravu_a="active";
include "../include/body.php";// tělo stránky
?>

<!-- Centrální obsah -->
<div class="content-wrapper">
  <!-- Hlavička stránky -->
  <section class="content-header">
    <h1>
     Profil<!-- Název stránky -->
   </h1>
   <ol class="breadcrumb">
    <li><a href="./"><i class="fa fa-home"></i>Domů</a></li><!-- 1. úrověn -->
    <li></li><!-- 2. úrověn -->
  </ol>
  <!-- /Hlavička stránky -->

</section>
<!-- Hlavní obsah -->
<section class="content">
  <!-- row -->
  <div class="row">

      <!-- Main content -->

      <?
      $_SESSION["IGN"]=$vysledek2["IGN"];
      switch($vysledek2["athena_rank"]){
       case "L":$vysledek2["athena_rank"]="LIEUTENANT 1-5";$L="selected";
       break;
       case "C":$vysledek2["athena_rank"]="CAPTAIN 1-5";$C="selected";
       break;
       case "M":$vysledek2["athena_rank"]="MAJOR 1-5";$M="selected";
       break;
       case "C1":$vysledek2["athena_rank"]="COLONEL 1-3";$C1="selected";
       break;
       case "C4":$vysledek2["athena_rank"]="COLONEL 4-5";$C4="selected";
       break;
       case "G1":$vysledek2["athena_rank"]="GENERAL 1-2";$G1="selected";
       break;
       case "G3":$vysledek2["athena_rank"]="GENERAL 3";$G3="selected";
       break;
       case "G4":$vysledek2["athena_rank"]="GENERAL 4";$G4="selected";
       break;
       case "G5":$vysledek2["athena_rank"]="GENERAL 5";$G5="selected";
       break;
     };


     

// univerzální zobrazení chyby z db ($)
  if($_GET["err"]!=""){
    $vysledek = $mysqli->query("SELECT name,text,typ FROM hlasky WHERE ID='".$_GET["err"]."';"); 
    $vysledek3 = $vysledek->fetch_assoc();
    echo "
    <div class='alert ".$vysledek3["typ"]." alert-dismissable'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
      <h4><i class='icon fa fa-alert'></i> ".$vysledek3["name"]."</h4>
      ".$vysledek3["text"]."
    </div>
    " ;
    $_GET["err"]="";
  };?>
    
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
             <?php
             echo "<img class='profile-user-img img-responsive img-circle' src='data:image/png;base64,".$vysledek2["avatar"]."'alt='User profile picture' >";
             php?>
             <h3 class="profile-username text-center"><? echo $_SESSION["IGN"];?></h3>
             <h3 class="profile-username text-center"><?php echo $vysledek2["Fname"]." ".$vysledek2["Lname"] ?></h3>

             <p class="text-muted text-center">
              <?php 

              switch ($vysledek2["ecz"]) {
                case "0":
                echo "Čeká se na ověření členství administrátorem";
                break;
                case "1":
                echo "Řádný člen klanu";
                break;
                case "2":
                echo "Výkonný správce klanu";
                break;
                case "3":
                echo "Generální ředitel klanu";
              }


              ?></p>


            </div><!-- /.box-body -->
          </div><!-- /.box -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Trvalé smazání účtu</h3>
              <div class="box-tools pull-right">

                <i class='fa fa-warning text-red'></i>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
            <button type="button" data-toggle="modal" data-target="#GSCCModal" class="btn btn-danger btn-flat btn-block">Smazat účet</button>
            </div>
          </div>
        </div>
        <!-- About Me Box -->
        <!-- výpis info -->
        <div class="col-md-9">  
         <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Upravit údaje</h3>
            <div class="box-tools pull-right">

              <span class="label label-warning"></span>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
       
        
            <form action=<? echo "../scripts/update_user.php/?name=".$_SESSION["IGN"]; ?> method="post">
             <div class="form-group">

              <label>Křestní jméno</label>
              <input type="text" class="form-control" name="Fname" value=<? echo $vysledek2["Fname"];?> required>
              <label>Příjmení</label>
              <input type="text" class="form-control" name="Lname" value=<? echo $vysledek2["Lname"];?> required>
              <label>Athena rank</label>
              <select class="form-control" name="athena_rank" required>
                <option value ="L"<? echo $L; ?> >LIEUTENANT 1-5</option>
                <option value ="C"<? echo $C; ?> >CAPTAIN 1-5</option>
                <option value ="M"<? echo $M; ?> >MAJOR 1-5</option>
                <option value ="C1"<? echo $C1; ?> >COLONEL 1-3</option>
                <option value ="C4"<? echo $C4; ?> >COLONEL 4-5</option>
                <option value ="G1"<? echo $G1; ?> >GENERAL 1-2</option>
                <option value ="G3"<? echo $G3; ?> >GENERAL 3</option>
                <option value ="G4"<? echo $G4; ?> >GENERAL 4</option>
                <option value ="G5"<? echo $G5; ?> >GENERAL 5</option>
              </select>
              <label>E-mail</label>
              <input type="email" name="email" class="form-control" value=<? echo "'".$vysledek2["email"]."'";?> required>
            </div>
            <table class="table no-padding" width="100%">
              <td class="col-md-12"></td>
              <td class="col-md-1"><button type="submit" name="update" value="1" class="btn btn-primary btn-flat">Uložit údaje</button></td>
            </table>
          </form>
          <div id="GSCCModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-danger">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
                <h4 class="modal-title" id="myModalLabel">Opravdu?</h4>
              </div>
              <div class="modal-body">
                Opravdu chcete smazat uživatele <? echo $vysledek2["IGN"]; ?>?
              </div>
              <div class="modal-footer">
                <form action=<? echo "../scripts/delete_user.php/?name=".$_SESSION["IGN"]; ?> method="post">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
                  <button type="submit" name="delete" value="1" class="btn btn-success">Potvrdit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.box-body -->

    </div>
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Změnit heslo</h3>
        <div class="box-tools pull-right">

        </div><!-- /.box-header -->
        <div class="box-body">

          <form action=<? echo "../scripts/update_password.php/?name=".$_SESSION["IGN"]; ?> method="post">
           <div class="form-group">
            <label>Staré heslo</label>
            <input type="password" name="pwd0" class="form-control" required>
            <label>Nové heslo</label>
            <input type="password" name="pwd1" class="form-control" required>
            <label>Kontrola nového hesla</label>
            <input type="password" name="pwd2" class="form-control" required>
            <span class="label label-warning"></span>
          </div><!-- /.box-tools -->
          <table class="table no-padding" width="100%">
            <td class="col-md-12"></td>
            <td class="col-md-1"><button type="submit" name="password_change" value="1" class="btn btn-warning btn-flat">Změnit heslo</button></td>
          </table>
        </form>
      </div>
    </div>
  </div>
</div><!-- /.row -->





  </div>
 

  <!-- /.row -->
</section>
<!-- /.Hlavní obsah -->

  </div>
<!-- /Centrální obsah -->


<? include "../include/footer.php";// patička ?> 