<?php

include("../pgconfig.php");

$lon = $_POST["lon"];
$lat = $_POST["lat"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_geovisores.get_coord(100001,$lon,$lat)";
$query = pg_query($conn,$query_string);
$data = pg_fetch_assoc($query);
$lon10001 = $data["lon"];
$lat10001 = $data["lat"];

echo $query_string;

$query_string = "SELECT * FROM mod_geovisores.get_coord(100002,$lon,$lat)";
$query = pg_query($conn,$query_string);
$data = pg_fetch_assoc($query);
$lon10002 = $data["lon"];
$lat10002 = $data["lat"];

echo $query_string;

$query_string = "SELECT * FROM mod_geovisores.get_coord(100003,$lon,$lat)";
$query = pg_query($conn,$query_string);
$data = pg_fetch_assoc($query);
$lon10003 = $data["lon"];
$lat10003 = $data["lat"];

echo $query_string;

$json = "{";

$json .= "\"coord10001\":{\"lon\":\"$lon10001\",\"lat\":\"$lat10001\",\"label\":\"Condor Clift\"},";
$json .= "\"coord10002\":{\"lon\":\"$lon10002\",\"lat\":\"$lat10002\",\"label\":\"Barrancosa\"},";
$json .= "\"coord10003\":{\"lon\":\"$lon10003\",\"lat\":\"$lat10003\",\"label\":\"Lambert\"}";

$json .= "}";

echo $json;

?>