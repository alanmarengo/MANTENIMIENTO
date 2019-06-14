<div class="jump-window jump-align-right jump-flotant-heightfill-top col col-xs-12 col-sm-12-col-md-3 col-lg-3" id="popup-drawing">
	
	<div class="jump-window-inner p20">

		<div class="jump-window-header">
			<span>Capa Base</span>
			<a href="#" class="jump-window-close">
				<i class="fas fa-times"></i>
			</a>
		</div>
		
		<div class="jump-window-body p20">
			
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