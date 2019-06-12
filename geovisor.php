<?php include("pgconfig.php"); ?>
<?php include("geovisor.fn.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>Ieasa - Observatorio Ambiental</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">	
	<link href="./fonts/gotham/gotham.css" rel="stylesheet">	
	
	<link rel="stylesheet" href="./css/bootstrap.css"/>	
	<link rel="stylesheet" href="./js/jquery-ui/jquery-ui.min.css"/>	

    <link rel="stylesheet" href="./fontawesome-5.8.1/css/all.min.css" />
	
	<link rel="stylesheet" href="./css/pretty-checkbox.css"/>
	<link href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css" rel="stylesheet"> <!-- CHECKBOX FONTS -->
	
	<link rel="stylesheet" href="./css/perfect-scrollbar.css"/>
	<link rel="stylesheet" href="./css/bootstrap-select.css"/>
	    
	<link rel="stylesheet" href="./css/bootstrapfix.navbar.css"/>	
	<link rel="stylesheet" href="./css/bootbox.css"/>
	<link rel="stylesheet" href="./css/fl-windows.css"/>
	<link rel="stylesheet" href="./css/map.css"/>
	<link rel="stylesheet" href="./css/panel.css"/>
	<link rel="stylesheet" href="./css/perfil-topografico.css"/>
	<link rel="stylesheet" href="./css/popup.css"/>
	<link rel="stylesheet" href="./css/scrollbars.css"/>
	<link rel="stylesheet" href="./css/sidenav.css"/>
	<link rel="stylesheet" href="./css/widget-links.css"/>
	<link rel="stylesheet" href="./css/geovisor/style.css"/>
	<link rel="stylesheet" href="./css/geovisor/buttons.css"/>
	<link rel="stylesheet" href="./css/geovisor/coordinates.css"/>
	<link rel="stylesheet" href="./css/geovisor/display.css"/>
	<link rel="stylesheet" href="./css/geovisor/forms.css"/>
	<link rel="stylesheet" href="./css/geovisor/inputs.css"/>
	<link rel="stylesheet" href="./css/geovisor/layers.css"/>
	<link rel="stylesheet" href="./css/geovisor/sizers.css"/>
	<link rel="stylesheet" href="./css/geovisor/sliders.css"/>
	<link rel="stylesheet" href="./css/geovisor/spacers.css"/>
	<link rel="stylesheet" href="./js/colorpicker/css/colorpicker.css"/>
	
	<link rel="stylesheet" href="./js/openlayers/ol.css"/>
	
	<style>
		
		html,body{
			height:100%;
			background-color:#333333 !important;
		}
		
		.navbar {
			
			display:block !important;
			background-color:#333333 !important;
			z-index:2100 !important;
			
		}
		
		#nav-1 {
		    height: 70px;
    		padding-top: 14px;
	
			z-index:2200 !important;
			
		}
		
		.navbar-brand {
		
			margin-left:1rem !Important;
			color:#FFFFFF !Important;
			top:3px;
			position:relative;
			font-family:"Gotham Black Regular";
			
		}
		
		.navbar-toggler, .navbar-toggler:focus, .navbar-toggler:active {
			
			border:none !Important;
			border-right:2px #464646 solid !Important;
			color:#31cbfd !Important;
			
		}
		
		.navbar .dropdown-toggle::after {
			
			color:#31cbfd !Important;
			
		}
		
		.navbar-left {
			
			float:left;
			
		}
		
		.navbar-right {
			
			float:right;
			
		}
		
		.navbar-right .nav-item, #subtoolsIcons ul .dropdown {
			
			display:inline-block !Important;
			
		}
		
		.nav-link-button {
			
			color:#34ccfe !Important;
			margin:0 0.3em !Important;
			min-width:2.4em;
			background-color:#4a4849;
			text-align:center;
			border-radius:3px;
			position:relative;
			top:1px;
			
		}
		
		.nav-link-button:hover {
			
			opacity:0.75;
			
		}
		
		.navbar-toggler-icon {
			
			background-image:url("data:image/svg+xml;charset=utf8,<svg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'><path stroke='rgba(52, 204, 254, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/></svg>") !Important;
			
		}
		
		.nav-title-label {
			
			color:#FFFFFF;			
			font-family:"Gotham Light";
			font-weight:400;
			font-size:18px;
			margin:0.45em 0 0 1.5em;			
			position: relative;
			top: -2px;
			
		}
		
		.nav-link-death {
			
			cursor:text !Important;
			color:rgba(255,255,255,.5) !Important;
			
		}	
		
		.nav-link-death:hover {
			
			text-decoration:none !Important;
			color:rgba(255,255,255,.5) !Important;
			
		}	
		
		.nav-link-separator {
			
			opacity:0.5;
			
		}

		.navbar ul li a {
			
			font-size:12px !Important;
			
		}

		.navbar .dropdown-toggle {
			
			color:#FFFFFF !Important;
			
		}
		
		.nav-row {
			
			margin-left:auto !Important;
			margin-right:auto !Important;
			width:100%;
			
		}
		
		.flex-fill {
			flex:1;
		}
				
	</style>
	
	<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="./js/popper-1.12.9.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./js/jquery-ui/jquery-ui.min.js"></script>	

	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-more.js"></script>
	<script src="https://code.highcharts.com/modules/funnel.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="http://html2canvas.hertzen.com/dist/html2canvas.js"></script>
	
	<script src="./js/perfect-scrollbar.js"></script>
	<script src="./js/bootstrap-select.js"></script>
	<script src="./js/bootstrap-select-init.js"></script>
	<script src="./js/colorpicker/js/colorpicker.js"></script>
	<script src="./js/bootbox.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		
	<script src="./js/openlayers/ol.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
	
	<script src="./js/chart.js" type="text/javascript"></script>
	<script src="./js/config.js" type="text/javascript"></script>
	<script src="./js/map.js" type="text/javascript"></script>
	<script src="./js/site.js" type="text/javascript"></script>
	<script src="./js/scrollbars.js" type="text/javascript"></script>
	<script src="./js/widget-links.js" type="text/javascript"></script>
	<script src="./js/flwindows.js" type="text/javascript"></script>
	
	<script type="text/javascript">
	
		$(document).ready(function () { 
			
			scrollbars = new scrollbars();
			scrollbars.create();
			
			FLWindows = new ini_flwindows();
			FLWindows.Start();
			
			geomap = new ol_map();
			
			geomap.nav.start();
			
			geomap.container.fixSize([document.getElementById("nav-1"),document.getElementById("nav-2")]);
			
			geomap.map.create();
			geomap.map.createLayers();
			geomap.map.createPrintLegendDiv();
			
			geomap.panel.start();
			
			geomap.popup.start();
			
			scrollbars.updateSize();
			
			$(".selectpicker").selectpicker();		
			
			<?php if (isset($_GET["geovisor"])) { ?>
			
				geomap.map.loadGeovisor(<?php echo $_GET["geovisor"]; ?>);
			
			<?php }else{ ?>
			
				<?php if (isset($_GET["l"])) { ?>
					
				var s_clase = [<?php echo $_GET["c"]; ?>];
				var s_layers = [<?php echo $_GET["l"]; ?>];
				var s_visibles = [<?php echo $_GET["v"]; ?>];
				
				for (var i=0; i<s_layers.length; i++) { 
					geomap.panel.AddLayer(s_clase[i],s_layers[i]);
					if (s_visibles[i]) { 
						document.getElementById("layer-checkbox-"+s_layers[i]).click(); 
					}
				}
								
				<?php } ?>
				
				<?php if ((isset($_GET["ca"])) && (!empty($_GET["ca"]))) { ?> 
					
					var ca = <?php echo $_GET["ca"]; ?>;
					
					$(".panel-abr[data-cid="+ca+"]").trigger("click"); 
					
				<?php } ?>
				
				<?php if ((isset($_GET["z"])) && (!empty($_GET["z"]))) { ?> 
				
				geomap.map.ol_object.getView().setZoom(<?php echo $_GET["z"]; ?>);
								
				<?php } ?>
				
				<?php if ((isset($_GET["cen"])) && (!empty($_GET["cen"]))) { ?> 
				
				geomap.map.ol_object.getView().setCenter(ol.proj.transform([<?php echo $_GET["cen"]; ?>], 'EPSG:3857', 'EPSG:3857'));
								
				<?php } ?>
			
			<?php } ?>
			
			
			
		});
		
	</script>
	
