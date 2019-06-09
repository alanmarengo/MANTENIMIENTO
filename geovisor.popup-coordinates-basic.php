<div class="popup-row row">				
				
	<div class="popup-col col col-sm-12 col-md-12 col-sm-12 col-xs-12 p-10 fs-12">
		
		<p>Coordenadas</p>
		<a class="popup-header-button popup-header-button-toggleable popup-header-button-active-fixed" href="#" onclick="geomap.map.activateCoordinates()" onclick=" id="btn-popup-basic">
			<span>CAPTURAR</span>
		</a>
		<span class="ml-5 fs-10" id="coord-hint">(Click para capturar)</span>
		<table id="coord-tbl" class="mt-10">
			<tr>
				<td>EPSG:3857</td>
				<td><span id="coord-3857"></td>
			</td>
			<tr>
				<td>EPSG:4326</td>
				<td><span id="coord-4326"></td>
			</td>
			<tr>
				<td>EPSG:22195</td>
				<td><span id="coord-22195"></td>
			</td>
		</table>
		
		<div id="coord-capture-wrapper" class="mt-10">
		
			<table id="coord-capture-table">
			
				<tr>
					<td>EPSG:3857</td>
					<td><span id="cap-coord-3857"></td>
				</td>
				<tr>
					<td>EPSG:4326</td>
					<td><span id="cap-coord-4326"></td>
				</td>
				<tr>
					<td>EPSG:22195</td>
					<td><span id="cap-coord-22195"></td>
				</td>
				
			</table>
		
		</div>
		
	</div>

</div>