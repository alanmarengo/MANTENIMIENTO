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

			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.openstreets);">
				<div class="state">
					<label>Estaciones hidrométricas</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.opentopo);">
				<div class="state">
					<label>Estaciones meteorológicas</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_roads);">
				<div class="state">
					<label>Estaciones hidrometeorológicas</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
				<div class="state">
					<label>Estaciones hidroambientales</label>
				</div>
			</div>
			
			<br>

		</div>

		<div class="card mt-30">

			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.openstreets);">
				<div class="state">
					<label>Cuenca alta</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.opentopo);">
				<div class="state">
					<label>Cuenca media</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_roads);">
				<div class="state">
					<label>Estuario</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
				<div class="state">
					<label>Presa Condor Cliff</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
				<div class="state">
					<label>Presa La Barrancosa</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
				<div class="state">
					<label>Embalse Condor Cliff</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
				<div class="state">
					<label>Embalse La Barrancosa</label>
				</div>
			</div>
			
			<br>

		</div>

	</div>

	<div id="map"></div>
	
	<?php include("./html.navbar-geovisor-zoom.php"); ?>
	<?php include("./popup.baselayers.flotant.php"); ?>

</body>
</html>