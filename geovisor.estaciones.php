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
	<?php include("./scripts.highcharts.php"); ?>	
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

	<div id="popup">
		<div id="popup-inner">
			<div class="header">
				<span class="title">Estación de Monitoreo</span>
				<a href="javascript:void(0);" onclick="$('#popup').hide();">
					<i class="fa fa-times"></i>
				</a>
			</div>
			<div class="tabs mt-10">
				<ul class="nav nav-tabs">
					<li class="active"><a class="btn-tab show" data-toggle="tab" id="tab-ha-1" href="#panel-ha-1" aria-expanded="true">Descripción</a></li>
					<li><a class="btn-tab" data-toggle="tab" id="tab-ha-2" href="#panel-ha-2" aria-expanded="true">Registro Diario</a></li>
					<li><a class="btn-tab" data-toggle="tab" id="tab-ha-3" href="#panel-ha-3" aria-expanded="true">Consultar Datos</a></li>
					<li><a class="btn-tab" data-toggle="tab" id="tab-ha-4" href="#panel-ha-4" aria-expanded="true">Registro Mensual y Anual</a></li>
				</ul>
			</div>
			<div class="categories mt-10">
				<div class="category">
					<input type="radio" name="categoria" checked="checked">
					<label>Hidrométricas</label>
				</div>
				<div class="category">
					<input type="radio" name="categoria">
					<label>Hidrometeorológicas</label>
				</div>
				<div class="category">
					<input type="radio" name="categoria">
					<label>Meteorológicas</label>
				</div>
				<div class="category">
					<input type="radio" name="categoria">
					<label>Hidroambientales</label>
				</div>
			</div>			
			<div class="tab-content mt-20" id="popup-tab-content">
				<div id="panel-ha-1" class="tab-pane fade in show">
					<div class="row">
						<div class="col col-md-6 col-lg-6 col-xs-12 col-sm-12">
							<p><img src="./images/sample.jpg" width="100%"></p>
							<p class="mt-20">
								<a href="#" class="btn-1">Monografía de la Estación</a>
							</p>
							<p>
								<a href="#" class="btn-1">Descarga de la Serie de Datos Completa</a>
							</p>
						</div>
						<div class="col col-md-6 col-lg-6 col-xs-12 col-sm-12">
							<p>
								<span class="popup-label">Coordenadas:</span>
								<span class="popup-value">LAT: -50.295556 LONG: -72.305092</span>
							</p>
							<p>
								<span class="popup-label">Nombre:</span>
								<span class="popup-value">Lago Argentino Boya</span>
							</p>
							<p>
								<span class="popup-label">Localización:</span>
								<span class="popup-value">En el Lago Argentino frente al Calafate</span>
							</p>
							<p>
								<span class="popup-label">ID:</span>
								<span class="popup-value">XX</span>
							</p>
							<p>
								<span class="popup-label">Parámetros:</span>
								<ul class="popup-value">
									<li>Clorofila</li>
									<li>Oxígeno disuelto</li>
									<li>Conductividad</li>
									<li>Material en suspensión</li>
									<li>Altura de olas</li>
									<li>Período de olas</li>
									<li>Temperatura del agua</li>
									<li>Temperatura del aire</li>
									<li>Velocidad del viento</li>
								</ul>
							</p>
							<p>
								<span class="popup-label">Inicio de Operación:</span>
								<span class="popup-value">Instalada no activa</span>
							</p>
							<p>
								<span class="popup-label">Objetivo:</span>
								<span class="popup-value">Monitoreo de parámetros de calidad del agua del lago. Inicio del sistema del RSC.</span>
							</p>
							<p>
								<span class="popup-label">Proveedor:</span>
								<span class="popup-value">Iado</span>
							</p>
						</div>
					</div>
				</div>
				<div id="panel-ha-2" class="tab-pane fade in">
					<div class="row mt-10">
						<?php for($i=0; $i<12; $i++) { ?>
						<?php 
						if (($i!=0) && ($i%6==0)) {
							?>
							</div><div class="row">
							<?php
						}
						?>
						<div class="col col-md-2 col-lg-2 p5">
							<div class="indicador">
								<p class="title">Nivel del Agua</p>
								<p class="value">1,73 (m)</p>
								<p class="text-default">(min.) 1.66</p>
								<p class="text-default">(med.) 1.99</p>
								<p class="text-default">(max.) 2.32</p>
								<p class="date"><img src="./images/indicador-ico.png"></p>
								<p class="date mt-10">10/09/2020</p>
								<p class="date">00:00hs.</p>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div id="panel-ha-3" class="tab-pane fade in">
					<div class="row">
						<div class="col col-md-6 col-lg-6">
							<div class="form-group">
								<label>Parámetro:</label>
								<select>
									<option value="1">Param 1</option>
									<option value="2">Param 2</option>
									<option value="3">Param 3</option>
									<option value="4">Param 4</option>
								</select>
							</div>
						</div>
						<div class="col col-md-3 col-lg-3">
							<div class="form-group">
								<label>Desde:</label>
								<input type="text" class="datepicker">
								<i class="fa fa-calendar-alt"></i>
							</div>
						</div>
						<div class="col col-md-3 col-lg-3">
							<div class="form-group">
								<label>Hasta:</label>
								<input type="text" class="datepicker">
								<i class="fa fa-calendar-alt"></i>
							</div>
						</div>
					</div>
					<div class="row mt-20">
						<div class="col col-md-3 col-lg-3">
							<div class="indicador mini text-center">
								<p class="title">VALOR MÍNIMO</p>
								<p class="value">1,73 (°C)</p>
							</div>
							<div class="indicador mini text-center mt-10">
								<p class="title">VALOR MÁXIMO</p>
								<p class="value">1,73 (°C)</p>
							</div>
							<div class="indicador mini text-center mt-10">
								<p class="title">PROMEDIO</p>
								<p class="value">1,73 (°C)</p>
							</div>
							<p class="mt-10">
								<a href="#" class="btn-2">Descarga de la Serie de Datos</a>
							</p>
						</div>
						<div class="col col-md-9 col-lg-9">
							<div id="chart-sample-1"></div>
						</div>
					</div>
				</div>
				<div id="panel-ha-4" class="tab-pane fade in">

					<ul class="nav nav-tabs type2">
						<li class="active"><a class="btn-tab show" data-toggle="tab" id="tab-ha-1" href="#panel-ha-1" aria-expanded="true">VALORES MEDIOS MENSUALES</a></li>
						<li><a class="btn-tab" data-toggle="tab" id="tab-ha-2" href="#panel-ha-2" aria-expanded="true">VALORES MEDIOS ANUALES</a></li>
					</ul>

				</div>				
			</div>
		</div>
	</div>


</body>
</html>