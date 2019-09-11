<?php
//header("Content-Type: image/jpg");

include("./pgconfig.php");

$error_preview_img 	= './images/3.jpg';

$recurso_id = $_REQUEST['r'];
$origen_id  = $_REQUEST['origen_id'];


$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$SQL = "SELECT origen_id_especifico,origen,origen_id FROM mod_catalogo.vw_catalogo_data R WHERE origen_id_especifico=$recurso_id  AND origen_id=$origen_id limit 1;";

$recordset = pg_query($conn,$SQL);

$row = pg_fetch_row($recordset);

$recurso_id 	= $row[0];
$origen		 	= $row[1];
$origen_id	 	= $row[2];

pg_close($conn);


function wms_preview($capa_id)
{

 $wms_request = "";

 global $string_conn;
 
 $conn = pg_connect($string_conn);

 $SQL = "SELECT layer_wms_server,layer_wms_layer,layer_schema,layer_table FROM mod_geovisores.layer L WHERE L.layer_id = $capa_id limit 1;";

 $recordset = pg_query($conn,$SQL);

 $row = pg_fetch_row($recordset);

 $wms_server 		= $row[0];
 $wms_layer		 	= $row[1];
 $schema	 		= $row[2];
 $tabla				= $row[3];
 
 $SQL = "";
 $SQL = $SQL."SELECT ";
 $SQL = $SQL."st_xmin(st_expand(st_extent(st_transform(T.geom, 4326)), 1::double precision)::box3d) AS minx,";
 $SQL = $SQL."st_ymin(st_expand(st_extent(st_transform(T.geom, 4326)), 1::double precision)::box3d) AS miny,";
 $SQL = $SQL."st_xmax(st_expand(st_extent(st_transform(T.geom, 4326)), 1::double precision)::box3d) AS maxx,";
 $SQL = $SQL."st_ymax(st_expand(st_extent(st_transform(T.geom, 4326)), 1::double precision)::box3d) AS maxy";
 $SQL = $SQL." FROM \"$schema\".\"$tabla\" T";
 
 $recordset = pg_query($conn,$SQL);

 $row = pg_fetch_row($recordset);
 
 $minx 		= $row[0];
 $miny		= $row[1];
 $maxx	 	= $row[2];
 $maxy		= $row[3];
 
 pg_close($conn);
 
 $wms_request = $wms_server."&SERVICE=WMS&VERSION=1.1.0&REQUEST=GetMap&LAYERS=$wms_layer&STYLES=&SRS=EPSG:4326&BBOX=$minx,$miny,$maxx,$maxy&WIDTH=300&HEIGHT=300&FORMAT=image/png&";
 //echo $wms_request;
 
 header("Content-Type: image/jpg");
 $data = file_get_contents($wms_request);
 
 if($data)
 {
	echo $data; 
 }
 else
 {
	$data = file_get_contents($error_preview_img);
	echo $data;
 };
 
 
};


$cache_path = './cache/';

/*
 * 5: Mediateca
 * 0: GIS
 */

switch($origen_id)
{
	case  5:
			header("Content-Type: image/jpg");
			$data = file_get_contents($cache_path.$recurso_id.'.jpg');
			
			if($data)
			{
				echo $data; 
			}
			 else
			{
				$data = file_get_contents($error_preview_img);
				echo $data;
			};
			
		break;
	case 0: wms_preview($recurso_id); break;
	case 1: break;
	case 2: break;
	case 3: break;
	case 4: break;
	
	default:
};

//http://observatorio.net/mediateca_preview.php?r=443&origen_id=0
//http://observatorio.net/mediateca_preview.php?r=4&origen_id=5


?> 
