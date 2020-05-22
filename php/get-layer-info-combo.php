<?php

include("../pgconfig.php");
include("../tools.php");

$results = $_POST["results"];

$gids = array();

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$qs = array();

$out = "";

for ($i=0; $i<sizeof($results); $i++) {
	
	$sep = explode(";",$results[$i]);
	
	$table = explode(":",$sep[0]);
	
	$query_string = "SELECT * FROM ah.\"".$table."\" WHERE id = " . $sep[1];
	echo $query_string . "<br>";
	$query = pg_query($conn,$query_string);
	
	$data = pg_fetch_assoc($query);
	
	$out .= "<p>" . $data["NOMBRE"] . "</p>";
	
}

echo $out;

?>