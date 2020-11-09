

<?php

/*
include("../login.php"); 

if (isset($_SESSION)) 
{
	if (sizeof($_SESSION) == 0) 
	{
		die('{"status_code":"5","status":"No tiene permisos para realizar esta acción","error_desc":"No tiene permisos para realizar esta acción"}');
	};
}
else
{
	die('{"status_code":"4","status":"Usuario no valido","error_desc":"Usuario no valido"}');
};*/


header('Content-Type: application/json');

include("../pgconfig.php");

function clear_json($str) {
	
	$bad = array("\n","\r","\"");
	
	$good = array("","","");
	
	return str_replace($bad,$good,$str);
	
}

$mode 	= $_REQUEST["mode"];

$s 		= clear_json(pg_escape_string($_REQUEST["s"]));

$layer_id				=$_REQUEST['layer_id'];
$layer_desc				=$_REQUEST['layer_desc'];
$layer_wms_server		=$_REQUEST['layer_wms_server'];
$layer_wms_layer		=$_REQUEST['layer_wms_layer'];
$layer_wms_server_alter	=$_REQUEST['layer_wms_server_alter'];
$layer_wms_layer_alter	=$_REQUEST['layer_wms_layer_alter']; 
$layer_alter_activo		=$_REQUEST['layer_alter_activo']; 	
$layer_metadata_url		=$_REQUEST['layer_metadata_url']; 	
$layer_schema			=$_REQUEST['layer_schema']; 			
$layer_table			=$_REQUEST['layer_table']; 			
$tipo_layer_id			=$_REQUEST['tipo_layer_id']; 		
$preview_desc			=$_REQUEST['preview_desc']; 			
$preview_titulo			=$_REQUEST['preview_titulo'];

$geovisor_id				=$_REQUEST['geovisor_id'];
$geovisor_desc				=$_REQUEST['geovisor_desc'];
$geovisor_extent			=$_REQUEST['geovisor_extent'];


switch ($mode) 
{
    case 0: /* BUSCAR CAPAS */
        geovisor_buscar($s);
        break;
    case 1: /* NUEVA/ACTUALIZAR CAPA */
        layers_guardar();
        break;
    case 2: /* BORRAR CAPA */
        layers_borrar();
        break;
    case 3: /* AGREGAR A CATALOGO */
        catalogo_agregar();
        break;
    case 4: /* BUSCAR CAPAS */
         get_capas($s) ;
        break;
    case 5: /* BUSCAR CAPAS */
         get_capas_geovisor($geovisor_id);
        break;
         
};


function layers_borrar()
{
	global $layer_id;
		
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);

	$query_string .="DELETE FROM mod_geovisores.layer WHERE layer_id=$layer_id RETURNING layer_id;";

	$query = pg_query($conn,$query_string);
	
	if(!$query)
	{
		$error_1 = clear_json(pg_last_error($conn));
		echo '{"status_code":"2","status":"No se pudo borrar el registro","error_desc":"'.$error_1.'"}';
	}
	else
	{
		$r = pg_fetch_assoc($query);
		echo '{"status_code":"0","status":"Ok","layer_id":"'. $r["layer_id"].'"}';
	};
	
	pg_close($conn);
	
};

