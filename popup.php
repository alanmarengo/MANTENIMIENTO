<div class="jump-window jump-align-right jump-flotant-heightfill jump-flotant-heightfill-top col col-xs-12 col-sm-12-col-md-9 col-lg-9" id="popup-geovisor">
	
	<div class="jump-window-inner p20 h-100-p">

		<div class="jump-window-header">
			<a href="#" class="button button-active" id="btn-bus-simple">
				<span>BUSQUEDA</span>
			</a>
			<a href="#" class="button ml-10" id="btn-bus-advanced">
				<span>BUSQUEDA AVANZADA</span>
			</a>
			<a href="#" class="jump-window-close">
				<i class="fas fa-times"></i>
			</a>
		</div>
		
		<div class="jump-window-body jump-window-full-body jump-scroll">
			
			<div class="row p0 m0">
			
				<div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4 p0 m0">
					<div class="jump-window-group">
						<div class="jump-window-group-header">
							<span>SELECCIONE LA OBRA O PROYECTO</span>
						</div>
						<div class="jump-window-group-body p20">
							<span><?php echo DrawProyectos(); ?></span>
						</div>	
					</div>
					<div class="jump-window-group">
						<div class="jump-window-group-header">
							<span>SELECCIONE LA OBRA INFORMACION</span>
						</div>
						<div class="jump-window-group-body jump-scroll" id="filtered-layer-list">
						</div>	
					</div>
				</div>
				<div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8">
					<div id="mini-map" class="p20"></div>
					<div id="layer-preview-inner">
				
						<p class="title" id="layer-preview-title">Datos de Capa</p>
						<p class="content">Seleccione una capa para ver su descripción</p>
						
						<p class="mt-10 text-center">
							<a href="#" class="button" id="btn-layer-preview-addlayer">AGREGAR AL MAPA</a>
						</p>
					
					</div>
				</div>
			
			</div>
			
		</div>
	
	</div>

</div>