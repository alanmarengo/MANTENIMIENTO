<html>
<head>
	
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

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
	
	preg_match('/\([a-zA-Z0-9°º]{1,}\)/',$parametro_nombre, $parametro_unidad);
		
	$parametro_unidad = $parametro_unidad[0];
	
	
	pg_close($conn);
		
	$grafico = "
	function loadgrafico()
	{
		Highcharts.chart('container', 
		{

		title: { text: '$parametro_nombre - Datos de los últimos 30 días' },
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


function get_estacion_lluvias_grafico_30_dias($estacion_id,$categoria_parametro_id,$parametro_id)
{
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
		
	$conn = pg_connect($string_conn);
	
	$query_string   = "SELECT * FROM mod_sensores.get_estacion_lluvias_grafico_30_dias($estacion_id,$categoria_parametro_id,$parametro_id,150) ";
	$query_string  .= "ORDER BY fecha ASC;";

	$query = pg_query($conn,$query_string);
	
	//echo pg_last_error($conn);
	
	$entered = false;
	
	$categorias = '[';
	$serie_min  = '[';
	$serie_max  = '[';
	$serie_med  = '[';
	$serie_sum_dia = '[';
	$serie_acomulado = '[';
	
	$acum = (float)0.0;
	
	$parametro_nombre = '';
	
	while ($r = pg_fetch_assoc($query)) 
	{
		
		$categorias .= "'".$r['dia']."',";
		$serie_min	.= $r['min_dato'].",";
		$serie_max	.= $r['max_dato'].",";
		$serie_med	.= $r['med_dato'].",";
		$serie_sum_dia	.= (float)$r['sum_dato'].",";
		
		$acum = $acum + (float)$r['sum_dato'];
		
		$serie_acomulado	.= $acum.",";
		
		$parametro_nombre = $r["parametro_nombre"];

		$entered = true;
	};
	
	if($entered) 
	{
		$categorias 	= substr($categorias,0,strlen($categorias)-1);
		$serie_min 		= substr($serie_min,0,strlen($serie_min)-1);
		$serie_max 		= substr($serie_max,0,strlen($serie_max)-1);
		$serie_med 		= substr($serie_med,0,strlen($serie_med)-1);
		$serie_sum_dia 		= substr($serie_sum_dia,0,strlen($serie_sum_dia)-1);
		$serie_acomulado 		= substr($serie_acomulado,0,strlen($serie_acomulado)-1);
	};
	
	$categorias .= ']';
	$serie_min	.= ']';
	$serie_max	.= ']';
	$serie_med	.= ']';
	$serie_sum_dia .= ']';
	$serie_acomulado .= ']';
	
	preg_match('/\([a-zA-Z0-9°º]{1,}\)/',$parametro_nombre, $parametro_unidad);
		
	$parametro_unidad = $parametro_unidad[0];
	
	
	pg_close($conn);
		
	$grafico = "
	function loadgrafico()
	{
			Highcharts.chart('container', {
				chart: {
					zoomType: 'xy'
				},
				title: {
					text: 'PRECIPITACIÓN ACUMULADA DIARIA'
				},
				subtitle: {
					text: ''
				},
				xAxis: [{
					categories: $categorias,
					crosshair: true
				}],
				yAxis: [{ // Primary yAxis
					type:'number',
					labels: {
						format: '{value} mm',
						style: {
							color: Highcharts.getOptions().colors[1]
						}
					},
					title: {
						text: 'Total acumulado del día',
						style: {
							color: Highcharts.getOptions().colors[1]
						}
					}
				}, { // Secondary yAxis
					type:'number',
					title: {
						text: 'Lluvias acumuladas',
						style: {
							color: Highcharts.getOptions().colors[0]
						}
					},
					labels: {
						format: '{value} mm',
						style: {
							color: Highcharts.getOptions().colors[0]
						}
					},
					opposite: true
				}],
				tooltip: {
					shared: true
				},
				legend: {
					layout: 'vertical',
					align: 'left',
					x: 120,


					verticalAlign: 'top',
					y: 100,
					floating: true,
					backgroundColor:
						Highcharts.defaultOptions.legend.backgroundColor || // theme
						'rgba(255,255,255,0.25)'
				},
				series: [{
					name: 'Total precipitación diaria',
					type: 'column',
					yAxis: 0,
					data: $serie_sum_dia,
					tooltip: {
						valueSuffix: ' mm'
					}

				}, {
					name: 'Acumulado',
					type: 'spline',
					yAxis: 0,
					data: $serie_acomulado,
					tooltip: {
						valueSuffix: ' mm'
					}
				}]
			});
	};/*Fin load*/
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
				if($parametro_id!=16)/* Todos menos precipitaciones */
				{
					get_estacion_parametro_grafico_30_dias($estacion_id,$categoria_parametro_id,$parametro_id);
				}
				else
				{
					get_estacion_lluvias_grafico_30_dias($estacion_id,$categoria_parametro_id,$parametro_id);
				};
			break;
			case 1:
				//http://observ.net/graficos_red/get_graficos.php?estacion_id=7&categoria_parametro_id=4&parametro_id=1&mode=0
				get_estacion_lluvias_grafico_30_dias($estacion_id,$categoria_parametro_id,$parametro_id);
			break;
		};
		
		?>
	
</script>

</head>

<body onload="loadgrafico();">
	<div id="container" style="height: 100%; width: 100%"></div>
</body>	

</html>