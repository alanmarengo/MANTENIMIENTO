<?php

include("../pgconfig.php");
include("../tools.php");

$results = $_POST["results"];

$layers_arr = array();

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

for ($i=0; $i<sizeof($results); $i++) {
	
	$sep = explode(";",$results[$i]);
	
	array_push($layers_arr,$sep[0]);
	array_push($layer_desc_arr,$layer_desc);
	
}

$layers_arr = array_unique($layers_arr);

var_dump($layers_arr);

?>