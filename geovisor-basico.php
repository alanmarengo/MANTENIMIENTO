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
	<link rel="stylesheet" href="./css/map.css"/>
	<link rel="stylesheet" href="./css/panel.css"/>
	<link rel="stylesheet" href="./css/popup.css"/>
	<link rel="stylesheet" href="./css/scrollbars.css"/>
	<link rel="stylesheet" href="./css/sidenav.css"/>
	<link rel="stylesheet" href="./css/geovisor/style.css"/>
	<link rel="stylesheet" href="./css/geovisor/buttons.css"/>
	<link rel="stylesheet" href="./css/geovisor/display.css"/>
	<link rel="stylesheet" href="./css/geovisor/forms.css"/>
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
		
		.navbar-right .nav-item {
			
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
	
	<script src="./js/perfect-scrollbar.js"></script>
	<script src="./js/bootstrap-select.js"></script>
	<script src="./js/bootstrap-select-init.js"></script>
	<script src="./js/colorpicker/js/colorpicker.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		
	<script src="./js/openlayers/ol.js" type="text/javascript"></script>
	
	<script src="./js/map-basico.js" type="text/javascript"></script>
	<script src="./js/site.js" type="text/javascript"></script>
	<script src="./js/scrollbars.js" type="text/javascript"></script>
	
	<script type="text/javascript">
	
		$(document).ready(function () { 
			
			scrollbars = new scrollbars();
			scrollbars.create();
			
			geomap = new ol_map();
			
			geomap.nav.start();
			
			geomap.container.fixSize([document.getElementById("nav-1"),document.getElementById("nav-2")]);
			
			geomap.map.create();
			
			geomap.panel.start();
			
			geomap.popup.start();
			
			scrollbars.updateSize();
			
			$(".selectpicker").selectpicker();
			
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
		</a>
		
		<div class="nav navbar-expand navbar-right" style="display: inline-block;" id="navIcons">
			<ul class="navbar-nav">
				<li class="nav-item nav-item-button active">
					<a class="nav-link nav-link-button" href="#">
						<i class="fa fa-search"></i>
                        <input id="main-search" name="main-search" type="text" placeholder="Buscar en todo el sitio">
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link nav-link-button" href="#" id="navbarDropdown-help" role="button" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-question-circle"></i>
					</a>
					<div class="dropdown-menu"  style="text-align:right; position:absolute; left:22%; top:105%; z-index:999999;" aria-labelledby="navbarDropdown-help">
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
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="#" class="nav-link">
								<img src="./images/toolbar.icon.zoomext.png">
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-proy" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Proyectos:
							</a>
							<div class="dropdown-menu" style="text-align:right;" aria-labelledby="navbarDropdown-proy">
								<?php ListaProyectos(); ?>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Sin Especificar</a>
							</div>
						</li>
						<li>
							<a class="nav-link nav-link-death nav-link-separator nav-item">
								<span>|</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link nav-link-death nav-item">Infraestructura</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-maq" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Todas:
							</a>
							<div class="dropdown-menu" style="text-align:right;" aria-labelledby="navbarDropdown-maq">
								<a class="dropdown-item" href="#">Maquinaria</a>
								<a class="dropdown-item" href="#">Equipos</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Todos</a>
							</div>
						</li>
						<li>
							<a class="nav-link nav-link-death nav-link-separator nav-item">
								<span>|</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link nav-link-death nav-item">Estado</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-po" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Terminado:
							</a>
							<div class="dropdown-menu" style="text-align:right;" aria-labelledby="navbarDropdown-po">
								<a class="dropdown-item" href="#">Sin Iniciar</a>
								<a class="dropdown-item" href="#">En Proceso</a>
								<a class="dropdown-item" href="#">Terminado</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Sin Especificar</a>
							</div>
						</li>
					</ul>
				</div>
		
		</div>
		
	</nav>

	<div id="map"></div>

	<?php include("geovisor.panel-basico.php"); ?>
	<?php include("geovisor.popup-info.php"); ?>

	<div id="popup-results">
	
	</div>
	
</div>

</body>
</html>