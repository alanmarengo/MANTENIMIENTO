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
	<?php include("./scripts.map.php"); ?>	
	<?php include("./scripts.document_ready.geovisor.php"); ?>
	
	<?php// include("./scripts.default.php"); ?>
	
	
	
</head>
<body>

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
			
			<?php include("./html.panel.php"); ?>
			
		</div>
		
	</div>
			
	<?php include("./popup.php"); ?>	

</body>
</html>