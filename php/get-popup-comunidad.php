<?php

include("../pgconfig.php");

$layer_id = $_POST["layer_id"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$table = $_POST["table"];
$lon = $_POST["lon"];
$lat = $_POST["lat"];

$query_string = "SELECT * FROM $table WHERE ST_Within(geom,ST_SetSRID(ST_Buffer(ST_GeomFromText('POINT($lon $lat)'), 0.5),4326));";

$query = pg_query($conn,$query_string);

$first = true;

while ($r = pg_fetch_assoc($query)) {
	
	if ($first) { $html .= "<hr>"; }
	
	$html .= "<h2><strong>Fecha: </strong>" . $data["FECHA"] . "</h2>";
	$html .= "<h3><strong>Lugar de Encuentro: </strong>" . $data["LUGAR_ENCUENTRO"] . "</h3>";
	$html .= "<p><strong>Modalidad: </strong>" . $data["MODALIDAD_ENCUENTRO"] . "</p>";
	$html .= "<p><strong>Temática: </strong>" . $data["TEMATICA_ENCUENTRO"] . "</p>";

	$first = false;
	
}

$data = pg_fetch_assoc($query);

echo $html;

?>