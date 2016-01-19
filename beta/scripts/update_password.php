<?
$mysqli = new mysqli('localhost', 'root', 'axagoadmin23', 'ecz');
if ($mysqli->connect_error) {die('Nepodařilo se připojit k MySQL serveru (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);}
$mysqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

if (($_POST["password_change"]=="1")){
	$query="SELECT password FROM users WHERE IGN='".$_GET["name"]."';";
	$vysledek = $mysqli->query($query);
	$vysledek2 = $vysledek->fetch_assoc();
	if(($_POST["pwd1"]!="")AND($_POST["pwd0"]!="")){
		if(password_verify($_POST["pwd0"],$vysledek2["password"])){
			if($_POST["pwd1"]==$_POST["pwd2"]){
				$query="UPDATE users SET password='".password_hash($_POST['pwd1'],PASSWORD_BCRYPT)."' WHERE IGN='".$_GET["name"]."';";
				$mysqli->query($query);
				
				header("location: ../../?id=profile&err=5002");
			}else{header("location: ../../?id=profile&err=1051");};

		}else{header("location: ../../?id=profile&err=1051");};
	}else{header("location: ../../?id=profile&err=1051");};
};