<?php include("pgconfig.php"); ?>
<?php include("geovisor.fn.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>

	<title>Inicio</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<?php include("./scripts.default.php"); ?>	
	<?php include("./scripts.onresize.geovisor.php"); ?>	
	<?php include("./scripts.openlayers.php"); ?>	
	<?php include("./scripts.highcharts.php"); ?>	
	<?php include("./scripts.map.php"); ?>	
	<?php include("./scripts.document_ready.geovisor.php"); ?>
	
	<?php// include("./scripts.default.php"); ?>
	
	
	
</head>
<body style="overflow:hidden;">

	<div id="page">
	
		<?php include("./html.navbar-main.php"); ?>
		<?php include("./html.navbar-tools.php"); ?>
		
		<div class="page-container">
		
			<div id="map" class="jump-flotant-heightfill">
				<div id="global-coordinates">
					<span id="global-coordinates-span"></span>
				</div>
			</div>
			<?php //include("./section.index.php"); ?>
			
			<?php include("./html.nav.php"); ?>
			<?php include("./html.nav.geovisores.php"); ?>
			<?php include("./html.nav.vinculaciones_insterinstitucionales.php"); ?>
			<?php include("./html.nav.recursos_hidricos.php"); ?>
			<?php include("./html.nav.popup.php"); ?>
			
			<?php include("./html.panel.php"); ?>
			
		</div>
		
	</div>
			
	<?php include("./popup.php"); ?>
	<?php include("./popup.baselayers.php"); ?>
	<?php include("./popup.buffer.php"); ?>
	<?php include("./popup.coordinates.php"); ?>
	<?php include("./popup.info.php"); ?>
	<?php include("./popup.medicion.php"); ?>
	<?php include("./popup.preloader.php"); ?>
	<?php include("./popup.ptopografico.php"); ?>
	<?php include("./popup.share.php"); ?>
	
	<?php include("./html.navbar-geovisor-zoom.php"); ?>

	<div id="popup-results"></div>
	
	<?php include("./widget-links.php"); ?>

</body>
</html>