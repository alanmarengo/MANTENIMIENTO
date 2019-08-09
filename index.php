<!DOCTYPE html>
<html lang="es">
<head>

	<title>Inicio</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<?php include("./scripts.default.php"); ?>
	<?php include("./scripts.onresize.php"); ?>		
	
	<?php include("./scripts.document_ready.php"); ?>
	
</head>
<body>

	<div id="page">
	
		<?php include("./html.navbar-main.php"); ?>
		
		<div class="page-container" style="background-color: #EAEAED;">
		
			<?php include("./section.index.php"); ?>
			
			<?php include("./html.nav.php"); ?>
			<?php include("./html.nav.herramientas-ieasa.php"); ?>
			<?php include("./html.nav.aprovsc.php"); ?>
			
			<?php include("./footer.php"); ?>
			
		</div>
		
	</div>
	
	<?php //include("./widget-links.php"); ?>

</body>
</html>