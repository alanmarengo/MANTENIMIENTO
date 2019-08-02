<div id="dataset-view" data-visible="1" class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
	
	<div class="row jump-row">
		
		<div class="dataset-agroup">
		
			<select class="selectpicker" id="group-combo-view" class="group-combo-view">
				<option value="1">Agrupar por Todos</option>
				<option value="2">Agrupar Todo</option>
				<option value="3">No Agrupar</option>
			</select>
			
			<input type="button" value="Actualizar Vista" id="update-view" disabled="disabled">
		
		</div>
		
		<div class="date-filters">
		
			<ul>
				<li>						
					<input id="dated-search" class="datepicker" name="dated-search" type="text" data-jump-placeholder="Desde" placeholder="Desde">
					<a href="#" >
						<i class="fas fa-calendar"></i>
					</a>							
				</li>
				<li>						
					<input id="dateh-search" class="datepicker" name="dateh-search" type="text" data-jump-placeholder="Hasta" placeholder="Hasta">
					<a href="#" >
						<i class="fas fa-calendar"></i>
					</a>							
				</li>
			</ul>
		
		</div>
	
	</div>
	
	<div id="dataset-wrapper">
	
		<div id="dataset-header">
		
		</div>
		
		<div id="dataset-content">
		
		</div>
	
	</div>
	
</div>