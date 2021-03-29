<?php include("./fn.php"); ?>
<!DOCTYPE html>
<html lang="es">

<!-- Script del modal  -->
<script type="text/javascript">
	function cerrarPopup(){
			$('.modalMonitoreo').remove()
	}
</script>

<head></head>

	<link href="./css/popupMonitoreo.css" rel="stylesheet" type="text/css">
	<?php include("./scripts.analytics.php"); ?>

	<title>MONITOREO R&Iacute;O SANTA CRUZ</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php include("./scripts.default.php"); ?>
	<?php include("./scripts.onresize.php"); ?>		
	
	<?php include("./scripts.document_ready.php"); ?>
	
</head>
<body>

	<div class="p">
		<div class="modalMonitoreo">
		<div id="basePopup"> 
			<div id="contenedorPopup"> 
				<div id="tituloPopup"> <h5> Atención </h5></div>
				<div id="contenidoPopup"> 
					Se recuerda a los potenciales usuarios de esta información que en todo momento se debe tener cuidado con las conclusiones que puedan derivarse del análisis de las series de datos hidroambientales pues son el resultado de una reconstrucción y por ende no son mediciones reales en el sentido estrictamente académico. <b>Los datos de los últimos dos meses de estas estaciones son datos en tiempo real y pueden mostrar resultados afectados por problemas técnicos.</b>
				</div>
				<div id="footerPopup">
					<button type="button" class="btn btn-primary" id="botonPopup" onclick="cerrarPopup()">
						Aceptar
					</button>
				</div>
			</div>
		</div>
		 </div>
		<?php include("./html.navbar-main.php"); ?>
		<div class="page-container">
		
			<?php include("./section.page_monitoreo.php"); ?>
			
			<?php include("./html.navs.php"); ?>
			
			<?php include("./footer.php"); ?>

			
		</div>
		
	</div>
	
	<?php include("./widget-links.php"); ?>	

</body>
<script type="text/javascript"> 

</script>


</html>