function catalogo_agregar()
{
    global	$layer_id;
	global	$layer_schema;			
	global	$layer_table;	
	global	$layer_desc;
	global	$preview_desc;		
	global	$preview_titulo;
	
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string  = "DELETE FROM mod_geovisores.catalogo WHERE origen_id=0 AND origen_id_especifico=$layer_id;";
	$query_string .= "INSERT INTO mod_geovisores.catalogo(origen,origen_id,origen_id_especifico,origen_search_text,subclase_id,estudios_id,cod_esia_id,cod_temporalidad_id,objetos_id) ";
	$query_string .= "SELECT DISTINCT 'GIS'::TEXT,0::BIGINT,";
	$query_string .= "$layer_id::BIGINT,";
	$query_string .= "'$layer_desc $preview_desc $preview_titulo',";
	$query_string .= "subclase_id::BIGINT,estudios_id::BIGINT,cod_esia_id::BIGINT,cod_temporalidad_id::BIGINT,objetos_id::bigint ";
	$query_string .= "FROM $layer_schema.$layer_table;";
		
	$query = pg_query($conn,$query_string);
	
	if(!$query)
	{
		$error_1 = clear_json(pg_last_error($conn));
		
		/* Valores por default */
		$query_string  = "DELETE FROM mod_geovisores.catalogo WHERE origen_id=0 AND origen_id_especifico=$layer_id;";
		$query_string .= "INSERT INTO mod_geovisores.catalogo(origen,origen_id,origen_id_especifico,origen_search_text,subclase_id,estudios_id,cod_esia_id,cod_temporalidad_id,objetos_id) ";
		$query_string .= "SELECT 'GIS'::TEXT,0::BIGINT,";
		$query_string .= "$layer_id::BIGINT,";
		$query_string .= "'$layer_desc $preview_desc $preview_titulo',";
		$query_string .= "1::BIGINT,NULL::BIGINT,NULL::BIGINT,NULL::BIGINT,NULL::bigint; ";
		
		$query = pg_query($conn,$query_string);
				
		$error_2 = clear_json(pg_last_error($conn));
		
		$error_1 .= ' '.$error_2;
		
		echo '{"status_code":"1","status":"No se pudo guardar los datos en el catalogo,por favor controle que existan los campos requeridos","error_desc":"'.$error_1.'"}';
	}
	else
	{
		$r = pg_fetch_assoc($query);
		echo '{"status_code":"0","status":"Ok","layer_id":"'. $layer_id.'"}';
	};
	
	pg_close($conn);
	
};



function layers_guardar()
{
	global	$layer_id;
	global	$layer_desc;
	global	$layer_wms_server;
	global	$layer_wms_layer;
	global	$layer_wms_server_alter;
	global	$layer_wms_layer_alter; 
	global	$layer_alter_activo;
	global	$layer_metadata_url;	
	global	$layer_schema;			
	global	$layer_table;	
	global	$tipo_layer_id;	
	global	$preview_desc;		
	global	$preview_titulo;
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	if($layer_id==-1)
	{
		$query_string = "INSERT INTO mod_geovisores.layer(";
		$query_string .= "layer_desc,";
		$query_string .= "layer_wms_server,";
		$query_string .= "layer_wms_layer,";
		$query_string .= "layer_wms_server_alter,";
		$query_string .= "layer_wms_layer_alter,";
		$query_string .= "layer_alter_activo,";
		$query_string .= "layer_metadata_url,";	
		$query_string .= "layer_schema,";	
		$query_string .= "layer_table,";
		$query_string .= "tipo_layer_id,";	
		$query_string .= "preview_desc,";
		$query_string .= "tipo_origen_id,";		
		$query_string .= "preview_titulo";
		$query_string .=")VALUES(";
		$query_string .= "'$layer_desc',";
		$query_string .= "'$layer_wms_server',";
		$query_string .= "'$layer_wms_layer',";
		$query_string .= "'$layer_wms_server_alter',";
		$query_string .= "'$layer_wms_layer_alter',";
		$query_string .= "'$layer_alter_activo',";
		$query_string .= "'$layer_metadata_url',";
		$query_string .= "'$layer_schema',";
		$query_string .= "'$layer_table',";
		$query_string .= "$tipo_layer_id,";	
		$query_string .= "'$preview_desc',";
		$query_string .= "1,";
		$query_string .= "'$preview_titulo'";
		$query_string .= ")RETURNING layer_id;";
	
	}
	else
	{
		
		$query_string = "UPDATE  mod_geovisores.layer SET ";
		$query_string .="layer_desc = '$layer_desc',";
		$query_string .="layer_wms_server = '$layer_wms_server',";
		$query_string .="layer_wms_layer = '$layer_wms_layer',";
		$query_string .="layer_wms_server_alter = '$layer_wms_server_alter',";
		$query_string .="layer_wms_layer_alter= '$layer_wms_layer_alter',";
		$query_string .="layer_alter_activo = '$layer_alter_activo',";
		$query_string .="layer_metadata_url = '$layer_metadata_url',";
		$query_string .="layer_schema = '$layer_schema',";		
		$query_string .="layer_table = '$layer_table',";
		$query_string .="tipo_layer_id = $tipo_layer_id,";	
		$query_string .="preview_desc = '$preview_desc',";	
		$query_string .="preview_titulo = '$preview_titulo' ";
		$query_string .="WHERE layer_id=$layer_id RETURNING layer_id;";
	
	};
    
    //echo $query_string;
    
	$query = pg_query($conn,$query_string);
	
	if(!$query)
	{
		$error_1 = clear_json(pg_last_error($conn));
		echo '{"status_code":"1","status":"No se puedo guardar","error_desc":"'.$error_1.'"}';
	}
	else
	{
		$r = pg_fetch_assoc($query);
		echo '{"status_code":"0","status":"Ok","layer_id":"'. $r["layer_id"].'"}';
	};
	
	pg_close($conn);
	
};




