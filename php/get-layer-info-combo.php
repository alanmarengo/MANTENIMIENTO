<?php

include("../pgconfig.php");
include("../tools.php");

$results = $_POST["results"];

$gids = array();

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

for ($i=0; $i<sizeof($results); $i++) {
	
	$sep = explode(";",$results[$i]);
	
	array_push($gids,$sep[1]);
	
}

$query_string = "SELECT * FROM ah.\"".$sep[0]."\" WHERE id IN(" . implode(",",$gids) . ")";

$query = pg_query($conn,$query_string);

while ($r = pg_fetch_assoc($query)) {
	
	echo "<p>" . $r["identificacion"] . "</p>";
	
}

?>