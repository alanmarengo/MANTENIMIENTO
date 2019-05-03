<!DOCTYPE html>
<html lang="en">
<head>

	<title>Ieasa - Observatorio Ambiental</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="./css/bootstrapfix.navbar.css"/>
	
	<link rel="stylesheet" href="./css/map.css"/>
	
	<link rel="stylesheet" href="./js/openlayers/ol.css"/>
	
	<style>
		
		html,body{
			height:100%;
		}
		
		.navbar {
			
			display:block !important;
			background-color:#333333 !important;
			
		}
		
		.navbar-brand {
		
			margin-left:1rem !Important;
			color:#FFFFFF !Important;
			top:3px;
			position:relative;
			font-family:"Raleway", sans-serif;
			font-weight:700;
		}
		
		.navbar-toggler, .navbar-toggler:focus, .navbar-toggler:active {
			
			border:none !Important;
			border-right:2px #464646 solid !Important;
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
			font-family:"Raleway", sans-serif;
			font-weight:400;
			font-size:18px;
			margin:0 0 0 0.9em;
			
		}

		.flex-fill {
			flex:1;
		}
				
	</style>	

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	
	<script src="./js/openlayers/ol.js" type="text/javascript"></script>
	
	<script src="./js/map.js" type="text/javascript"></script>
	
	<script type="text/javascript">
	
		
	
		$(document).ready(function () { 
			
			geomap = new ol_map();
			geomap.container.fixSize([document.getElementById("nav-1"),document.getElementById("nav-2")]);
			geomap.map.create();
			
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
	
	<div class="nav navbar-expand" style="display: inline-block;" id="navSubtitle">
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
			<li class="nav-item nav-item-button active">
				<a class="nav-link" href="#">
					Texto
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					Texto
				</a>
			</li>
		</ul>
	</div>
	
</nav>

<div id="map"></div>

</body>
</html>