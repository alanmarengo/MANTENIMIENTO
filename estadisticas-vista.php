<?php

if (!isset($_GET["dt_id"])) { die("Invalid Token;"); }
if (!isset($_GET["dt_v"])) { die("Invalid Token;"); }
if (!isset($_GET["dt_c"])) { die("Invalid Token;"); }

$dt_id = $_GET["dt_id"];
$dt_variables = $_GET["dt_v"];
$dt_cruce = $_GET["dt_c"];

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

	<form id="frm-dt">
		<input type="hidden" name="dt_id" id="dt_id" value="<?php echo $dt_id; ?>">
		<input type="hidden" name="dt_v" id="dt_v" value="<?php echo $dt_variables; ?>">
		<input type="hidden" name="dt_c" id="dt_c" value="<?php echo $dt_cruce; ?>">
	</form>
	
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