<?php

include("../pgconfig.php");
include("../tools.php");

header('Content-Type: application/json');

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = " SELECT 
 	pr.*,
	(SELECT COUNT(*) FROM ambiente.vw_programas WHERE split_part = pr.split_part) AS tsp
   FROM ambiente.vw_programas pr ORDER BY split_part ASC, \"id\" ASC";

$query = pg_query($conn,$query_string);

$json = "{\"programas\":[";

$split_part = "-1";
$progCount = 0;
$interCount = 0;
$first = true;
$pretsp = false;

while($r = pg_fetch_assoc($query)) {
	
	if ($split_part != $r["split_part"]) {
		
		if ((!$first) && ($pretsp>1)) { $json = substr($json,0,strlen($json)-1); }
		
		$progCount ++;
		
		$split_part = $r["split_part"];
		
		if (!$first) { $json .= "]},{"; } else { $json .= "{"; }
		$json .= "\"id\":\"" . $r["id"] . "\",";
		$json .= "\"name\":\"" . $r["programa"] . "\",";
		$json .= "\"temas\":[\"" . implode("\",\"",explode(",",$r["temas"])) . "\"]";
		$json .= ",\"subprogramas\":[";
		
		$interCount = 0;
		
		//if ($first) { $json = str_replace("[},","[",$json); }
		
	}
	
	if ($interCount > 0) {
	
		$json .= "{";
		
		$json .= "\"id\":\"" . $r["id"] . "\",";
		$json .= "\"name\":\"" . $r["programa"] . "\",";
		$json .= "\"temas\":[\"" . implode("\",\"",explode(",",$r["temas"])) . "\"]";
		
		$json .= "},";
	
	}else{
		
		$interCount++;
		
	}
	
	$first = false;
	
	$pretsp = $r["tsp"];
	
}

if ($pretsp>1) { $json = substr($json,0,strlen($json)-1); }
$json .= "]}]}";

echo $json;

pg_close($conn);

?>