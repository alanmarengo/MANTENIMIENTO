<?php include("./fn.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>

	<style>
	
	#uxVisor {
	
		position: absolute;
		z-index: 999;
		padding: 20px;
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
	
	</style>

	<title>PROYECTO</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php include("./scripts.default.php"); ?>
	<?php include("./scripts.openlayers.php"); ?>	
	<?php include("./scripts.map.php"); ?>
	<?php include("./scripts.onresize.php"); ?>
	
</head>
<body>

	<div id="page" style="background-color: #f4f4f4;">
		
		<div class="page-container">
		
			<?php include("./section.page_geovisor_combo.php"); ?>
			
		</div>
		
	</div>	

</body>
</html>