<?php

include("../pgconfig.php");
include("../tools.php");

$results = $_POST["results"];

$layer_id_arr = array();
$layer_desc_arr = array();

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

var_dump($results);

/*
for ($i=0; $i<sizeof($results); $i++) {
	
	$sep = explode(";",$results[$i]);
	
	$qs_name = "SELECT layer_id,layer_desc FROM mod_geovisores.vw_layers WHERE trim(layer_wms_layer) = '" . trim($sep[0]) . "' LIMIT 1";
	$qs_query = pg_query($conn,$qs_name);
	$qs_name_data = pg_fetch_assoc($qs_query);
	$layer_id = $qs_name_data["layer_id"];
	$layer_desc = $qs_name_data["layer_desc"];
	
	array_push($layer_id_arr,$layer_id);
	array_push($layer_desc_arr,$layer_desc);
	
}*/

?>