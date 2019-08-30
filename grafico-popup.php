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
		
			var req = $.ajax({
				
				async:false,
				type:"POST",
				url:"./php/get-hs-series-default.php",
				success:function() {}
				
			});
			
			var js = JSON.parse(req.responseText);
		
			console.log(js);
		
			Highcharts.chart('grafico', {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: js.titulo
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %'
						}
					}
				},
				/*series: {
					name: js.etiqueta,
					colorByPoint: true,
					data: js.series
				}*/
				series: {
					name: 'Brands',
					colorByPoint: true,
					data: [{
						name: 'Chrome',
						y: 61.41,
						sliced: true,
						selected: true
					}, {
						name: 'Internet Explorer',
						y: 11.84
					}, {
						name: 'Firefox',
						y: 10.85
					}, {
						name: 'Edge',
						y: 4.67
					}, {
						name: 'Safari',
						y: 4.18
					}, {
						name: 'Sogou Explorer',
						y: 1.64
					}, {
						name: 'Opera',
						y: 1.6
					}, {
						name: 'QQ',
						y: 1.2
					}, {
						name: 'Other',
						y: 2.61
					}]
				}
			});
		
		});
	
	</script>
	
</head>

<body>

	<div id="grafico" style="width:600px; height:600px;"></div>

</body>

</html>