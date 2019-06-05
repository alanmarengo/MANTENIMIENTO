<?php include("./geovisor.popup.search.php"); ?>

<div class="popup-row row" id="geovisor-popup-basic">				
				
	<div class="popup-col col col-md-5 col-sm-12 col-xs-12">
		
		<div class="popup-panel-tree">			
		
			<div id="popup-panel-section-1" class="geovisor-toggleable-content block">
			
				<div class="popup-panel-tree-header">
					<div class="pretty p-icon p-rotate">
						<div class="state p-primary">
							<label class="pretty-label-null">SELECCIONE LA OBRA O PROYECTO</label>
						</div>
					</div>
				</div>
				
				<div class="popup-panel-tree-content scrollbar-content" id="scrollbar-content-basic-1">
					
					<div class="scrollbar-content-inner">
					
						<?php DrawProyectos(); ?>
					
					</div>
					
				</div>
			
			</div>
			
			<div id="popup-panel-section-2">
			
				<div class="popup-panel-tree-header">
					<div class="pretty p-icon p-rotate">
						<div class="state p-primary">
							<label class="pretty-label-null">SELECCIONE LA OBRA INFORMACIÓN</label>
						</div>
					</div>
				</div>
				
				<div class="popup-panel-tree-content scrollbar-content" id="scrollbar-content-basic-2">
					
					<div class="scrollbar-content-inner">
					
						<div class="simple-tree" id="filtered-layer-list">							
						
							
							
						</div>		
					
					</div>
					
				</div>
			
			</div>
		
		</div>
		
	</div>				

	<div class="popup-col col col-md-7 col-sm-12 col-xs-12">
		
		<div class="popup-panel-content scrollbar-content" id="scrollbar-content-basic-3">
		
			<div class="scrollbar-content-inner">
		
			<img class="image" src="./images/popup.map.png" width="100%">
		
				<p class="title">Detalles de la Geografía del Lugar</p>
				<p class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				
				<a href="#" class="popup-text-active">Link</a>
				
				<p class="mt-10">
					<a href="#" class="button">AGREGAR AL MAPA</a>
				</p>
				
			</div>
		
		</div>
		
	</div>
	
	

</div>