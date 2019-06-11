<?php

include("../pgconfig.php");

$geovid = $_POST["geovid"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_geovisores.geovisor_capa_inicial WHERE geovisor_id = " . $geovid;

$query = pg_query($conn,$query_string);

$json = "{\"data\":[";

while ($r = pg_fetch_assoc($query)) {
	
	$json .= "{";
	$json .= "\"layer_id\":" . $r["layer_id"] . ",";
	$json .= "\"iniciar_visible\":\"" . $r["iniciar_visible"] . "\",";
	$json .= "\"iniciar_panel\":\"" . $r["iniciar_panel"] . "\"";
	$json .= "}";
	
}

$json .= "]}";

echo $json;

?>