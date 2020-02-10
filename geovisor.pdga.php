<?php include("./fn.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>

	<style>
	
	#uxVisor {
	
		position: absolute !important;
		z-index: 999 !important;
		padding: 20px !important;
		background:white;
		left: 10px;
		top: 10px;

	}
	
	#uxCapa {
	
		position: absolute;
		z-index: 999;
		padding: 20px;
		background:white;
		left: 30px;
		top: 50px;
		width:450px;

	}
	
	.bootstrap-select {
		
		width: 340px;
		position: absolute;
		z-index: 999;
		top: 10px;
		left: 10px;
		
	}
	
	</style>

	<title>PROYECTO</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php include("./scripts.default.php"); ?>
	<?php include("./scripts.openlayers.php"); ?>	
	<?php include("./scripts.map.pdga.php"); ?>
	<?php include("./scripts.onresize.php"); ?>

	<script src ="./js/geovisorpdga.js" type='text/javascript'></script>
	
</head>
<body>

	<div id="page" style="background-color: #f4f4f4;" class="h100p">
		
		<div class="page-container h100p">
		
			<?php include("./section.page_geovisor_pdga.php"); ?>
			
		</div>
		
	</div>
	
	<div id="popup-results"></div>	
	<div id="popup-results-preparse"></div>
	
</body>
</html>