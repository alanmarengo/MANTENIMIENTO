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
		
		$query_tema_id_string = "SELECT tema_id,tema_nombre FROM mod_catalogo.temas WHERE tema_nombre IN('" . implode("','",explode(",",$r["temas"])) . "')";
		$query_tema_id = pg_query($conn,$query_tema_id_string);
		
		$tema_json = "";
		
		while ($t = pg_fetch_assoc($query_tema_id)) {
			
			$tema_json .= "{";
			$tema_json .= "\"id\":" . $t["tema_id"] . ",";
			$tema_json .= "\"nombre\":" . $t["tema_nombre"];
			$tema_json .= "},";
			
		}
		
		$tema_json = substr($tema_json,0,strlen($tema_json)-1);*/
		
		if (!$first) { $json .= "]},{"; } else { $json .= "{"; }
		$json .= "\"id\":\"" . $r["id"] . "\",";
		$json .= "\"name\":\"" . $r["programa"] . "\",";
		$json .= "\"temas\":[" . $tema_json . "],";
		$json .= "\"data\":{";
			$json .= "\"rubro\":\"" . $r["rubro"] . "\",";
			$json .= "\"categoria\":\"" . $r["categoria"] . "\",";
			$json .= "\"etapa\":\"" . $r["etapa"] . "\",";
			$json .= "\"instituciones_interv\":\"" . $r["instituciones_interv"] . "\",";
			$json .= "\"respons_nom\":\"" . $r["respons_nom"] . "\"";
		$json .= "}";
		$json .= ",\"subprogramas\":[";
		
		$interCount = 0;
		
		//if ($first) { $json = str_replace("[},","[",$json); }
		
	}
	
	if ($interCount > 0) {
	
		$json .= "{";
		
		$json .= "\"id\":\"" . $r["id"] . "\",";
		$json .= "\"name\":\"" . $r["programa"] . "\",";
		$json .= "\"temas\":[\"" . implode("\",\"",explode(",",$r["temas"])) . "\"],";
		$json .= "\"data\":{";
			$json .= "\"rubro\":\"" . $r["rubro"] . "\",";
			$json .= "\"categoria\":\"" . $r["categoria"] . "\",";
			$json .= "\"etapa\":\"" . $r["etapa"] . "\",";
			$json .= "\"instituciones_interv\":\"" . $r["instituciones_interv"] . "\",";
			$json .= "\"respons_nom\":\"" . $r["respons_nom"] . "\"";
		$json .= "}";
		
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