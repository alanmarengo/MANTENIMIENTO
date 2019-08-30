<?php

include("./pgconfig.php");

$ind_id = $_POST["ind_id"];
$pos = $_POST["pos"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

//$query_string = "SELECT * FROM mod_indicadores.vw_recursos WHERE ind_id = $ind_id AND posicion = $pos";
$query_string = "SELECT * FROM mod_indicadores.vw_recursos WHERE ind_id = 1 AND posicion = 1";

$query = pg_query($conn,$query_string);

$layer_id = array();
$layer_name = array();
$layer_server = array();

while($r = pg_fetch_assoc($query)) {
	
	switch($r["resource_type"]) {
		
		case "capa":
		$type = "capa";
		array_push($layer_id,$r["resource_id"]);
		array_push($layer_name,$r["layer_name"]);
		array_push($layer_server,$r["layer_server"]);
		break;
		
	}
	
}

$out = "";

switch($type) {
	
	case "capa":
	$out .= "{";
	$out .= "\"type\":\"layer\",";
	$out .= "\"layers\":[\"".implode("\",\"",$layer_name)."],";
	$out .= "\"layers_server\":[\"".implode("\",\"",$layer_server)."],";
	$out .= "}";
	break;
	
}

?>