<?php

include("../pgconfig.php");

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);
	
$query_string = "SELECT * FROM ambiente.vp_ind_gepga_respprogr_pga1";

$query = pg_query($conn,$query_string);

$series = "";

while ($r = pg_fetch_assoc($query)) {
	
	$titulo = $r["titulo"];
	$etiqueta = $r["etiqueta"];
	
	$series .= "{";
	$series .= "\"name\":\"" . $r["sector"] . "\",";
	$series .= "\"y\":\"" . $r["valor"] . "\"";
	$series .= "},";
	
}

$series = substr($series,0,strlen($series)-1);

$json = "{";
$json .= "\"titulo\":\"" . $titulo . "\",";
$json .= "\"etiqueta\":\"" . $etiqueta . "\",";
$json .= "\"series\":[" . $series . "]";
$json .= "}";

echo $json;

?>