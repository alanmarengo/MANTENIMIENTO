<?php

include("../pgconfig.php");

$wkt = $_POST["wkt"];
$layers = $_POST["layers"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_geovisores.gfi_buffer('" . $wkt . "','" . $implode(",",$layers) . "');";
echo $query_string;
/*$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$data = explode(".",$data["km"]);

$data = $data[0] . "." . substr($data[1],0,2);

echo "<p>" . $data . " Km.</p>";*/

?>