<?
$vysledek = $mysqli->query("SELECT IGN,Fname,Lname,username,email,athena_rank,ecz,last_activity FROM users WHERE IGN='".$_GET["name"]."';"); 
$vysledek2 = $vysledek->fetch_assoc();
switch($vysledek2["ecz"]){
 case "0":$A="selected";
 break;
 case "1":$B="selected";
 break;
 case "2":$C="selected";
 break;
 case "3":$D="selected";
 break;
};
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

if($_SESSION["IGN"]==$vysledek2["IGN"]){ $disable="disabled";};
if($_SESSION["ecz"]=="2"){if(($vysledek2["ecz"]=="0")OR($vysledek2["ecz"]=="1")){$disable1="";}else{$disable1="disabled";};if(($vysledek2["ecz"]=="3")OR($vysledek2["ecz"]=="2")){$disablec="disabled";};};
if($_SESSION["ecz"]=="1"){$disable1="disabled";$disable="disabled";$disablec="disabled";}

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
  };


  ?>
  <!-- pozice v klanu -->
<div class="row">
  <div class="col-md-3">	
   <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Pozice v klanu</h3>
      <div class="box-tools pull-right">
        <!-- Buttons, labels, and many other things can be placed here! -->
        <!-- Here is a label for example -->
        <span class="label label-warning"></span>
      </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
     <form action=<? echo "./scripts/update_rank.php/?name=".$_GET["name"]; ?> method="post">
      <div class="form-group has-feedback">
        <select class="form-control" name="ecz" required <? echo $disable1; ?>>
          <option value ="0" <? echo $A; ?>>Čeká na potvrzení žádosti</option>
          <option value ="1" <? echo $B; ?>>Soldier</option>
          <option value ="2" <? echo $C; ?>>Officer</option>
          <?if($_SESSION["ecz"]==3){echo "<option value ='3' ".$D.">Commander</option>";};?>
        </select>

      </div>

      <div>
        <button type="submit" name="save" value="1" class="btn btn-primary btn-block btn-flat"<? echo $disable1; ?>>Uložit</button>
      </div><!-- /.col -->

    </form>
  </div><!-- /.box-body -->

</div>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Aktivita</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span class="label label-warning"></span>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
   <div class="form-group has-feedback">
    Poslední aktivita: <? 
    $aktivita=mktime(0,0,0,substr($vysledek2["last_activity"], 5,2),substr($vysledek2["last_activity"], 8,2),substr($vysledek2["last_activity"], 0,4));
    $d2=ceil((time()-$aktivita)/60/60/24);
    if($d2>15){$callout="label-warning";if($d2>30){$callout="label-danger";};}else{$callout="label-success";};
    if($d2<=1){$value=0;}else{$value=1;}
    echo "<div class='label ".$callout."'>".date("d.m.Y",$aktivita)."</div>"; 
    ?>
  </div>
  <form action=<? echo "./scripts/update_activity.php/?name=".$_GET["name"]."&IGN=".$_SESSION["IGN"]; ?> method="post">
    <div>
      <button type="submit" name="save2" value=<? echo $value; ?> class="btn btn-primary btn-block btn-flat"<? echo $disable; echo " ".$disablec; ?>>Zaznamenat aktivitu</button>
    </div><!-- /.col -->

  </form>

</div><!-- /.box-body -->

</div>
<div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Trvalé smazání účtu</h3>
              <div class="box-tools pull-right">

                <i class='fa fa-warning text-red'></i>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
            <button type="button" data-toggle="modal" data-target="#GSCCModal" class="btn btn-danger btn-flat btn-block" <? echo $disable; echo " ".$disablec; ?>>Smazat účet</button>
            </div>
          </div>
        </div>


<!-- výpis info -->
<div class="col-md-9">	
 <div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Výpis informací</h3>
    <div class="box-tools pull-right">

      <span class="label label-warning"></span>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
    <form action=<? echo "./scripts/update_athena.php/?name=".$_GET["name"]; ?> method="post">
     <div class="form-group">

      <label>Křestní jméno</label>
      <input type="text" class="form-control" value=<? echo $vysledek2["Fname"];?> disabled>
      <label>Příjmení</label>
      <input type="text" class="form-control" value=<? echo $vysledek2["Lname"];?> disabled>
      <label>E-mail</label>
      <input type="text" class="form-control" value=<? echo "'".$vysledek2["email"]."'";?> disabled>
      <label>IGN</label>
      <input type="text" class="form-control" value=<? echo $vysledek2["IGN"];?> disabled>
      <label>Athena rank</label>
      <select class="form-control" name="athena_rank" required <? echo $disable; echo " ".$disablec; ?>>
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
    </div>
     <table class="table no-padding" width="100%">
      <td class="col-md-12"></td>
      <td class="col-md-1"><button type="submit" name="save3" value="1" class="btn btn-primary btn-flat"<? echo $disable; echo " ".$disablec; ?>>Uložit údaje</button></td>
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
        <form action=<? echo "./scripts/delete_user.php/?name=".$vysledek2["IGN"]; ?> method="post">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
        <button type="submit" name="delete" value="1" class="btn btn-success">Potvrdit</button>
      </form>
      </div>
    </div>
  </div>
</div>
</div><!-- /.box-body -->

</div>
</div>

<!-- záznam aktivity -->
<div class="col-md-12" >	
 <div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Záznam událostí</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span class="label label-warning"></span>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body table-responsive no-padding">
   <table class="table table-hover" >
   <thead>
   <tr>
   
     <th>Datum</th>
     <th>Záznam</th>
     <th>Provedl</th>
   </tr>
 </thead>
<tbody>
     <?	$vysledek = $mysqli->query("SELECT date,class,text,admin FROM activity_log WHERE IGN='".$_GET["name"]."' ORDER BY date DESC;"); 
     if ($vysledek->num_rows > 0) {
       while($vysledek2 = $vysledek->fetch_assoc()){
        echo "

        <tr>
          <td>".substr($vysledek2["date"], 8,2).".".substr($vysledek2["date"], 5,2).".".substr($vysledek2["date"], 0,4)."</td>
          <td><span class='label ".$vysledek2["class"]."'>".$vysledek2["text"]."</span></td>
          <td>".$vysledek2["admin"]."</td>
        </tr>

        ";




      };
    }else{
      echo "<tr>
      <td>Žádné záznamy!</td>
      <td></td>
      <td></td>
    </tr>";

  };

  ?>
  </tbody>

</table>




</div><!-- /.box-body -->

</div>
</div>
</div>



<!-- /block -->