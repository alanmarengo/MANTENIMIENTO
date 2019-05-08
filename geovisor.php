<!DOCTYPE html>
<html lang="en">
<head>

	<title>Ieasa - Observatorio Ambiental</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">	
	<link href="./fonts/gotham/gotham.css" rel="stylesheet">	
	
	<link rel="stylesheet" href="./css/bootstrap.css"/>	

    <link rel="stylesheet" href="./fontawesome-5.8.1/css/all.min.css" />
	
	<link rel="stylesheet" href="./css/pretty-checkbox.css"/>
	<link href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css" rel="stylesheet"> <!-- CHECKBOX FONTS -->
	    
	<link rel="stylesheet" href="./css/bootstrapfix.navbar.css"/>	
	<link rel="stylesheet" href="./css/map.css"/>
	<link rel="stylesheet" href="./css/panel.css"/>
	<link rel="stylesheet" href="./css/popup.css"/>
	
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
			width:2.4em;
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
			margin:0 0 0 0.9em;			
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
		
		.flex-fill {
			flex:1;
		}
				
	</style>	

	<script src="./js/jquery-3.2.1.min.js"></script>
	<script src="./js/bootstrap.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		
	<script src="./js/openlayers/ol.js" type="text/javascript"></script>
	
	<script src="./js/map.js" type="text/javascript"></script>
	
	<script type="text/javascript">
	
		
	
		$(document).ready(function () { 
			
			geomap = new ol_map();
			geomap.container.fixSize([document.getElementById("nav-1"),document.getElementById("nav-2")]);
			
			geomap.map.create();
			
			geomap.panel.start();
			
			geomap.popup.start();
			
		});
		
	</script>
	
</head>
<body>

<nav class="navbar navbar-dark bg-light" id="nav-1">

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link nav-item-button nav-link-button" href="#">
					<i class="fa fa-user"></i>
				</a>
			</li>
		</ul>
	</div>
 
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Features</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Pricing</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" href="#">Disabled</a>
			</li>
		</ul>
	</div>
	
</nav>

<nav class="navbar navbar-dark bg-light" id="nav-2">
	
	<div class="nav navbar-expand" id="navSubtitle">
		<ul class="navbar-nav">
			<li class="nav-item nav-item-button active">
				<h3 class="nav-item nav-title-label">
					Geovisor general de IEASA
				</h3>
			</li>
		</ul>
	</div>
	
	<div class="nav navbar-expand navbar-right" style="display: inline-block;" id="navToolbar">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="#" class="nav-link">
					<img src="./images/toolbar.icon.zoomext.png">
				</a>
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
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Todas:
				</a>
				<div class="dropdown-menu" style="text-align:right;" aria-labelledby="navbarDropdown">
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
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Terminado:
				</a>
				<div class="dropdown-menu" style="text-align:right;" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="#">Sin Iniciar</a>
					<a class="dropdown-item" href="#">En Proceso</a>
					<a class="dropdown-item" href="#">Terminado</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Sin Especificar</a>
				</div>
			</li>
		</ul>
	</div>
	
</nav>

<div id="map"></div>

<div id="panel-left" class="phanel panel container-fluid">
		
	<div class="panel-container">
	
		<div class="panel-body">
		
			<div class="panel-title">
			
				<h3>LOREM IPSUM SIR AMET</h3>
			
			</div>
			
			<div class="panel-content">
			
				<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
				<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
			
			</div>
		
		</div>
	
	</div>
	
	<div class="panel-arrow-container">
		<div class="panel-arrow">
			<a href="#" class="panel-arrow-link" data-state="1">
				<img src="./images/panel.icon.arrow.1.png">
			</a>
		</div>
	</div>
	
</div>

