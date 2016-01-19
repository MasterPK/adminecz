<?
$mysqli = new mysqli('localhost', 'root', 'axagoadmin23', 'ecz');
if ($mysqli->connect_error) {die('Nepodařilo se připojit k MySQL serveru (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);}
$mysqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

if ($_POST["save2"]=="1"){
	$query="UPDATE users SET last_activity=CURDATE() WHERE IGN='".$_GET["name"]."';";
	$mysqli->query($query);
	$query="INSERT INTO activity_log(date,class,text,IGN,admin) VALUES (CURDATE(),'label-success','Zaznamenaná aktivita','".$_GET["name"]."','".$_GET["IGN"]."') ;";
	$mysqli->query($query);
	header("location: ../../?id=edit_u&name=".$_GET["name"]."&err=5002");
}else{header("location: ../../?id=edit_u&name=".$_GET["name"]);};

?>