<?php include("./fn.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>

	<title>PROYECTO</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php include("./scripts.default.php"); ?>
	<?php include("./scripts.openlayers.php"); ?>	
	<?php include("./scripts.map.php"); ?>
	<?php include("./scripts.onresize.php"); ?>		
	
	<?php include("./scripts.document_ready.php"); ?>
	
</head>
<body>

	<div id="page">
		
		<div class="page-container">
		
			<?php include("./section.page_geovisor_combo.php"); ?>
			
		</div>
		
	</div>	

</body>
</html>