<div class="popup" id="popup-busqueda">

	<div class="row">
	
		<div class="col col-popup mx-auto col-md-6 col-sm-12 col-xs-12">
		
			<div class="row">			
				
				<div class="col col-md-12 col-xs-12 popup-header">
				
					<div class="nav navbar-expand popup-nav">
					
						<ul class="navbar-nav">
							<li class="nav-item nav-item-button popup-header-li active">
								<a class="popup-header-button popup-header-button-toggleable" href="#">
									<span>BÚSQUEDA</span>
								</a>
							</li>
							<li class="nav-item nav-item-button popup-header-li">
								<a class="popup-header-button popup-header-button-toggleable" href="#">
									<span>BÚSQUEDA AVANZADA</span>
								</a>
							</li>
						</ul>
						
					</div>
				
					<div class="nav navbar-expand popup-nav popup-nav-right">
					
						<ul class="navbar-nav">
							<li class="nav-item nav-item-button popup-header-li active">
								<a class="popup-header-button" href="#">
									<span>IR AL MAPA</span>
								</a>
							</li>
						</ul>
						
					</div>
				
				</div>
			
			</div>
		
			<div class="row">				
				
				<div class="col col-md-5 col-sm-12 col-xs-12" style="background-color:blue;">
					
					<div class="popup-panel-tree">
					
						<div class="popup-panel-tree-header">
							<div class="pretty p-icon p-rotate">
								<div class="state p-primary">
									<label class="pretty-label-null">SELECCIONE LA OBRA O PROYECTO</label>
								</div>
							</div>
						</div>
						
						<div class="popup-panel-tree-content">
							
							<div class="popup-panel-tree-item">
								<div class="pretty p-icon p-rotate">
									<input type="checkbox" />
									<div class="state p-primary">
										<i class="icon mdi mdi-check"></i>
										<label>AHRSC</label>
									</div>
								</div>
							</div>
							
							<div class="popup-panel-tree-item">
								<div class="pretty p-icon p-rotate">
									<input type="checkbox" />
									<div class="state p-primary">
										<i class="icon mdi mdi-check"></i>
										<label>GNEA</label>
									</div>
								</div>
							</div>
							
							<div class="popup-panel-tree-item">
								<div class="pretty p-icon p-rotate">
									<input type="checkbox" />
									<div class="state p-primary">
										<i class="icon mdi mdi-check"></i>
										<label>GAS</label>
									</div>
								</div>
							</div>
							
							<div class="popup-panel-tree-item">
								<div class="pretty p-icon p-rotate">
									<input type="checkbox" />
									<div class="state p-primary">
										<i class="icon mdi mdi-check"></i>
										<label>ENERGÍA EÓLICA</label>
									</div>
								</div>
							</div>
							
							<div class="popup-panel-tree-item">
								<div class="pretty p-icon p-rotate">
									<input type="checkbox" />
									<div class="state p-primary">
										<i class="icon mdi mdi-check"></i>
										<label>BIOMASA</label>
									</div>
								</div>
							</div>
							
							<div class="popup-panel-tree-item">
								<div class="pretty p-icon p-rotate">
									<input type="checkbox" />
									<div class="state p-primary">
										<i class="icon mdi mdi-check"></i>
										<label>COMERCIALIZACIÓN ENERGÍA</label>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="popup-panel-tree-header">
							<div class="pretty p-icon p-rotate">
								<div class="state p-primary">
									<label class="pretty-label-null">SELECCIONE LA OBRA INFORMACIÓN</label>
								</div>
							</div>
						</div>
						
						<div class="popup-panel-tree-content">
							
							<div class="simple-tree">							
							
								<div class="popup-panel-tree-item" data-state="0">
									<div class="popup-panel-tree-item-header">
										<i class="fas fa-folder popup-panel-tree-item-icon popup-icon"></i>
										<a href="#" class="popup-panel-tree-item-label popup-text">
											<span>Categoría</span>
										</a>
										<a href="#" class="simple-tree-pm-button">
											<i class="fa fa-plus-circle popup-panel-tree-item-icon-toggler popup-icon"></i>
										</a>
									</div>
									<div class="popup-panel-tree-item-subpanel">
										<ul>
											<li>
												<i class="fa fa-cube popup-text-active"></i>
												Aprovechamientos
											</li>											
											<li>Construcciones</li>											
											<li>
												<i class="fa fa-cube popup-text-active"></i>
												Planeamientos
											</li>
											<li>Reserva Ecológica</li>
										</ul>
									</div>
								</div>
								
								<div class="popup-panel-tree-item" data-state="0">
									<div class="popup-panel-tree-item-header">
										<i class="fas fa-folder popup-panel-tree-item-icon popup-icon"></i>
										<a href="#" class="popup-panel-tree-item-label popup-text">
											<span>Categoría</span>
										</a>
										<a href="#" class="simple-tree-pm-button">
											<i class="fa fa-plus-circle popup-panel-tree-item-icon-toggler popup-icon"></i>
										</a>
									</div>
									<div class="popup-panel-tree-item-subpanel">
										<ul>
											<li>
												<i class="fa fa-cube popup-text-active"></i>
												Aprovechamientos
											</li>											
											<li>Construcciones</li>											
											<li>
												<i class="fa fa-cube popup-text-active"></i>
												Planeamientos
											</li>
											<li>Reserva Ecológica</li>
										</ul>
									</div>
								</div>
								
								<div class="popup-panel-tree-item" data-state="0">
									<div class="popup-panel-tree-item-header">
										<i class="fas fa-folder popup-panel-tree-item-icon popup-icon"></i>
										<a href="#" class="popup-panel-tree-item-label popup-text">
											<span>Categoría</span>
										</a>
										<a href="#" class="simple-tree-pm-button">
											<i class="fa fa-plus-circle popup-panel-tree-item-icon-toggler popup-icon"></i>
										</a>
									</div>
									<div class="popup-panel-tree-item-subpanel">
										<ul>
											<li>
												<i class="fa fa-cube popup-text-active"></i>
												Aprovechamientos
											</li>											
											<li>Construcciones</li>											
											<li>
												<i class="fa fa-cube popup-text-active"></i>
												Planeamientos
											</li>
											<li>Reserva Ecológica</li>
										</ul>
									</div>
								</div>
								
								<div class="popup-panel-tree-item" data-state="0">
									<div class="popup-panel-tree-item-header">
										<i class="fas fa-folder popup-panel-tree-item-icon popup-icon"></i>
										<a href="#" class="popup-panel-tree-item-label popup-text">
											<span>Categoría</span>
										</a>
										<a href="#" class="simple-tree-pm-button">
											<i class="fa fa-plus-circle popup-panel-tree-item-icon-toggler popup-icon"></i>
										</a>
									</div>
									<div class="popup-panel-tree-item-subpanel">
										<ul>
											<li>
												<i class="fa fa-cube popup-text-active"></i>
												Aprovechamientos
											</li>											
											<li>Construcciones</li>											
											<li>
												<i class="fa fa-cube popup-text-active"></i>
												Planeamientos
											</li>
											<li>Reserva Ecológica</li>
										</ul>
									</div>
								</div>
								
							</div>		
							
						</div>
					
					</div>
					
				</div>				
			
				<div class="col col-md-7 col-sm-12 col-xs-12" style="background-color:orange;">
					
					<div class="popup-panel-content">
					
						<img class="image" src="./images/popup.map.png" width="100%">
					
						<p class="title">Detallas de la Geografía del Lugar</p>
						<p class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						
						<a href="#" class="popup-text-active">Link</a>
						
						<p class="mt-10">
							<a href="#" class="button">AGREGAR AL MAPA</a>
						</p>
						
					</div>
					
				</div>
				
				
			
			</div>
		
		</div>
	
	</div>

</div>

</body>
</html>