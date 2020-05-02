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

$defined = false;

if (in_array("ahrsc:vp_geo_hihgr_estuario_otr1",$layers_arr)) {
	
	die(4); // 939
	
}

if (in_array("ahrsc:polig_obra_pga",$layers_arr)) {
	
	die(1); // 875
	
}

if (in_array("ahrsc:vp_geo_hihgr_cuencamediabajarsc_otr1",$layers_arr)) {
	
	die(3); // 938
	
}

if (in_array("ahrsc:vp_geo_hihgr_cuencaaltarsc_otr1",$layers_arr)) {
	
	die(2); // 937
	
}

die(0); // 873

?>