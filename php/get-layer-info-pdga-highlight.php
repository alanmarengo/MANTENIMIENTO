<?php

include("../pgconfig.php");
include("../tools.php");

$results = $_POST["results"];

//$results = array("ahrsc:vp_geo_limites_provinciales_sit_pga;0","ahrsc:vp_geo_limites_provinciales_sit_pga;0","ahrsc:polig_obra_pga;2","ahrsc:vp_geo_limites_provinciales_sit_pga;0","ahrsc:polig_obra_pga;2","ahrsc:vp_geo_limites_provinciales_sit_pga;0","ahrsc:polig_obra_pga;2","ahrsc:vp_geo_hihgr_cuencamediabajarsc_otr1;1","ahrsc:vp_geo_limites_provinciales_sit_pga;0","ahrsc:polig_obra_pga;2","ahrsc:vp_geo_hihgr_cuencamediabajarsc_otr1;1");

$layers_arr = array();

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

for ($i=0; $i<sizeof($results); $i++) {
	
	$sep = explode(";",$results[$i]);
	
	array_push($layers_arr,$sep[0]);
	
}

$layers_arr = array_unique($layers_arr);
$defined = false;

if ((in_array("ahrsc:vp_geo_hihgr_estuario_otr1",$layers_arr))) {
	
	$defined = true;
	echo 3; // 939 ++
	
}

if (((in_array("ahrsc:polig_obra_pga",$layers_arr)) && (!$defined))) {
	
	$defined = true;
	echo 4; // 875
	
}

if ((in_array("ahrsc:vp_geo_hihgr_cuencamediabajarsc_otr1",$layers_arr)) && (!$defined)) {
	
	$defined = true;
	echo 2; // 938
	
}

if ((in_array("ahrsc:vp_geo_hihgr_cuencaaltarsc_otr1",$layers_arr)) && (!$defined)) {
	
	$defined = true;
	echo 1; // 937
	
}

if (!$defined) {
	
	$defined = true;
	echo 0; // 873

}

?>