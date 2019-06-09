<div id="perfil-topografico" class="fl-window map-element" data-maxto="none,0px,-10px,none" data-minto="none,0px,-10px,none">
		
	<div id="perfil-topografico-header" class="fl-window-header" data-nodrag="0">
		
		<p class="filter-container-title">PERFIL TOPOGRÁFICO</p>
						
		<div class="map-controls-layers-panel-icon flclose" title="Cerrar">
			<a href="javascript:void(0);" onclick="$('#perfil-topografico').hide(); geomap.map.ptopografico.layerVector.getSource().clear();">
				X
			</a>
		</div>		
			
	</div>
					
	<div id="perfil-topografico-list" class="fl-window-body">
			
		<a href="#" id="close_ptop" title="Cerrar Perfil Topográfico"><i class="fa fa-times"></i></a>
		<a href="#" id="redraw_ptop" title="Trazar otra linea"><i class="fa fa-pencil"></i></a>
		<div id="perfil_topografico_min_max"></div>
		<div id="perfil_topografico_chart"></div>
			
	</div>
	
</div>