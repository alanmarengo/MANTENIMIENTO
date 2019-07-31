<?php

if (!isset($_POST["dt_id"])) { die("Invalid Token;"); }
if (!isset($_POST["dt_variables"])) { die("Invalid Token;"); }
if (!isset($_POST["dt_cruce"])) { die("Invalid Token;"); }

$dt_id = $_POST["dt_id"];
$dt_variables = $_POST["dt_variables"];
$dt_cruce = $_POST["dt_cruce"];

?>

<?php include("pgconfig.php"); ?>
<?php include("stats.fn.php"); ?>

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
			
			<div class="row jump-row">
			
				<?php include("./html.panel-view.php"); ?>
			
			</div>
			
		</div>
		
	</div>
	
	<?php include("./widget-links.php"); ?>

</body>
</html>