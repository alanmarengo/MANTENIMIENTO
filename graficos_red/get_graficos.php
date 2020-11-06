<html>
<head>
	
<script src="https://code.highcharts.com/highcharts.js"></script>

<?php

include("../pgconfig.php");

function clear_json($str) 
{
	
	$bad = array("\n","\r","\"");
	
	$good = array("","","");
	
	return str_replace($bad,$good,$str);
	
};

$mode 					= $_REQUEST["mode"];

$estacion_id			= clear_json(pg_escape_string($_REQUEST["estacion_id"]));
$parametro_id			= clear_json(pg_escape_string($_REQUEST["parametro_id"]));
$tipo_estacion_id 		= clear_json(pg_escape_string($_REQUEST["tipo_estacion_id"]));
$solapa 				= clear_json(pg_escape_string($_REQUEST["solapa"]));
$categoria_parametro_id = clear_json(pg_escape_string($_REQUEST["categoria_parametro_id"]));

function get_estacion_parametro_grafico_30_dias($estacion_id,$categoria_parametro_id,$parametro_id)
{
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string   = "SELECT * FROM mod_sensores.get_estacion_parametro_grafico_30_dias($estacion_id,$categoria_parametro_id,$parametro_id,190) ";
	$query_string  .= "ORDER BY fecha ASC;";

	$query = pg_query($conn,$query_string);
	
	//echo pg_last_error($conn);
	
	$entered = false;
	
	$categorias = '[';
	$serie_min  = '[';
	$serie_max  = '[';
	$serie_med  = '[';
	
	$parametro_nombre = '';
	
	while ($r = pg_fetch_assoc($query)) 
	{
		
		$categorias .= "'".$r['dia']."',";
		$serie_min	.= $r['min_dato'].",";
		$serie_max	.= $r['max_dato'].",";
		$serie_med	.= $r['med_dato'].",";
		
		$parametro_nombre = $r["parametro_nombre"];

		$entered = true;
	};
	
	if($entered) 
	{
		$categorias 	= substr($categorias,0,strlen($categorias)-1);
		$serie_min 		= substr($serie_min,0,strlen($serie_min)-1);
		$serie_max 		= substr($serie_max,0,strlen($serie_max)-1);
		$serie_med 		= substr($serie_med,0,strlen($serie_med)-1);
	};
	
	$categorias .= ']';
	$serie_min	.= ']';
	$serie_max	.= ']';
	$serie_med	.= ']';
	
	preg_match('/\([\x{00B0}a-zA-Z0-9]{1,}\)/',$parametro_nombre, $parametro_unidad);
		
	$parametro_unidad = $parametro_unidad[0];
	
	
	pg_close($conn);
		
	$grafico = "
	function loadgrafico()
	{
		Highcharts.chart('container', 
		{

		title: { text: '$parametro_nombre - Datos de los ultimos 30 dias' },
		legend: { itemDistance: 50 },
		yAxis: {
				title: {
						text: 'Valores en $parametro_unidad'
						}
				},
		xAxis: { categories: $categorias },

		series: 
		[
			{
			 name:'Minimo',
			 data: $serie_min
			}, 
			{
			 name:'Maximo',
			 data: $serie_max
			}, 
			{
			 name:'Promedio',
			 data: $serie_med
			}
		]
		});
	};
	";
	
	echo $grafico; 
	
	
};



?>

<script>
		<?php
		
		switch ($mode) 
		{
			case 0:
				//http://observ.net/graficos_red/get_graficos.php?estacion_id=7&categoria_parametro_id=4&parametro_id=1&mode=0
				get_estacion_parametro_grafico_30_dias($estacion_id,$categoria_parametro_id,$parametro_id);
			break;
		};
		
		?>
	
</script>

</head>

<body onload="loadgrafico();">
	<div id="container" style="height: 100%; width: 100%"></div>
</body>	

</html>
