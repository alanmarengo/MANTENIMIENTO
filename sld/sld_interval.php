<?php

include("./pgconfig.php");

$id = $_REQUEST['id'];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$SQL = "SELECT max(valor)as maxx, min(valor) as minn,((max(valor)-min(valor))/5)AS salto FROM mod_estadistica.dt_layer_data WHERE id=$id;";

$recordset = pg_query($conn,$SQL);

$row = pg_fetch_row($recordset);

$max = $row[0];
$min = $row[1];
$salto = $row[3];
$acumulado = 0.0;

pg_close($conn);

/*
const _POINT_   =0;
const _LINE_    =1;
const _POLYGON_ =2;
*/

//$type_geom	= $_REQUEST['type_geom'		];
//$main_color 	= $_REQUEST['main_color'	];
//$layer_name 	= $_REQUEST['layer_name'	];
//$size			= $_REQUEST['size'			];
//$border_color = $_REQUEST['border_color'	];
//$border_size 	= $_REQUEST['border_size'	];

/*
switch ($type_geom) 
{
    case _POINT_	:$sld_file 	= file_get_contents("./point.sld");	$layer_name = '';	break;
    case _LINE_		:$sld_file 	= file_get_contents("./line.sld");	$layer_name = '';	break;
    case _POLYGON_	:$sld_file 	= file_get_contents("./intervalo_polygon.sld");	$layer_name = 'intervalos_polygons'; break;
};
*/

$sld_file 	= file_get_contents("./intervalo_polygon.sld");	$layer_name = 'intervalos_polygons';

$sld_file	= str_replace("[layer_name]"	, $layer_name	,$sld_file		);

$sld_file	= str_replace("[1_D]"	, $acumulado ,$sld_file);
$acumulado  = $acumulado +$salto;
$sld_file	= str_replace("[1_H]"	, $acumulado	,$sld_file);

$sld_file	= str_replace("[2_D]"	, $acumulado+1 ,$sld_file);
$acumulado  = $acumulado +$salto;
$sld_file	= str_replace("[2_H]"	, $acumulado	,$sld_file);

$sld_file	= str_replace("[3_D]"	, $acumulado+1 ,$sld_file);
$acumulado  = $acumulado +$salto;
$sld_file	= str_replace("[3_H]"	, $acumulado	,$sld_file);

$sld_file	= str_replace("[4_D]"	, $acumulado+1 ,$sld_file);
$acumulado  = $acumulado +$salto;
$sld_file	= str_replace("[4_H]"	, $acumulado	,$sld_file);

$sld_file	= str_replace("[5_D]"	, $acumulado+1 ,$sld_file);
$acumulado  = $acumulado +$salto;
$sld_file	= str_replace("[5_H]"	, $acumulado	,$sld_file);

echo $sld_file;

?>
