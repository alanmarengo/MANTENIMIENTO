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
		left: 10px;
		top: 50px;

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
	<?php include("./scripts.map.php"); ?>
	<?php include("./scripts.onresize.php"); ?>

	<script src ="./js/geovisorcombo.js" type='text/javascript'></script>
	
</head>
<body>

	<div id="page" style="background-color: #f4f4f4;">
		
		<div class="page-container">
		
			<?php include("./section.page_geovisor_combo.php"); ?>
			
		</div>
		
	</div>	

</body>
</html>