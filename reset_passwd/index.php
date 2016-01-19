<?
if($_POST["reset"]==1){
  $mysqli = new mysqli('localhost', 'root', 'axagoadmin23', 'ecz');
  if ($mysqli->connect_error) {die('Nepodařilo se připojit k MySQL serveru (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);}
  $mysqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
  $vysledek = $mysqli->query("SELECT email,username,Fname,Lname FROM users WHERE email='".$_POST["mail"]."';");
  $vysledek2 = $vysledek->fetch_assoc();
  if($vysledek2["email"]!=""){
    $pwd1=chr(rand(48,126)) . chr(rand(48,126)) . chr(rand(48,126)) . chr(rand(48,126)) . chr(rand(48,126));
    $query="UPDATE users SET password='".password_hash($pwd1,PASSWORD_BCRYPT)."' WHERE email='".$_POST["mail"]."';";
    $mysqli->query($query);
    exec("touch /mnt/sda1/web/1/".$vysledek2['username'].".sh");
    exec("chmod 777 /mnt/sda1/web/1/".$vysledek2['username'].".sh");
    exec("echo 'cat /mnt/sda1/web/1/".$vysledek2['username'].".txt | msmtp --debug -a outlook ".$vysledek2["email"]."' > /mnt/sda1/web/1/".$vysledek2['username'].".sh");
    $exec="echo \"From: ecz-clan@outlook.cz\nTo: ".$vysledek2["email"]."\nSubject: Obnoveni hesla!\nDobrý den ".$vysledek2['Fname']." ".$vysledek2['Lname'].",\n\n Zasíláme Vám nové přihlašovací údaje:\n\nVaše uživatelské jméno: ".$vysledek2["username"]."\nVáš registrační email: ".$vysledek2['email']."\nVaše nové heslo: ".$pwd1."\n\nVaše nové heslo je nyní aktivní. Je důležité heslo z bezpečnostních důvodů co nejdříve změnit. Děkujeme.\nMůžete se kdykoliv přihlásit na adrese:\nhttp://www.ecz-clan.tk\n\nS pozdravem tým eCZ\n\nToto je automaticky generovaný mail!\nPokud máte nějaké dotazy kontaktujte nás na adrese ecz-clan@outlook.cz.\" > /mnt/sda1/web/1/".$vysledek2["username"].".txt";
    exec($exec);
    exec("/mnt/sda1/web/1/".$vysledek2['username'].".sh");
    exec("rm /mnt/sda1/web/1/".$vysledek2["username"].".txt");
    exec("rm /mnt/sda1/web/1/".$vysledek2["username"].".sh");
    $_SESSION["error"]=5003;
    header("location: /");
  };
};
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminECZ | Obnovení hesla</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="../animate.css">
  <link rel="stylesheet" href="../style1.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      </head>
      <body class="hold-transition login-page animated fadeIn">

        <div class="login-box animated fadeIn">
          <div class="login-box-body">
            <div class="login-logo">
              <a href=""><b>Admin</b>ECZ</a>
            </div><!-- /.login-logo -->
            <!-- <hr align="center" noshade> -->
            <p class="login-box-msg">Zadejte email, který byl použit při registraci.</p>
            <?php

  // univerzální zobrazení chyby z db ($)
            if($_SESSION["error"]!=""){
              $vysledek = $mysqli->query("SELECT name,text,typ FROM hlasky WHERE ID='".$_SESSION["error"]."';"); 
              $vysledek2 = $vysledek->fetch_assoc();
              echo "
              <div class='alert ".$vysledek2["typ"]." alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>".$vysledek2["name"]."</h4>
                ".$vysledek2["text"]."
              </div>
              " ;
              $_SESSION["error"]="";
            };
            php?>
            <form action="/reset_passwd/" method="POST">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Váš e-mail" name="mail" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <button type="submit" name="reset" value="1" class="btn btn-primary btn-block btn-flat">Odeslat</button>
                </div><!-- /.col -->
              </div>
            </form>
            <a href="mailto:ecz-clan@outlook.cz">Technická podpora</a><br>
            <a href="../" onclick="">Přihlásit se</a><br>
            <a href="../register/" class="text-center">Nemáte účet? Registrujte se zde</a>

          </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="../plugins/iCheck/icheck.min.js"></script>
        <script>
          $(function () {
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
          });
        </script>

      </body>

      </html>
