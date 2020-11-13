<?php

include("./pgconfig.php");
include("./tools.php");

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");

function clear_json($str) {
	
	$bad = array("\n","\r","\"");
	
	$good = array("","","");
	
	return str_replace($bad,$good,$str);
	
};

$mode 					= $_REQUEST["mode"];

$estacion_id			= clear_json(pg_escape_string($_REQUEST["estacion_id"]));
$tipo_estacion_id 		= clear_json(pg_escape_string($_REQUEST["tipo_estacion_id"]));
$solapa 				= clear_json(pg_escape_string($_REQUEST["solapa"]));
$categoria_parametro_id = clear_json(pg_escape_string($_REQUEST["categoria_parametro_id"]));

$parametro_id			= clear_json(pg_escape_string($_REQUEST["parametro_id"]));
$fd						= clear_json(pg_escape_string($_REQUEST["fd"]));
$fh						= clear_json(pg_escape_string($_REQUEST["fh"]));
$cod_temp				= clear_json(pg_escape_string($_REQUEST["cod_temp"]));

$tipo_estaciones		= clear_json(pg_escape_string($_REQUEST["tipo_estaciones"]));

$lista_estaciones		= clear_json(pg_escape_string($_REQUEST["lista_estaciones"]));/* Valores separados por coma */

$query_string    = "SELECT * ";
$query_string   .= " FROM mod_sensores.get_parametro_datos('$lista_estaciones'::text,$parametro_id::bigint,'$fd'::timestamp with time zone,'$fh'::timestamp with time zone) ";
$query_string   .= " ORDER BY estacion_nombre ASC;";

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	echo $query_string;
$conn = pg_connect($string_conn);

$query_string = decrypt($query_string);

$query = pg_query($conn,$query_string);

//echo $query;

$csv = parseSQLToCSV($query);

echo $csv;

pg_close($conn);

?>