</head>
<body>

<?php include("./htmlnav.php"); ?>

<div id="page">

	<nav class="navbar navbar-dark bg-light" id="nav-1">
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" onclick="geomap.nav.go();">
			<span class="navbar-toggler-icon">   
				<i class="fa fa-navicon"></i>
			</span>
		</button>
		
		<a class="navbar-brand" href="#">
			Observatorio
			<img src="./images/ieasa_logo.png" id="logo_ieasa" height="30">
			<div id="map-tools-wrapper"></div>
		</a>
		
		<div class="nav navbar-expand navbar-right" style="display: inline-block;" id="navIcons">
			<ul class="navbar-nav">
				<li class="nav-item nav-item-button active">
					<a class="nav-link nav-link-button" href="#">
						<i class="fa fa-search"></i>
                        <input id="main-search" name="main-search" type="text" placeholder="Buscar en todo el sitio">
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link nav-link-button" href="#" id="navbarDropdown-help" role="button" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-question-circle"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown-help">
						<a class="dropdown-item" href="#">Manual de Usuario</a>
						<a class="dropdown-item" href="#">Video Explicativo</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link nav-item-button nav-link-button" href="#">
						<i class="fa fa-user"></i>
					</a>
				</li>
			</ul>
		</div>
		
	</nav>

	<nav class="navbar navbar-dark bg-light" id="nav-2">
		
		<div class="row nav-row">
		
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
		
				<div class="nav navbar-expand" id="navSubtitle">
					<ul class="navbar-nav">
						<li class="nav-item nav-item-button active">
							<h3 class="nav-item nav-title-label">
								Geovisor general de IEASA
							</h3>
						</li>
					</ul>
				</div>
		
			</div>
		
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
			
				<div class="nav navbar-expand navbar-right" style="display: inline-block;" id="navToolbar">
					<ul class="navbar-nav navbar-toolbar">
						<li class="nav-item">
							<a href="#" class="nav-link nav-toolbar-link" onclick="geomap.map.buffer();" id="navbarDropdown-buffer" role="button" data-toggle="dropdown" aria-expanded="false" alt="Herramienta Buffer" title="Herramienta Buffer">
								<img src="./images/toolbar.icon.buffer.png">
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link nav-toolbar-link" onclick="geomap.map.ptopografico();" id="navbarDropdown-ptopografico" role="button" data-toggle="dropdown" aria-expanded="false" alt="Perfil Topográfico" title="Perfil Topográfico">
								<img src="./images/toolbar.icon.ptopografico.png">
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link nav-toolbar-link" onclick="geomap.map.medicion();" id="navbarDropdown-medicion" role="button" data-toggle="dropdown" aria-expanded="false" alt="Medir" title="Medir">
								<img src="./images/toolbar.icon.medicion.png">
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link nav-toolbar-link" onclick="geomap.map.coordinates();" alt="Capturar Coordenadas" title="Capturar Coordenadas">
								<img src="./images/toolbar.icon.coordenadas.png">
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link nav-toolbar-link" onclick="geomap.map.drawing();" alt="Dibujar" title="Dibujar">
								<img src="./images/toolbar.icon.dibujo.png">
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link nav-toolbar-link" onclick="geomap.map.print();" alt="Imprimir" title="Imprimir">
								<img src="./images/toolbar.icon.print.png">
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link nav-toolbar-link" onclick="geomap.map.share();" alt="Compartir Vista" title="Compartir Vista">
								<img src="./images/toolbar.icon.share.png">
							</a>
						</li>
					</ul>
				</div>
		
		</div>
		
	</nav>

	<div id="map"></div>
	
	<div id="bottom-tools">
		<div class="nav" id="subtoolsIcons">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link nav-item-button nav-link-button" href="#" onclick="geomap.map.ol_object.getView().setZoom(geomap.map.ol_object.getView().getZoom() + 1);">
						<i class="fa fa-plus"></i>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link nav-item-button nav-link-button" href="#" onclick="geomap.map.ol_object.getView().setZoom(geomap.map.ol_object.getView().getZoom() - 1);">
						<i class="fa fa-minus"></i>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link nav-link-button" href="#" onclick="$('#popup-baselayers').toggle()" alt="Seleccionar Capa Base" title="Seleccionar Capa Base">
						<i class="fa fa-layer-group"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>

	<?php include("geovisor.panel.php"); ?>
	<?php include("geovisor.popup.php"); ?>
	<?php include("geovisor.popup-baselayers.php"); ?>
	<?php include("geovisor.popup-buffer.php"); ?>
	<?php include("geovisor.popup-coordinates.php"); ?>
	<?php include("geovisor.popup-drawing.php"); ?>
	<?php include("geovisor.popup-info.php"); ?>
	<?php include("geovisor.popup-medicion.php"); ?>
	<?php include("geovisor.popup-preloader.php"); ?>
	<?php include("geovisor.popup-share.php"); ?>
	
	<?php include("html-flwindows-perfil-topografico.php"); ?>
	
	<?php include("widget-links.php"); ?>
	
	
	<div id="popup-results">
	
	</div>

</div>

</body>
</html>