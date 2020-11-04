<?php include("./fn.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	
	<?php include("./scripts.analytics.php"); ?>

	<style></style>

	<title>PROYECTO</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php include("./scripts.default.php"); ?>
	<?php include("./scripts.openlayers.php"); ?>	
	<?php include("./scripts.map.estaciones.php"); ?>
	<?php include("./scripts.onresize.php"); ?>

	<script src ="./js/geovisorestaciones.js" type='text/javascript'></script>
	<link rel="stylesheet" href="./css/geovisorestaciones.css" type="text/css">
	
</head>
<body style="overflow:hidden;">

	<div id="cards" class="col-md-3 col-lg-3 col-xs-11 col-sm-11">

		<div class="card">

			<h3 class="card-title">RED HIDROAMBIENTAL</h3>

			<div class="pretty p-icon p-curve" style="font-size:20px;">
				<input type="checkbox" name="filtro-estacion-tipo-1" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.openstreets);">
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label>Estaciones hidrométricas</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-icon p-curve" style="font-size:20px;">
				<input type="checkbox" name="filtro-estacion-tipo-2" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.opentopo);">
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label>Estaciones meteorológicas</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-icon p-curve" style="font-size:20px;">
				<input type="checkbox" name="filtro-estacion-tipo-3" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_roads);">
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label>Estaciones hidrometeorológicas</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-icon p-curve" style="font-size:20px;">
				<input type="checkbox" name="filtro-estacion-tipo-4" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label>Estaciones hidroambientales</label>
				</div>
			</div>
			
			<br>

		</div>

		<div class="card mt-30">

			<h3 class="card-title">ESTACIONES POR ÁREA DE INTERÉS</h3>

			<div class="pretty p-icon p-curve" style="font-size:20px;">
				<input type="checkbox" name="filtro-estacion-area-1" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.openstreets);">
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label>Cuenca alta</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-icon p-curve" style="font-size:20px;">
				<input type="checkbox" name="filtro-estacion-area-2" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.opentopo);">
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label>Cuenca media</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-icon p-curve" style="font-size:20px;">
				<input type="checkbox" name="filtro-estacion-area-3" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_roads);">
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label>Estuario</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-icon p-curve" style="font-size:20px;">
				<input type="checkbox" name="filtro-estacion-area-4" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label>Presa Condor Cliff</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-icon p-curve" style="font-size:20px;">
				<input type="checkbox" name="filtro-estacion-area-5" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label>Presa La Barrancosa</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-icon p-curve" style="font-size:20px;">
				<input type="checkbox" name="filtro-estacion-area-6" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label>Embalse Condor Cliff</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-icon p-curve" style="font-size:20px;">
				<input type="checkbox" name="filtro-estacion-area-7" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label>Embalse La Barrancosa</label>
				</div>
			</div>
			
			<br>

		</div>

	</div>

	<div id="map"></div>
	
	<?php include("./html.navbar-geovisor-zoom.php"); ?>
	<?php include("./popup.baselayers.flotant.php"); ?>
	
	<div style="width:200px; bottom:15px; left:10px; font-weight:bolder;" class="jump-posabs">
			
		<a href="./geovisor.php?geovisor=2" target="_blank" class="black-button">
			<span>VER EN GEOVISOR</span>
		</a>

	</div>

	<div id="popup" class="roverlay" data-col="6">
		<div id="popup-inner">
			<div class="header">
				<span class="title">Estación de Monitoreo</span>
				<a href="#">
					<i class="fa fa-times"></i>
				</a>
			</div>
			<div class="tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" id="tab-ha-1" href="#panel-ha-1" aria-expanded="true">Descripción</a></li>
					<li><a data-toggle="tab" id="tab-ha-2" href="#panel-ha-2" aria-expanded="true">Registro Diario</a></li>
					<li><a data-toggle="tab" id="tab-ha-3" href="#panel-ha-3" aria-expanded="true">Consultar Datos</a></li>
					<li><a data-toggle="tab" id="tab-ha-4" href="#panel-ha-4" aria-expanded="true">Registro Mensual y Anual</a></li>
				</ul>
				<div class="tab-content p30">
					<div id="panel-ha-1" class="tab-pane fade in active">1</div>
					<div id="panel-ha-2" class="tab-pane fade in">2</div>
					<div id="panel-ha-3" class="tab-pane fade in">3</div>
					<div id="panel-ha-4" class="tab-pane fade in">4</div>				
				</div>
			</div>
		</div>
	</div>


</body>
</html>