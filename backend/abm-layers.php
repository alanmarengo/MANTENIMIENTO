
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

switch ($mode) 
{
    case 0: /* BUSCAR CAPAS */
        layers_buscar($s);
        break;
    case 1: /* NUEVA/ACTUALIZAR CAPA */
        layers_guardar();
        break;
    case 2: /* BORRAR CAPA */
        layers_borrar();
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



function layers_subtema_nuevo($_layer_id,$_subtema_id)
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);

	$query_string .="INSERT INTO sinia_geovisor.layer_subtema(layer_id,subtema_id)VALUES($_layer_id,$_subtema_id) RETURNING layer_id;";

	$query = pg_query($conn,$query_string);
	
	if(!$query)
	{
		$error_1 = clear_json(pg_last_error($conn));
		echo '{"status_code":"2","status":"No se pudo cargar el registro","error_desc":"'.$error_1.'"}';
	}
	else
	{
		$r = pg_fetch_assoc($query);
		echo '{"status_code":"0","status":"Ok","layer_id":"'. $r["layer_id"].'"}';
	};
	
	pg_close($conn);
};

function layers_subtema_borrar($layer_id,$subtema_id)
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);

	$query_string .="DELETE FROM sinia_geovisor.layer_subtema WHERE layer_id=$layer_id AND subtema_id=$subtema_id RETURNING layer_id;";

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

function layers_borrar_old()
{
	global $_layer_id;
		
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);

	$query_string .="DELETE FROM sinia_geovisor.layer WHERE layer_id=$_layer_id RETURNING layer_id;";

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


