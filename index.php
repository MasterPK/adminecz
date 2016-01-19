<?php
session_start();
date_default_timezone_set("Europe/Prague");
//konstrukce
//header("location: ./construction/");
	if($_GET["id"]=="logout"){
		session_destroy();
		header("location: ./");
	}elseif($_SESSION['logged-fast']==1){
		header("location: ./uvod/");
	}else{
		$username=$_POST['username'];
		$password=$_POST['password'];
		$mysqli = new mysqli('localhost', 'root', 'axagoadmin23', 'ecz');
		if ($mysqli->connect_error) {die('Nepodařilo se připojit k MySQL serveru (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);}
		$mysqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		$vysledek = $mysqli->query("SELECT password FROM users WHERE username='".$username."';");
		$vysledek2 = $vysledek->fetch_assoc();

		if(password_verify($password,$vysledek2["password"])){
			
			
			$_SESSION["username"]=$username;
			$_SESSION["logged-fast"]=1;
			$_SESSION["passwd"]="axagoadmin23";
			header("location: ./uvod/");

		}
		else{
			if($_POST['logclick']==1){$_SESSION['error']=1001;}
			header("location: ./login/");
			
		}
	};

	php?>


	