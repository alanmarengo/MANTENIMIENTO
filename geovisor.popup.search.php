<div class="row geovisor-toggleable-content" id="geovisor-popup-search">				
				
	<div class="col col-md-12 col-sm-12 col-xs-12 geovisor-form-group">
		
		<form id="frm-adv-search">
		
			<div class="row">
			
				<div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
				
					<div class="form-group">
						
						<i class="fa fa-search"></i>
						<input type="text" placeholder="Búsqueda..." class="icon-input">
					
					</div>
				
				</div>
			
				<div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
				
					<div class="form-group">
				
						<i class="fa fa-calendar"></i>
						<input type="date" placeholder="Desde..." name="adv-search-fdesde">
					
					</div>
				
				</div>
			
				<div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
				
					<div class="form-group">
				
						<i class="fa fa-calendar"></i>
						<input type="date" placeholder="Hasta..." name="adv-search-fhasta">
					
					</div>
				
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">			
				
					<div class="form-group">

						<input type="text" placeholder="Proyecto...">
					
					</div>
				
				</div>
			
				<div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12">	
				
					<div class="form-group">
							
						<?php echo DrawComboSimple("clase_id","clase_desc","mod_catalogo","clase",true,"Clase",-1,"adv-search-clase-combo","adv-search-clase-combo"); ?>
					
					</div>
				
				</div>
			
				<div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">	
				
					<div class="form-group">			
				
						<?php echo DrawComboSimple("subclase_id","subclase_desc","mod_catalogo","subclase",true,"Sub Clase",-1,"adv-search-subclase-combo","adv-search-subclase-combo"); ?>
					
					</div>
				
				</div>
			
				<div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">	
				
					<div class="form-group">
				
						<input type="text" placeholder="Ejecutor...">
					
					</div>
				
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12">
				
					<div class="form-group">			
				
						<?php echo DrawComboSimple("responsable_id","responsable_desc","mod_catalogo","vw_estudio_responsable",true,"Responsable",-1,"adv-search-responsable-combo","adv-search-responsable-combo"); ?>
					
					</div>
				
				</div>
			
				<div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12">
				
					<div class="form-group">			
				
						<?php echo DrawComboSimple("cod_esia_id","titulo","mod_catalogo","cod_esia",true,"Código ESIA",-1,"adv-search-esia-combo","adv-search-esia-combo"); ?>
					
					</div>
				
				</div>
			
				<div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
				
					<div class="form-group">
				
						<?php echo DrawComboSimple("objetos_id","objetos_nombre","mod_catalogo","objeto",true,"Objeto",-1,"adv-search-objeto-combo","adv-search-objeto-combo"); ?>

					
					</div>
				
				</div>
			
				<div class="col col-lg-3 col-md-3 col-sm-12 col-xs-12">
				
					<div class="form-group form-group-button">
				
						<a class="blue-button block" href="#" id="btn-adv-search">
							<span>BUSCAR</span>
						</a>
					
					</div>
				
				</div>
			
			</div>
		
		</form>
		
	</div>
	
	

</div>