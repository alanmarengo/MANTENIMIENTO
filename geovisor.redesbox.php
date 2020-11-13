<?php include("./fn.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	
	<?php include("./scripts.analytics.php"); ?>

	<style></style>

	<title>PROYECTO</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php include("./scripts.default.php"); ?>
	<?php include("./scripts.openlayers.php"); ?>	
	<?php include("./scripts.highcharts.php"); ?>	
	<?php include("./scripts.map.estaciones.php"); ?>
	<?php include("./scripts.onresize.php"); ?>

	<link rel="stylesheet" href="./css/geovisorredesbox.css" type="text/css">
	
</head>
<body style="overflow:hidden;">

	<div class="container">
		<p class="title">REGISTRO ESTADÍSTICO Y GRÁFICO DE LA RED DE MONITOREO HÍDRICO DE LA CUENCA DEL RÍO SANTA CRUZ</p>		

		<ul class="nav nav-tabs type2">
			<li class="active"><a class="btn-tab active show" data-toggle="tab" id="tab-aforo-ha4-1" href="#panel-aforo-ha4-1" aria-expanded="true">VALORES MEDIOS MENSUALES</a></li>
			<li class="m0"><a class="btn-tab" data-toggle="tab" id="tab-aforo-ha4-2" href="#panel-aforo-ha4-2" aria-expanded="true">VALORES MEDIOS ANUALES</a></li>
		</ul>
		
		<div class="tab-content p20" id="popup-aforo-tab-content-ha4">
			<div id="panel-aforo-ha4-1" class="tab-pane fade in active show">
				<ul class="ico-list">
					<?php for($i=0; $i<8; $i++) { ?>
					<li>
						<img src="./images/panel-h4-ico.png">
						<span>MENSUAL ITEM: Lorem ipsum is simply dummy text of the printing any typesetting industry</span>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div id="panel-aforo-ha4-2" class="tab-pane fade in">
				<ul class="ico-list">
					<?php for($i=0; $i<8; $i++) { ?>
					<li>
						<img src="./images/panel-h4-ico.png">
						<span>ANUAL ITEM: Lorem ipsum is simply dummy text of the printing any typesetting industry</span>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		
	</div>

</body>
</html>