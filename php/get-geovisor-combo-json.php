<?php

include("../pgconfig.php");

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$sections = array("AHRSC","Cóndor Cliff","La Barrancosa","Línea de Alta Tensión");

$lists = array();
$lists[0] = "844,644,836,841";
$lists[1] = "818,819,820,821,822,823,824,851,848,850,841,845";
$lists[2] = "825,826,827,828,829,852,847,849,841,846";
$lists[3] = "815,854,853,841,846";

$json = "[";

for ($i=0; $i<sizeof($sections); $i++) {
	
	$json .= "{";
	$json .= "\"index\":" . $i . ",";
	$json .= "\"label\":\"" . $sections[$i] . "\",";
	$json .= "\"layers\":[";
	
	$query_string = "SELECT * FROM mod_geovisores.vw_layers WHERE layer_id IN(" . $lists[$i] . ") ORDER BY preview_title ASC";
	
	$query = pg_query($conn,$query_string);
	
	while($r = pg_fetch_assoc($query)) {
		
		$json .= "{";
		$json .= "\"layer_id\":" . $r["layer_id"] . ",";
		$json .= "\"schema\":\"" . $r["layer_schema"] . "\",";
		$json .= "\"layer\":\"" . $r["layer_wms_layer"] . "\",";
		$json .= "\"componente\":\"" . $r["preview_titulo"] . "\"";
		$json .= "},";
		
	}

	$json = substr($json,0,strlen($json)-1);
	
	$json .= "]";
	$json .= "},";
	
}

$json = substr($json,0,strlen($json)-1) . "]";

echo $json;