function layers_guardar_old()
{
	global $_layer_id;
	global $_layer_titulo;
	global $_layer_desc;
	global $_layer_wms_layer;
	global $_layer_wms_server;
	global $_layer_link_metadato;
	global $_palabras_clave;
	global $_columna_clave_gfi;
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	if($_layer_id==-1)
	{
		$query_string = "INSERT INTO sinia_geovisor.layer(tipo_geom_id,layer_titulo,layer_desc,layer_wms_layer,layer_wms_server,layer_link_metadato,palabras_clave,columna_clave_gfi)VALUES";
		$query_string .="(1,'$_layer_titulo','$_layer_desc','$_layer_wms_layer','$_layer_wms_server','$_layer_link_metadato','$_palabras_clave','$_columna_clave_gfi')RETURNING layer_id;";
	}
	else
	{
		$query_string = "UPDATE sinia_geovisor.layer SET ";
		$query_string .="layer_titulo = '$_layer_titulo',";
		$query_string .="layer_desc = '$_layer_desc',";
		$query_string .="layer_wms_layer = '$_layer_wms_layer',";
		$query_string .="layer_wms_server = '$_layer_wms_server',";
		$query_string .="layer_link_metadato = '$_layer_link_metadato',";
		$query_string .="columna_clave_gfi = '$_columna_clave_gfi',";
		$query_string .="palabras_clave = '$_palabras_clave' ";
		$query_string .="WHERE layer_id=$_layer_id RETURNING layer_id;";
	};
	
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

function layers_buscar($busqueda) 
{
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT * FROM mod_geovisores.layer WHERE layer_desc ILIKE '%$busqueda%' ORDER BY layer_desc ASC";

	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	//echo pg_last_error($conn);
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) 
	{
		//$url_preview_t = wms_get_layer_preview(clear_json($r["layer_wms_server"]),clear_json($r["layer_wms_layer"]));
		
		$json .= '{';
		$json .= '"layer_id":"'					. 	$r["layer_id"] .'",';
		$json .= '"layer_desc":"'				. 	clear_json($r["layer_desc"]) .'",';
		$json .= '"layer_wms_server":"'			. 	clear_json($r["layer_wms_server"]) .'",';
		$json .= '"layer_wms_layer":"'			. 	clear_json($r["layer_wms_layer"]) .'",';
		$json .= '"layer_wms_server_alter":"'	. 	clear_json($r["layer_wms_server_alter"]) .'",';
		$json .= '"layer_wms_layer_alter":"'	. 	clear_json($r["layer_wms_layer_alter"]) .'",';
		$json .= '"layer_alter_activo":"'		. 	clear_json($r["layer_alter_activo"]) .'",';
		$json .= '"layer_metadata_url":"'		. 	clear_json($r["layer_metadata_url"]) .'",';
		$json .= '"layer_wms_sld":"'			. 	clear_json($r["layer_wms_sld"]) .'",';
		$json .= '"layer_schema":"'				. 	clear_json($r["layer_schema"]) .'",';
		$json .= '"layer_table":"'				. 	clear_json($r["layer_table"]) .'",';
		$json .= '"tipo_layer_id":"'			. 	clear_json($r["tipo_layer_id"]) .'",';
		$json .= '"tipo_origen_id":"'			. 	clear_json($r["tipo_origen_id"]) .'",';
		$json .= '"preview_desc":"'				. 	clear_json($r["preview_desc"]) .'",';
		$json .= '"preview_link":"'				. 	clear_json($r["preview_link"]) .'",';
		$json .= '"preview_titulo":"'			. 	clear_json($r["preview_titulo"]) .'"';
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

function get_subtemas($busqueda) 
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT subtema_id,subtema_titulo||' - Tema '||tema_nombre AS subtema_titulo FROM sinia_catalogo.vw_subtema_tema WHERE subtema_titulo||tema_nombre ILIKE '%$busqueda%' ORDER BY subtema_desc ASC";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) {
		
		$json .= "{";
		$json .= "\"subtema_id\":" . $r["subtema_id"] . ",";
		$json .= "\"subtema_titulo\":\"" . clear_json($r["subtema_titulo"]) . "\"";
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

function get_subtemas_capa($_layer_id) 
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string  = "SELECT layer_id,subtema_id,";
	$query_string .= "(SELECT subtema_titulo||' - Tema '||tema_nombre FROM sinia_catalogo.vw_subtema_tema  T WHERE T.subtema_id=LS.subtema_id limit 1) AS stn ";
	$query_string .= "FROM sinia_geovisor.layer_subtema LS WHERE LS.layer_id=$_layer_id;";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) {
		
		$json .= "{";
		$json .= "\"layer_id\":" . $r["layer_id"] . ",";
		$json .= "\"subtema_id\":" . $r["subtema_id"] . ",";
		$json .= "\"subtema_titulo\":\"" . clear_json($r["stn"]) . "\"";
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

function get_datos_recursos($busqueda) 
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string  = "SELECT * FROM (";
	$query_string .= "SELECT 'Grafico'::TEXT AS tipo_dato,grafico_titulo as titulo,grafico_desc AS desc,grafico_id as dato_id,0 as dato_tipo_id,'./types/indicadores.png' as ico from sinia_graficos.grafico ";
	$query_string .= "UNION ALL ";
	$query_string .= "SELECT 'Recurso'::TEXT AS tipo_dato,titulo,descripcion as desc,origen_id_propio dato_id,1 as dato_tipo_id,ico_path as ico from sinia_recursos.vw_catalogo "; 
	$query_string .= ")T WHERE T.titulo ILIKE '%$busqueda%' ORDER BY titulo ASC;";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) {
		
		$json .= '{';
		$json .= '"tipo_dato":"'.		clear_json($r["tipo_dato"]).'",';
		$json .= '"titulo":"'.	clear_json($r["titulo"]).'",';
		//$json .= '"desc":"'.clear_json($r["desc"]).'",';
		$json .= '"dato_id":"'.clear_json($r["dato_id"]).'",';
		$json .= '"dato_tipo_id":"'.		clear_json($r["dato_tipo_id"]).'",';
		$json .= '"ico":"'.	clear_json($r["ico"]).'"';
		$json .= '},';
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

function get_datos_recursos_capa($layer_id) 
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string  = "SELECT *,D.layer_id,D.layer_gid FROM (";
	$query_string .= "SELECT 'Grafico'::TEXT AS tipo_dato,grafico_titulo as titulo,grafico_desc AS desc,grafico_id as dato_id,0 as dato_tipo_id,'./types/indicadores.png' as ico from sinia_graficos.grafico ";
	$query_string .= "UNION ALL ";
	$query_string .= "SELECT 'Recurso'::TEXT AS tipo_dato,titulo,descripcion as desc,origen_id_propio dato_id,1 as dato_tipo_id,ico_path as ico from sinia_recursos.vw_catalogo "; 
	$query_string .= ")T INNER JOIN sinia_geovisor.capa_fila_datos D ON T.dato_tipo_id=D.entidad_tipo AND T.dato_id=D.entidad_id ";
	$query_string .= " WHERE D.layer_id=$layer_id;";
	
	$query = pg_query($conn,$query_string);
	
	$entered = false;
	
	$json = "[";
	
	while ($r = pg_fetch_assoc($query)) {
		
		$json .= '{';
		$json .= '"layer_id":"'.		clear_json($r["layer_id"]).'",';
		$json .= '"tipo_dato":"'.		clear_json($r["tipo_dato"]).'",';
		$json .= '"titulo":"'.	clear_json($r["titulo"]).'",';
		$json .= '"layer_gid":"'.clear_json($r["layer_gid"]).'",';
		$json .= '"dato_id":"'.clear_json($r["dato_id"]).'",';
		$json .= '"dato_tipo_id":"'.		clear_json($r["dato_tipo_id"]).'",';
		$json .= '"ico":"'.	clear_json($r["ico"]).'"';
		$json .= '},';
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

function layers_datos_nuevo($layer_id,$entidad_id,$entidad_tipo,$gid)
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);

	$query_string ="INSERT INTO sinia_geovisor.capa_fila_datos(layer_id,layer_gid,entidad_id,entidad_tipo)VALUES($layer_id,$gid,$entidad_id,$entidad_tipo) RETURNING layer_id;";

	$query = pg_query($conn,$query_string);
	
	if(!$query)
	{
		$error_1 = clear_json(pg_last_error($conn));
		echo '{"status_code":"2","status":"No se pudo cargar el registro","error_desc":"'.$error_1.'"}';
	}
	else
	{
		$r = pg_fetch_assoc($query);
		echo '{"status_code":"0","status":"Ok","layer_id":"'. $r["layer_id"].'"}';
	};
	
	pg_close($conn);
};

function layers_datos_borrar($layer_id,$entidad_id,$entidad_tipo,$gid)
{
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);

	$query_string .="DELETE FROM sinia_geovisor.capa_fila_datos WHERE ";
	$query_string .="layer_id=$layer_id AND layer_gid=$gid AND entidad_id=$entidad_id AND entidad_tipo=$entidad_tipo RETURNING layer_id;";
	
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




?>
