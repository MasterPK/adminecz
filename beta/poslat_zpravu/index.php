<?php
session_start();
date_default_timezone_set("Europe/Prague");
include "../include/check.php";
$pzpravu_a="active";
include "../include/body.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Poslat zprávu
   </h1>
   <ol class="breadcrumb">
    <li><a href="./"><i class="fa fa-home"></i>Domů</a></li>
    <li>Poslat zprávu</li>
  </ol>

</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Napsat novou zprávu</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

          <div class="form-group">

          <select class="form-control select2" multiple="multiple" data-placeholder="  Příjemce:" style="width: 100%;">
              <?php
              $queryResult = $mysqli->query("SELECT IGN,ecz FROM users ORDER BY IGN ASC;");
              if ($queryResult->num_rows > 0) {

                while($row = $queryResult->fetch_assoc()) {
                  switch($row["ecz"]){
                    case 0:$row["ecz"]="Čeká na potvrzení";
                    break;
                    case 1:$row["ecz"]="Soldier";
                    break;
                    case 2:$row["ecz"]="Officer";
                    break;
                    case 3:$row["ecz"]="Commander";
                    break;
                  };
                  echo "<option>".$row["IGN"]."</option>";
                }
              };



              ?>
            </select>
          </div><!-- /.form-group -->
          <div class="form-group">
            <input class="form-control" placeholder="Předmět:">
          </div>
          <div class="form-group">
            <textarea id="compose-textarea" class="form-control" style="height: 300px">
            </textarea>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Odeslat</button>
          </div>
        </div><!-- /.box-footer -->
      </div><!-- /. box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<? include "../include/footer.php"; ?>