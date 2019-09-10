<?php

include("./pgconfig.php");

$ind_id = $_POST["ind_id"];
$pos = $_POST["pos"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_indicadores.vw_recursos WHERE ind_id = $ind_id AND posicion = $pos LIMIT 1";
//$query_string = "SELECT * FROM mod_indicadores.vw_recursos WHERE ind_id = 1 AND posicion = 1";

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

if ((empty(trim($data["desc"]))) || (is_null(trim($data["desc"])))) {
	
	$desc = "Este indicador no posee una descripción asociada";
	
}else{
	
	$desc = $data["desc"];
	
}

$out = "{";
$out .= "\"titulo\":\"" . $data["titulo"] . "\",";
$out .= "\"desc\":\"" . $data["desc"] . "\"";
$out .= "}";

echo $out;


?>