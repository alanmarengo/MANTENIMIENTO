<div class="popup-row row">				
				
	<div class="popup-col col col-sm-12 col-md-12 col-sm-12 col-xs-12 p-10 fs-12">
		
		<p class="popup-subtitle">DIBUJAR</p>
				
		<div id="info-drawing" class="mt-10 scrollbar-content">
		
			<div class="layer-icons">
				
				<div class="layer-icon" onclick="geomap.map.drawing('Point');">
					<a href="javascript:void(0);">
						<img src="./images/geovisor/icons/drawing-bar-point.png" alt="Dibujar Punto">
					</a>
				</div>
			
				<div class="layer-icon" onclick="geomap.map.drawing('LineString');">
					<a href="javascript:void(0);">
						<img src="./images/geovisor/icons/drawing-bar-line.png" alt="Dibujar Linea">
					</a>
				</div>
			
				<div class="layer-icon" onclick="geomap.map.drawing('Polygon');">
					<a href="javascript:void(0);">
						<img src="./images/geovisor/icons/drawing-bar-polygon.png" alt="Dibujar Polígono">
					</a>
				</div>
			
				<div class="layer-icon" onclick="geomap.map.drawing('Circle');">
					<a href="javascript:void(0);">
						<img src="./images/geovisor/icons/drawing-bar-circle.png" alt="Dibujar Círculo">
					</a>
				</div>
			
				<div class="layer-icon" onclick="geomap.map.ol_object.removeInteraction(geomap.map.draw);">
					<a href="javascript:void(0);">
						<img src="./images/geovisor/icons/drawing-bar-none.png" alt="Ninguno">
					</a>
				</div>
				
			</div>	
		
		</div>
		
	</div>

</div>