function geovisor_buscar($busqueda) 
{
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT * FROM  mod_geovisores.geovisor WHERE geovisor_desc ILIKE '%$busqueda%' ORDER BY geovisor_desc ASC";

	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) 
	{
		$json .= '{';
		$json .= '"geovisor_id":"'					. 	$r["geovisor_id"] .'",';
		$json .= '"geovisor_desc":"'				. 	clear_json($r["geovisor_desc"]) .'",';
		$json .= '"geovisor_extent":"'				. 	clear_json($r["geovisor_extent"]) .'"';
		$json .= "},";
		

		$entered = true;
	}
	
	if ($entered) 
	{
		$json = substr($json,0,strlen($json)-1);
	};
	
	$json .= "]";
	
	echo $json;
	
	pg_close($conn);

};

function get_capas($busqueda) 
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT layer_id,layer_desc,preview_titulo,preview_desc FROM mod_geovisores.layer WHERE layer_desc||preview_titulo ILIKE '%$busqueda%' ORDER BY layer_desc ASC";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) {
		
		$json .= "{";
		$json .= "\"layer_id\":" . $r["layer_id"] . ",";
		$json .= "\"layer_desc\":\"" . clear_json($r["layer_desc"]) . "\",";
		$json .= "\"preview_titulo\":\"" . clear_json($r["preview_titulo"]) . "\",";
		$json .= "\"preview_desc\":\"" . clear_json($r["preview_desc"]) . "\"";
		$json .= "},";
		//var_dump($r);
		$entered = true;
	}
	
	if ($entered) {
		
		$json = substr($json,0,strlen($json)-1);
		
	}
	
	$json .= "]";
	
	echo $json;
	
	pg_close($conn);

};

function get_capas_geovisor($geovisor_id) 
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string = "select *,";
	$query_string .= "(SELECT layer_desc FROM mod_geovisores.layer L WHERE L.layer_id=G.layer_id)AS nombre_capa ";
	$query_string .= "FROM mod_geovisores.geovisor_capa_inicial G WHERE geovisor_id=$geovisor_id;";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) {
		
		$json .= "{";
		$json .= "\"geovisor_id\":" . $r["geovisor_id"] . ",";
		$json .= "\"layer_id\":\"" . clear_json($r["layer_id"]) . "\",";
		$json .= "\"nombre_capa\":\"" . clear_json($r["nombre_capa"]) . "\",";
		$json .= "\"iniciar_visible\":\"" . clear_json($r["iniciar_visible"]) . "\"";
		$json .= "},";
		//var_dump($r);
		$entered = true;
	}
	
	if ($entered) {
		
		$json = substr($json,0,strlen($json)-1);
		
	}
	
	$json .= "]";
	
	echo $json;
	
	pg_close($conn);

};






?>
