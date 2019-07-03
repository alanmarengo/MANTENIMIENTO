<div class="jump-window jump-align-right jump-flotant-heightfill jump-flotant-heightfill-top col col-xs-12 col-sm-12-col-md-8 col-lg-8" id="popup-geovisor">

	<div class="jump-window-inner h-100-p">

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
		
		<?php include("./popup.advanced-search.php"); ?>
		
		<div class="jump-window-body jump-window-full-body jump-scroll">
			
			<div class="jump-row row p0 m0">
			
				<div class="col col-xs-12 col-sm-12 col-md-5 col-lg-5 p0 m0 flex-column">
					<div class="jump-window-group" id="popup-basic-filters">
						<div class="jump-window-group-header">
							<span>OBRA O PROYECTO</span>
						</div>
						<div class="jump-window-group-body p20">
							<span><?php echo DrawProyectos(); ?></span>
						</div>	
					</div>
					<div class="jump-window-group flex-column flex-grow">
						<div class="jump-window-group-header">
							<span>BUSCAR INFORMACION</span>
						</div>
						<div class="jump-window-group-body flex-grow jump-flotant-height-transform">
							<div id="filtered-layer-list" class="jump-scroll">
							</div>
						</div>	
					</div>
				</div>
				<div class="col col-xs-12 col-sm-12 col-md-7 col-lg-7 p20 flex-column">
					<div id="mini-map" class="ptb-10"></div>
					<div id="layer-preview-block" class="ptb-10"></div>
					<div id="layer-preview-inner">
				
						<p class="title" id="layer-preview-title">Datos de Capa</p>
						<p class="content">Seleccione una capa para ver su descripci&oacute;n</p>
						
						<p class="mt-10 text-center">
							<a href="#" class="button" id="btn-layer-preview-addlayer">AGREGAR AL MAPA</a>
						</p>
					
					</div>
				</div>
			
			</div>
			
		</div>
	
	</div>

</div>