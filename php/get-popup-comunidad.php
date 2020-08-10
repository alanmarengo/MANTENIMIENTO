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

$data = pg_fetch_assoc($query);

$html = "";
$html .= "<h2>" . $data["LUGAR ENCUENTRO"] . "</h2>";
$html .= "<h3>" . $data["MODALIDAD ENCUENTRO"] . "</h3>";
$html .= "<p>" . $data["TEMATICA ENCUENTRO"] . "</p>";

echo $html;

?>