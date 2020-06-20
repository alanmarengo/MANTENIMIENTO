<div class="jump-row row geovisor-toggleable-content" id="geovisor-popup-search-mobile">				
				
	<div class="col col-md-12 col-sm-12 col-xs-12 geovisor-form-group">
		
		<form id="frm-adv-search-mobile" class="jump-row">
		
			<div class="jump-row row">
			
				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group">
						
						<i class="fa fa-search"></i>
						<input type="text" placeholder="Búsqueda..." name="adv-search-busqueda" class="icon-input">
					
					</div>
				
				</div>
				
			</div>			
		
			<div class="jump-row row">
			
				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group">
				
						<i class="fa fa-calendar"></i>
						<input type="date" placeholder="Desde..." name="adv-search-fdesde">
					
					</div>
				
				</div>
				
			</div>			
		
			<div class="jump-row row">
			
				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group">
				
						<i class="fa fa-calendar"></i>
						<input type="date" placeholder="Hasta..." name="adv-search-fhasta">
					
					</div>
				
				</div>
			
			</div>
			
			<div class="jump-row row">
			
				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">		
				
					<div class="form-group">

						<?php echo DrawComboSimple("sub_proyecto_id","sub_proyecto_desc","mod_catalogo","sub_proyecto",true,"Proyecto","","adv-search-proyecto-combo","adv-search-proyecto-combo"); ?>
					
					</div>
				
				</div>
				
			</div>			
		
			<div class="jump-row row">
			
				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group">
							
						<?php echo DrawComboSimpleClase("clase_id","clase_desc","mod_catalogo","clase",true,"Clase",-1,"adv-search-clase-combo","adv-search-clase-combo"); ?>

					</div>
				
				</div>
				
			</div>			
		
			<div class="jump-row row">
			
				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group">			
				
						<?php echo DrawComboSimple("subclase_id","subclase_desc","mod_geovisores","vw_filtros_avanzados_subclase",true,"Sub Clase",-1,"adv-search-subclase-combo","adv-search-subclase-combo"); ?>

					</div>
				
				</div>
				
			</div>			
		
			<div class="jump-row row">
			
				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group">
				
						<input type="text" placeholder="Ejecutor...">
					
					</div>
				
				</div>
			
			</div>
			
			<div class="jump-row row">
			
				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group">			
				
						<?php echo DrawComboSimple("responsable_desc","responsable_desc","mod_catalogo","vw_estudio_responsable",true,"Responsable","","adv-search-responsable-combo","adv-search-responsable-combo"); ?>
					
					</div>
				
				</div>
				
			</div>			
		
			<div class="jump-row row">
			
				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group">			
				
						<?php echo DrawComboSimple("cod_esia_id","titulo","mod_catalogo","cod_esia",true,"Código ESIA",-1,"adv-search-esia-combo","adv-search-esia-combo"); ?>
					
					</div>
				
				</div>
				
			</div>			
		
			<div class="jump-row row">
			
				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group">
				
						<?php echo DrawComboSimple("objetos_id","objetos_nombre","mod_catalogo","objeto",true,"Objeto",-1,"adv-search-objeto-combo","adv-search-objeto-combo"); ?>

					
					</div>
				
				</div>
				
			</div>			
		
			<div class="jump-row row">
			
				<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group form-group-button" style="margin:0; padding:0;">
				
						<a class="black-button-2" href="#" id="btn-adv-search-mobile">
							<span>BUSCAR</span>
						</a>
					
					</div>
				
				</div>
				
			</div>
		
		</form>
		
	</div>
	
	

</div>