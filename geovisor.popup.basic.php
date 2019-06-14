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
				<?php echo 123; ?>
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
		
				<div id="mini-map">
				
				</div>
			
				<div id="layer-preview-inner">
			
					<p class="title" id="layer-preview-title">Datos de Capa</p>
					<p class="content">Seleccione una capa para ver su descripción</p>
					
					<p class="mt-10">
						<a href="#" class="button" id="btn-layer-preview-addlayer">AGREGAR AL MAPA</a>
					</p>
				
				</div>
				
			</div>
		
		</div>
		
	</div>
	
	

</div>