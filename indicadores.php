<?php include("pgconfig.php"); ?>
<?php include("geovisor.fn.php"); ?>
<?php include("indicadores.fn.php"); ?>
<?php include("./fn.php"); ?>
<?php include("./login.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>

	<title>Indicadores</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<?php include("./scripts.default-indicadores.php"); ?>	
	<?php include("./scripts.indicadores.php"); ?>	
	<?php include("./scripts.onresize.php"); ?>	
	<?php include("./scripts.document_ready.indicadores.php"); ?>
	
	<?php// include("./scripts.default.php"); ?>
	
	
	
</head>
<body>

	<div id="page">
	
		<?php include("./html.navbar-main.php"); ?>
		<?php include("./html.navbar-tools-indicadores.php"); ?>
		
		<div class="page-container">
		
			<?php //include("./section.index.php"); ?>
			
			<?php include("./html.navs.php"); ?>
			
			<?php include("./html.nav.popup.php"); ?>
			
			<div class="row jump-row">
			
				<?php include("./html.panel-indicadores.php"); ?>
				
				<div id="template-wrapper" class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
				
					
				
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	<?php include("./widget-links.php"); ?>
	<?php include("./html.jalert.php"); ?>

</body>
</html>