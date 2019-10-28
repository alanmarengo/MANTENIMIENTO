<?php

include("../pgconfig.php");

$wkt = $_POST["wkt"];
$type = $_POST["type"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

if ($type == "LineString") {

	$query_string = "SELECT ST_Length(ST_GeomFromText('".$wkt."')) / 1000 AS km;";

}else{
	
	$query_string = "SELECT ST_Perimeter(ST_GeomFromText('".$wkt."')) / 1000 AS km,ST_Area(ST_GeomFromText('".$wkt."')) / 1000 AS area;";
	
}

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$area = $data["area"];

$data = explode(".",$data["km"]);

$data = $data[0] . "." . substr($data[1],0,2);

if ($type == "LineString") {

	echo "<p>Distancia: " . $data . " Km.</p>";
	
}else{
	
	echo "<p>Área: " . $area . " m2.</p>";
	echo "<p>Perímetro: " . $data . " Km.</p>";
	
}

?>