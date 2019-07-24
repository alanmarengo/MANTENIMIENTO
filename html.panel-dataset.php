<div id="nav-panel-dataset" data-visible="1" class="jump-flotant-heightfill jump-scroll nav-level-1 col col-nav col-xs-12 col-sm-12 col-md-6 col-lg-6">
	
	<div class="row jump-row panel-dataset-list-hint">
	
		<p>Seleccione un tema y luego un dataset para comenzar a operar</p>
	
	</div>
	
	<div class="row jump-row">
	
		<div id="panel-dataset-list" class="jump-scroll jump-posrel">
			
			<?php
			
			$letter = array("A","B","C");
			
			for ($i = 0; $i < 3; $i++) {
				
			?>
			
			<div class="panel-dataset-group-list">
			
				<div class="panel-dataset-group-list-header">
					<span>SELECCIONAR VARIABLE DE ORIGEN <?php echo $letter[$i]; ?></span>
					<a href="#" class="toggeable-icon">
						<i class="fa fa-minus-circle"></i>
					</a>
				</div>
				<div class="panel-dataset-group-list-body">
				
					<div class="panel-dataset-group-item">							
						<div class="pretty p-icon p-curve">
							<input type="checkbox" />
							<div class="state">
								<i class="icon mdi mdi-check"></i>
								<label>Nombre de la Variable</label>
							</div>
						</div>
					</div>
				
					<div class="panel-dataset-group-item">							
						<div class="pretty p-icon p-curve">
							<input type="checkbox" />
							<div class="state">
								<i class="icon mdi mdi-check"></i>
								<label>Nombre de la Variable</label>
							</div>
						</div>
					</div>
				
					<div class="panel-dataset-group-item">							
						<div class="pretty p-icon p-curve">
							<input type="checkbox" />
							<div class="state">
								<i class="icon mdi mdi-check"></i>
								<label>Nombre de la Variable</label>
							</div>
						</div>
					</div>
				
					<div class="panel-dataset-group-item">							
						<div class="pretty p-icon p-curve">
							<input type="checkbox" />
							<div class="state">
								<i class="icon mdi mdi-check"></i>
								<label>Nombre de la Variable</label>
							</div>
						</div>
					</div>
					
				</div>
			
			</div>
			<?php
			
			}
			
			?>
		
		</div>
	
	</div>
	
	<div class="row jump-row">
	
		<select class="selectpicker mt-40">
		
			<option value="-1" selected>Cruce Espacial</option>
			<option value="1">Provincia</option>
			<option value="2">Ambiente</option>
		
		</select>
	
	</div>
	
	<div class="row jump-row jus-right">
	
		<a href="./estadisticas-vista.php" id="stats-proceed" class="mt-50">SIGUIENTE ></a>
	
	</div>
	
</div>