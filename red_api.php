<?php

header('Content-Type: application/json');

include("./pgconfig.php");

function clear_json($str) {
	
	$bad = array("\n","\r","\"");
	
	$good = array("","","");
	
	return str_replace($bad,$good,$str);
	
};

$mode 				= $_REQUEST["mode"];

$estacion_id		= clear_json(pg_escape_string($_REQUEST["estacion_id"]));
$tipo_estacion_id 	= clear_json(pg_escape_string($_REQUEST["tipo_estacion_id"]));
$solapa 			= clear_json(pg_escape_string($_REQUEST["solapa"]));


switch ($mode) 
{
    case 0:
        hidro_get_solapa_desc($estacion_id,$tipo_estacion_id);
        break;
    case 1: 
        aforo_get_solapa_desc($estacion_id);
        break;
    case 2:
        hidro_get_solapa_datos_diarios($estacion_id,$tipo_estacion_id);
        break;   
};


/*************** MODO 0 HIDROMETRICAS ************/

function hidro_get_solapa_desc($estacion_id,$tipo_estacion_id)
{
	//http://observ.net/red_api.php?estacion_id=6&tipo_estacion_id=1&mode=0
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	//mod_sensores.vp_tab_descaforos_pga1 y mod_sensores.vp_tab_deschidroambiental_pga1
	
	$query_string    = "SELECT *";
	$query_string   .= " FROM mod_sensores.vp_tab_deschidroambiental_pga1 ";
	$query_string   .= "WHERE estacion_id=$estacion_id AND tipo_estacionid=$tipo_estacion_id;";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) 
	{
		
		$json .= '{';
		$json .= '"tab":"descripcion",';
		$json .= '"estacion_id":"' 		. clear_json($r["estacion_id"]) . '",';
		$json .= '"tipo_estacion_id":"' 	. clear_json($r["tipo_estacionid"]) . '",';
		$json .= '"estacion":"' 		. clear_json($r["estacion"]) . '",';
		$json .= '"foto_estacion":"' 	. clear_json($r["foto_estacion"]) . '",';
		$json .= '"tipo":"' 			. clear_json($r["tipo"]) . '",';
		$json .= '"lat":"' 				. clear_json($r["lat"]) . '",';
		$json .= '"long":"' 			. clear_json($r["long"]) . '",';
		$json .= '"localizacion":"' 	. clear_json($r["localizacion"]) . '",';
		$json .= '"id_orig":"' 			. clear_json($r["id_orig"]) . '",';
		$json .= '"parametros":"' 		. clear_json($r["parametros"]) . '",';
		$json .= '"inicio_opera":"' 	. clear_json($r["inicio_opera"]) . '",';
		$json .= '"objetivo":"' 		. clear_json($r["objetivo"]) . '",';
		$json .= '"proveedor":"' 		. clear_json($r["proveedor"]) . '"';
		$json .= "},";

		$entered = true;
	}
	
	if($entered) 
	{
		$json = substr($json,0,strlen($json)-1);
	};
	
	$json .= "]";
	
	echo $json;
	
	pg_close($conn);
	
};

/*************** MODO 1 AFORO ************/

function aforo_get_solapa_desc($estacion_id)
{
	//http://observ.net/red_api.php?estacion_id=9&tipo_estacion_id=4&mode=1
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	//mod_sensores.vp_tab_descaforos_pga1 y mod_sensores.vp_tab_deschidroambiental_pga1
	
	$query_string   = "SELECT * FROM mod_sensores.vp_tab_descaforos_pga1 ";
	$query_string  .= "WHERE id_aforo=$estacion_id;";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) 
	{
		
		$json .= '{';
		$json .= '"tab":"descripcion",';
		$json .= '"id":"' 					. clear_json($r["id"]) . '",';
		$json .= '"id_aforo":"' 			. clear_json($r["id_aforo"]) . '",';
		$json .= '"foto_estacion":"' 		. clear_json($r["foto_estacion"]) . '",';
		$json .= '"seccion":"' 				. clear_json($r["seccion"]) . '",';
		$json .= '"lat":"' 					. clear_json($r["lat"]) . '",';
		$json .= '"long":"' 				. clear_json($r["long"]) . '",';
		$json .= '"met_aforo":"' 			. clear_json($r["met_aforo"]) . '",';
		$json .= '"met_vert":"' 			. clear_json($r["met_vert"]) . '",';
		$json .= '"inicio_camp":"' 			. clear_json($r["inicio_camp"]) . '",';
		$json .= '"proveedor":"' 			. clear_json($r["proveedor"]) . '"';
		$json .= "},";

		$entered = true;
	}
	
	if($entered) 
	{
		$json = substr($json,0,strlen($json)-1);
	};
	
	$json .= "]";
	
	echo $json;
	
	pg_close($conn);
	
};


/*************** MODO 2 hidrometricas ************/

function hidro_get_solapa_datos_diarios($estacion_id,$tipo_estacion_id)
{
	//http://observ.net/red_api.php?estacion_id=7&tipo_estacion_id=4&mode=2
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string   = "SELECT * FROM mod_sensores.get_estacion_datos_diarios($estacion_id,$tipo_estacion_id) ";
	$query_string  .= "ORDER BY parametro_nombre ASC;";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) 
	{
		
		$json .= '{';
		$json .= '"tab":"datos diarios",';
		$json .= '"estacion_id":"' 		. clear_json($r["estacion_id"]) . '",';
		$json .= '"estacion_tipo":"' 	. clear_json($r["estacion_tipo"]) . '",';
		$json .= '"parametro_id":"' 	. clear_json($r["parametro_id"]) . '",';
		$json .= '"parametro_nombre":"' . clear_json($r["parametro_nombre"]) . '",';
		$json .= '"ultimo_dato":"' 		. clear_json($r["ultimo_dato"]) . '",';
		$json .= '"min_dato":"' 		. clear_json($r["min_dato"]) . '",';
		$json .= '"med_dato":"' 		. clear_json($r["med_dato"]) . '",';
		$json .= '"max_dato":"' 		. clear_json($r["max_dato"]) . '",';
		$json .= '"fecha_dato":"' 		. clear_json($r["fecha_dato"]) . '",';
		$json .= '"url_grafico":"' 		. clear_json($r["url_grafico"]) . '"';
		$json .= "},";

		$entered = true;
	}
	
	if($entered) 
	{
		$json = substr($json,0,strlen($json)-1);
	};
	
	$json .= "]";
	
	echo $json;
	
	pg_close($conn);
	
};







?>
