<div id="dataset-view" data-visible="1" class="jump-flotant-nav jump-flotant-heightfill col col-xs-12 col-sm-12 col-md-12 col-lg-12">
	
	<div class="row jump-row">
	
		<select class="selectpicker">
			<option value="1">Agrupar por Todos</option>
			<option value="2">No Agrupar</option>
		</select>
		
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
	
	<div class="dataset">
	
		<div class="dataset-row dataset-row-header">
		
			<div class="dataset-cell dataset-cell-header">
				<span>PROVINCIA</span>
				<i class="fa fa-info-circle"></i>
			</div><div class="dataset-cell dataset-cell-header">
				<span>ESTACIÓN</span>
				<i class="fa fa-info-circle"></i>
			</div><div class="dataset-cell dataset-cell-header">
				<span>TEMPORALIDAD</span>
				<i class="fa fa-info-circle"></i>
			</div><div class="dataset-cell dataset-cell-header">
				<span>NIVEL DE AGUA</span>
				<i class="fa fa-info-circle"></i>
			</div><div class="dataset-cell dataset-cell-header">
				<span>TEMPERATURA</span>
				<i class="fa fa-info-circle"></i>
			</div><div class="dataset-cell dataset-cell-header">
				<span>VARIABLE 1</span>
				<i class="fa fa-info-circle"></i>
			</div><div class="dataset-cell dataset-cell-header">
				<span>VARIABLE 2</span>
				<i class="fa fa-info-circle"></i>
			</div><div class="dataset-cell dataset-cell-header">
				<span>VARIABLE 3</span>
				<i class="fa fa-info-circle"></i>
			</div><div class="dataset-cell dataset-cell-header">
				<span>VARIABLE 4</span>
				<i class="fa fa-info-circle"></i>
			</div><div class="dataset-cell dataset-cell-header">
				<span>VARIABLE 5</span>
				<i class="fa fa-info-circle"></i>
			</div>
		
		</div>
	
		<div class="dataset-row dataset-row-header">
		
			<div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">Todos</option>
					<?php
					
						$prov = array(
							"Buenos Aires",
							"Córdoba",
							"Santa Fe",
							"Río Negro",
							"Neuquén",
							"San Luis",
							"Mendoza",
							"Entre Ríos",
							"Corrientes",
							"Misiones",
							"Chubut",
							"Santa Cruz",
							"Formosa",
							"Chaco",
							"Tucumán",
							"Santiago del Estero",
							"Tierra del Fuego",
							"San Juan",
							"La Rioja",
							"Catamarca",
							"Jujuy",
							"Salta",
							"La Pampa"
						);
						
						for ($i=0; $i<sizeof($prov); $i++) {
							
							?>
							
							<option value="<?php echo ($i+1); ?>"><?php echo $prov[$i]; ?></option>
							
							<?php
							
						}
						
					?>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">Todos</option>
					<option value="1">Condor Clift</option>
					<option value="2">La Barrancosa</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">Todos</option>
					<option value="1">Verano 2017</option>
					<option value="1">Otoño 2017</option>
					<option value="1">Invierno 2017</option>
					<option value="1">Primavera 2017</option>
					<option value="1">Verano 2018</option>
					<option value="1">Otoño 2018</option>
					<option value="1">Invierno 2018</option>
					<option value="1">Primavera 2018</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">Todos</option>
					<option value="0.42">0.42</option>
					<option value="0.39">0.39</option>
					<option value=">0.41">0.41</option>
					<option value="0.38">0.38</option>
					<option value="0.42">0.42</option>
					<option value="0.39">0.39</option>
					<option value=">0.41">0.41</option>
					<option value="0.38">0.38</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">Todas</option>
					<option value="28">28º</option>
					<option value="35">35º</option>
					<option value=">5">5º</option>
					<option value="15">15º</option>
					<option value="0">0º</option>
					<option value="22">22º</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">Todos</option>
					<?php
					
						$prov = array(
							"Buenos Aires",
							"Córdoba",
							"Santa Fe",
							"Río Negro",
							"Neuquén",
							"San Luis",
							"Mendoza",
							"Entre Ríos",
							"Corrientes",
							"Misiones",
							"Chubut",
							"Santa Cruz",
							"Formosa",
							"Chaco",
							"Tucumán",
							"Santiago del Estero",
							"Tierra del Fuego",
							"San Juan",
							"La Rioja",
							"Catamarca",
							"Jujuy",
							"Salta",
							"La Pampa"
						);
						
						for ($i=0; $i<sizeof($prov); $i++) {
							
							?>
							
							<option value="<?php echo ($i+1); ?>"><?php echo $prov[$i]; ?></option>
							
							<?php
							
						}
						
					?>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">Todos</option>
					<option value="1">Condor Clift</option>
					<option value="2">La Barrancosa</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">Todos</option>
					<option value="1">Verano 2017</option>
					<option value="1">Otoño 2017</option>
					<option value="1">Invierno 2017</option>
					<option value="1">Primavera 2017</option>
					<option value="1">Verano 2018</option>
					<option value="1">Otoño 2018</option>
					<option value="1">Invierno 2018</option>
					<option value="1">Primavera 2018</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">Todos</option>
					<option value="0.42">0.42</option>
					<option value="0.39">0.39</option>
					<option value=">0.41">0.41</option>
					<option value="0.38">0.38</option>
					<option value="0.42">0.42</option>
					<option value="0.39">0.39</option>
					<option value=">0.41">0.41</option>
					<option value="0.38">0.38</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">Todas</option>
					<option value="28">28º</option>
					<option value="35">35º</option>
					<option value=">5">5º</option>
					<option value="15">15º</option>
					<option value="0">0º</option>
					<option value="22">22º</option>
				</select>
			</div>
		
		</div>
		
		<div class="dataset-row dataset-row-header">
		
			<div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">OPERACIONES</option>
					<option value="1">SUMA</option>
					<option value="2">PROMEDIO</option>
					<option value="3">MIN</option>
					<option value="4">MAX</option>
					<option value="5">CUENTA</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">OPERACIONES</option>
					<option value="1">SUMA</option>
					<option value="2">PROMEDIO</option>
					<option value="3">MIN</option>
					<option value="4">MAX</option>
					<option value="5">CUENTA</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">OPERACIONES</option>
					<option value="1">SUMA</option>
					<option value="2">PROMEDIO</option>
					<option value="3">MIN</option>
					<option value="4">MAX</option>
					<option value="5">CUENTA</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">OPERACIONES</option>
					<option value="1">SUMA</option>
					<option value="2">PROMEDIO</option>
					<option value="3">MIN</option>
					<option value="4">MAX</option>
					<option value="5">CUENTA</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">OPERACIONES</option>
					<option value="1">SUMA</option>
					<option value="2">PROMEDIO</option>
					<option value="3">MIN</option>
					<option value="4">MAX</option>
					<option value="5">CUENTA</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">OPERACIONES</option>
					<option value="1">SUMA</option>
					<option value="2">PROMEDIO</option>
					<option value="3">MIN</option>
					<option value="4">MAX</option>
					<option value="5">CUENTA</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">OPERACIONES</option>
					<option value="1">SUMA</option>
					<option value="2">PROMEDIO</option>
					<option value="3">MIN</option>
					<option value="4">MAX</option>
					<option value="5">CUENTA</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">OPERACIONES</option>
					<option value="1">SUMA</option>
					<option value="2">PROMEDIO</option>
					<option value="3">MIN</option>
					<option value="4">MAX</option>
					<option value="5">CUENTA</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">OPERACIONES</option>
					<option value="1">SUMA</option>
					<option value="2">PROMEDIO</option>
					<option value="3">MIN</option>
					<option value="4">MAX</option>
					<option value="5">CUENTA</option>
				</select>
			</div><div class="dataset-cell">
				<select class="selectpicker">
					<option value="-1">OPERACIONES</option>
					<option value="1">SUMA</option>
					<option value="2">PROMEDIO</option>
					<option value="3">MIN</option>
					<option value="4">MAX</option>
					<option value="5">CUENTA</option>
				</select>
			</div>
		
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>Catamarca</span>
			</div><div class="dataset-cell">
				<span>La Barrancosa</span>
			</div><div class="dataset-cell">
				<span>Primavera 2017</span>
			</div><div class="dataset-cell">
				<span>0.42</span>
			</div><div class="dataset-cell">
				<span>12º</span>
			</div><div class="dataset-cell">
				<span>Catamarca</span>
			</div><div class="dataset-cell">
				<span>La Barrancosa</span>
			</div><div class="dataset-cell">
				<span>Primavera 2017</span>
			</div><div class="dataset-cell">
				<span>0.42</span>
			</div><div class="dataset-cell">
				<span>12º</span>
			</div>
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>Santa Fe</span>
			</div><div class="dataset-cell">
				<span>Condor Clift</span>
			</div><div class="dataset-cell">
				<span>Invierno 2017</span>
			</div><div class="dataset-cell">
				<span>0.39</span>
			</div><div class="dataset-cell">
				<span>27º</span>
			</div><div class="dataset-cell">
				<span>Santa Fe</span>
			</div><div class="dataset-cell">
				<span>Condor Clift</span>
			</div><div class="dataset-cell">
				<span>Invierno 2017</span>
			</div><div class="dataset-cell">
				<span>0.39</span>
			</div><div class="dataset-cell">
				<span>27º</span>
			</div>
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>San Luis</span>
			</div><div class="dataset-cell">
				<span>La Barrancosa</span>
			</div><div class="dataset-cell">
				<span>Verano 2015</span>
			</div><div class="dataset-cell">
				<span>0.41</span>
			</div><div class="dataset-cell">
				<span>28º</span>
			</div><div class="dataset-cell">
				<span>San Luis</span>
			</div><div class="dataset-cell">
				<span>La Barrancosa</span>
			</div><div class="dataset-cell">
				<span>Verano 2015</span>
			</div><div class="dataset-cell">
				<span>0.41</span>
			</div><div class="dataset-cell">
				<span>28º</span>
			</div>
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>Neuquén</span>
			</div><div class="dataset-cell">
				<span>Condor Clift</span>
			</div><div class="dataset-cell">
				<span>Otoño 2017</span>
			</div><div class="dataset-cell">
				<span>0.38</span>
			</div><div class="dataset-cell">
				<span>5º</span>
			</div><div class="dataset-cell">
				<span>Neuquen</span>
			</div><div class="dataset-cell">
				<span>Condor Clift</span>
			</div><div class="dataset-cell">
				<span>Otoño 2017</span>
			</div><div class="dataset-cell">
				<span>0.38</span>
			</div><div class="dataset-cell">
				<span>5º</span>
			</div>
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>Córdoba</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Verano 2015</span>
			</div><div class="dataset-cell">
				<span>0.40</span>
			</div><div class="dataset-cell">
				<span>26º</span>
			</div><div class="dataset-cell">
				<span>Córdoba</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Verano 2015</span>
			</div><div class="dataset-cell">
				<span>0.40</span>
			</div><div class="dataset-cell">
				<span>26º</span>
			</div>
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>Chubut</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Invierno 2017</span>
			</div><div class="dataset-cell">
				<span>0.42</span>
			</div><div class="dataset-cell">
				<span>25º</span>
			</div><div class="dataset-cell">
				<span>Chubut</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Invierno 2017</span>
			</div><div class="dataset-cell">
				<span>0.42</span>
			</div><div class="dataset-cell">
				<span>25º</span>
			</div>
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>Misiones</span>
			</div><div class="dataset-cell">
				<span>Condor Clift</span>
			</div><div class="dataset-cell">
				<span>Verano 2018</span>
			</div><div class="dataset-cell">
				<span>0.39</span>
			</div><div class="dataset-cell">
				<span>32º</span>
			</div><div class="dataset-cell">
				<span>Misiones</span>
			</div><div class="dataset-cell">
				<span>Condor Clift</span>
			</div><div class="dataset-cell">
				<span>Verano 2018</span>
			</div><div class="dataset-cell">
				<span>0.39</span>
			</div><div class="dataset-cell">
				<span>32º</span>
			</div>
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>Río Negro</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Verano 2015</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>5º</span>
			</div><div class="dataset-cell">
				<span>Río Negro</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Verano 2015</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>5º</span>
			</div>
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>Chaco</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Invierno 2017</span>
			</div><div class="dataset-cell">
				<span>0.38</span>
			</div><div class="dataset-cell">
				<span>15º</span>
			</div><div class="dataset-cell">
				<span>Chaco</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Invierno 2017</span>
			</div><div class="dataset-cell">
				<span>0.38</span>
			</div><div class="dataset-cell">
				<span>15º</span>
			</div>
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>Tierra del Fuego</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Invierno 2017</span>
			</div><div class="dataset-cell">
				<span>0.41</span>
			</div><div class="dataset-cell">
				<span>0º</span>
			</div><div class="dataset-cell">
				<span>Tierra del Fuego</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Invierno 2017</span>
			</div><div class="dataset-cell">
				<span>0.41</span>
			</div><div class="dataset-cell">
				<span>0º</span>
			</div>
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>Salta</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Verano 2018</span>
			</div><div class="dataset-cell">
				<span>0.38</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Salta</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Verano 2018</span>
			</div><div class="dataset-cell">
				<span>0.38</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div>
		</div>
		
		<div class="dataset-row">
			<div class="dataset-cell">
				<span>Salta</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Verano 2018</span>
			</div><div class="dataset-cell">
				<span>0.41</span>
			</div><div class="dataset-cell">
				<span>22º</span>
			</div><div class="dataset-cell">
				<span>Salta</span>
			</div><div class="dataset-cell">
				<span>&nbsp;</span>
			</div><div class="dataset-cell">
				<span>Verano 2018</span>
			</div><div class="dataset-cell">
				<span>0.41</span>
			</div><div class="dataset-cell">
				<span>22º</span>
			</div>
		</div>
	
	</div>
	
	<div class="row jump-row">
	
		<div class="jus-between-f100 mt-30 align-center">
	
			<div>
		
				<a href="./estadisticas.php" id="stats-proceed" class="mt-50">< ANTERIOR</a>
			
			</div>
		
			<div class="pagination">
		
				<ul class="mp0">
					<li>
						<a href="#"><<</a>
					</li>
					<li>
						<a href="#">1</a>
					</li>
					<li>
						<a href="#">2</a>
					</li>
					<li>
						<a href="#">3</a>
					</li>
					<li>
						<a href="#">4</a>
					</li>
					<li>
						<a href="#">5</a>
					</li>
					<li>
						<a href="#">6</a>
					</li>
					<li>
						<span>...</span>
					</li>
					<li>
						<a href="#">25</a>
					</li>
					<li>
						<a href="#">>></a>
					</li>
				</ul>
			
			</div>
		
			<div>
		
				<a href="./estadisticas.php" class="black-button">MAPEAR</a>
				<a href="./estadisticas.php" class="black-button">GRAFICAR</a>
			
			</div>
	
		</div>
	
	</div>
	
</div>