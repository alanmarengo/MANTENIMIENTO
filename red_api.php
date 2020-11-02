<?php

header('Content-Type: application/json');

include("./pgconfig.php");

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
    case 3:
		hidro_get_estacion_parametros($estacion_id,$categoria_parametro_id);
		break;
	case 4:
		hidro_get_solapa_datos_fechas($estacion_id,$categoria_parametro_id,$parametro_id,$fd,$fh);
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
		$json .= '"tab":"Hidro - descripcion",';
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
		$json .= '"proveedor":"' 		. clear_json($r["proveedor"]) . '",';
		$json .= '"categoria_parametros":' . get_estacion_categorias_parametros($estacion_id) . '';
		
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

function hidro_get_estacion_parametros($estacion_id,$categoria_parametro_id)
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string    = "SELECT parametro_id,parametro_desc||parametro_unidad AS parametro ";
	$query_string   .= " FROM mod_sensores.vw_red_monitoreo ";
	$query_string   .= " WHERE estacion_id=$estacion_id AND categoria_parametro_id=$categoria_parametro_id;";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) 
	{
		
		$json .= '{';
		$json .= '"parametro_id":"' 		. clear_json($r["parametro_id"]) . '",';
		$json .= '"parametro_nombre":"' 	. clear_json($r["parametro"]) . '"';
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

function get_estacion_categorias_parametros($estacion_id)
{
	//http://observ.net/red_api.php?estacion_id=9&tipo_estacion_id=4&mode=1
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	//mod_sensores.vp_tab_descaforos_pga1 y mod_sensores.vp_tab_deschidroambiental_pga1
	
	$query_string   = "SELECT DISTINCT categoria_parametro_id,categoria_parametro_desc FROM mod_sensores.vw_red_monitoreo ";
	$query_string  .= "WHERE estacion_id=$estacion_id;";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) 
	{
		
		$json .= '{';
		$json .= '"categoria_parametro_id":"' . clear_json($r["categoria_parametro_id"]) . '",';
		$json .= '"categoria_parametro_desc":"' . clear_json($r["categoria_parametro_desc"]) . '"';
		$json .= "},";

		$entered = true;
	}
	
	if($entered) 
	{
		$json = substr($json,0,strlen($json)-1);
	};
	
	$json .= "]";
	
	pg_close($conn);
	
	return $json;
	
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
		$json .= '"tab":"Aforo - descripcion",';
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

function hidro_get_solapa_datos_diarios($estacion_id,$tipo_categoria_parametro_id)
{
	//http://observ.net/red_api.php?estacion_id=7&tipo_estacion_id=4&mode=2
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string   = "SELECT * FROM mod_sensores.get_estacion_datos_diarios($estacion_id,$tipo_categoria_parametro_id) ";
	$query_string  .= "ORDER BY parametro_nombre ASC;";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) 
	{
		
		$json .= '{';
		$json .= '"tab":"Hidro - datos diarios",';
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

function hidro_get_solapa_datos_fechas($estacion_id,$tipo_categoria_parametro_id,$parametro_id,$fd,$fh)
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string   = "SELECT * FROM mod_sensores.get_estacion_datos_fechas($estacion_id::bigint,$parametro_id::bigint,$tipo_categoria_parametro_id::bigint,'$fd'::timestamp with time zone,'$fd'::timestamp with time zone) ";
	$query_string  .= "ORDER BY parametro_nombre ASC;";
	
	//echo $query_string;
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) 
	{
		
		$json .= '{';
		$json .= '"tab":"Hidro - consultar datos",';
		$json .= '"estacion_id":"' 		. clear_json($r["estacion_id"]) . '",';
		$json .= '"categoria_parametro_id":"' 	. clear_json($r["categoria_parametro_id"]) . '",';
		$json .= '"parametro_id":"' 	. clear_json($r["parametro_id"]) . '",';
		$json .= '"parametro_nombre":"' . clear_json($r["parametro_nombre"]) . '",';
		$json .= '"min_dato":"' 		. clear_json($r["min_valor"]) . '",';
		$json .= '"med_dato":"' 		. clear_json($r["med_valor"]) . '",';
		$json .= '"max_dato":"' 		. clear_json($r["max_valor"]) . '",';
		$json .= '"url_grafico":"' 		. './get_grafico.php?definir=0' . '"';
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
