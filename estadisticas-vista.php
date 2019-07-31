<?php include("pgconfig.php"); ?>
<?php include("stats.fn.php"); ?>

<?php var_dump($_POST); ?>

<!DOCTYPE html>
<html lang="es">
<head>

	<title>Estadísticas</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<?php include("./scripts.default-stats-view.php"); ?>	
	<?php include("./scripts.stats.view.php"); ?>	
	<?php include("./scripts.onresize.php"); ?>	
	<?php include("./scripts.openlayers.php"); ?>	
	<?php include("./scripts.highcharts.php"); ?>
	<?php include("./scripts.document_ready.stats.view.php"); ?>
	
	<?php// include("./scripts.default.php"); ?>
	
	
	
</head>
<body>

	<div id="page">
	
		<?php include("./html.navbar-main.php"); ?>
		<?php include("./html.navbar-tools-stats-view.php"); ?>
		
		<div class="page-container">
		
			<?php //include("./section.index.php"); ?>
			
			<?php include("./html.nav.php"); ?>
			<?php include("./html.nav.geovisores.php"); ?>
			<?php include("./html.nav.vinculaciones_insterinstitucionales.php"); ?>
			<?php include("./html.nav.recursos_hidricos.php"); ?>
			<?php include("./html.nav.popup.php"); ?>
			
		</div>
			
			<div class="row jump-row">
				SOME
				<?php //include("./html.panel-view.php"); ?>
			
			</div>
		
	</div>
	
	<?php include("./widget-links.php"); ?>

</body>
</html>