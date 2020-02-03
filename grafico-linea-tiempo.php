<!DOCTYPE html>
<html lang="es">
<head>

	<title>Geovisor</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<?php include("./scripts.default.php"); ?>
	<?php include("./scripts.highcharts.php"); ?>
	
	<script type="text/javascript">
	
		$(document).ready(function() {			
						
			jwindow = new Jump.window();
			jwindow.initialize();
			jwindow.setAllWindowsDraggable();
			jwindow.initMinimizing();
		
			Highcharts.chart('grafico', {
				chart: {
					type: 'timeline',
					backgroundColor: 'rgb(255,255,255)'
				},
				xAxis: {
					visible: false
				},
				yAxis: {
					visible: false
				},
				title: {
					text: 'Línea de tiempo de los AHRSC'
				},
				subtitle: {
					text: ''
				},
				series: [{
					data: [
						{
							name: '22/08/12',
							label: 'Se abre el llamado a licitación de las obras de los Aprovechamientos Hidroeléctricos del Río Santa Cruz.',
							description: ''
						},
						{
							name: '11/06/2013',
							label: 'Se adjudica la obra al consorcio Represas Patagonia, integrado por Gezhouba Group (China), Electroingeniería e Hidrocuyo.',
							description: ''
						},
						{
							name: '09/02/2015',
							label: 'Audiencia Pública provincial en Comandante Luis Piedra Buena, Santa Cruz.',
							description: ''
						},
						{
							name: '31/08/2016',
							label: 'Se aprueban las modificaciones en el proyecto: reducción de cota de CC, reducción en el número de turbinas, régimen de operación de LB y construcción de la LEAT. ',
							description: ''
						},
						{
							name: '21/12/2016',
							label: 'Medida cautelar de la Corte Suprema de Justicia de la Nación suspende las obras principales hasta la realización de un estudio de impacto y audiencia pública en los términos de la Ley 23.879.',
							description: ''
						},
						{
							name: '20/07/2017 y 21/07/2017',
							label: 'Audiencia Pública en el Congreso Nacional, Buenos Aires, en el marco de la Ley 23.879.',
							description: ''
						},
						{
							name: '25/08/2018',
							label: 'Los Ministerios de Energía y Minería, y de Ambiente y Desarrollo Sustentable de la Nación emiten la Resolución Conjunta 3/17, aprobando las obras',
							description: ''
						},
						{
							name: '08/01/2018',
							label: 'Se reinician las obras principales de los Aprovechamientos Hidroeléctricos del Río Santa Cruz. ',
							description: ''
						},
						{
							name: '20/02/2019',
							label: 'Audiencia Pública por la Línea de Alta Tensión en Comandante Luis Piedra Buena, Santa Cruz. ',
							description: ''
						},
					]
				}]
			}).reflow();
		
		});
	
	</script>
	
</head>

<body style="width:100%; height:100%; overflow:hidden; background:white;">

	<div id="grafico" style="width:100%; height:100%;"></div>

</body>

</html>