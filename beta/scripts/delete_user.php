<?
$mysqli = new mysqli('localhost', 'root', 'axagoadmin23', 'ecz');
if ($mysqli->connect_error) {die('Nepodařilo se připojit k MySQL serveru (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);}
$mysqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

if ($_POST["delete"]=="1"){
	$query="DELETE FROM users WHERE IGN='".$_GET["name"]."';";
	$mysqli->query($query);
	$query="DELETE FROM activity_log WHERE IGN='".$_GET["name"]."';";
	$mysqli->query($query);
	header("location: ../../");
};

?>