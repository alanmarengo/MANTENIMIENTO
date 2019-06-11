<div class="popup-row row">				
				
	<div class="popup-col col col-sm-12 col-md-12 col-sm-12 col-xs-12 p-10 fs-12">
		
		<p class="popup-subtitle">CAPAS BASE</p>
				
		<div id="info-baselayers" class="mt-10 scrollbar-content">
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" checked="checked" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.openstreets);">
				<div class="state">
					<label>Openstreets Maps</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" checked="checked" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.opentopo);">
				<div class="state">
					<label>Open Topo</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" checked="checked" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_roads);">
				<div class="state">
					<label>Bing Caminos</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" checked="checked" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
				<div class="state">
					<label>Bing Satelital</label>
				</div>
			</div>
			
			<br>
		
			<div class="pretty p-default p-round" style="font-size:20px;">
				<input type="radio" name="radio-baselayers" checked="checked" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.google);">
				<div class="state">
					<label>Google Maps</label>
				</div>
			</div>
			
			<br>
		
		</div>
		
	</div>

</div>