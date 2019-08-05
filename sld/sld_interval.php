<?php

include("./pgconfig.php");

$id = $_REQUEST['id'];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$SQL = "SELECT max(_valor_)as maxx, min(_valor_) as minn,((max(_valor_)-min(_valor_))/5)AS salto FROM mod_estadistica.get_mapeo_value($id);";

$recordset = pg_query($conn,$SQL);

$row = pg_fetch_row($recordset);

$max = $row[0];
$min = $row[1];
$salto = $row[3];
$acumulado = 0.0;

echo $max;
echo $min;
echo $salto;

echo $SQL;

pg_close($conn);

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
