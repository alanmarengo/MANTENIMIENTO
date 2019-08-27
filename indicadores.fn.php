<?php

function DrawAbrInd() {
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT clase_id,color_hex,color_head,cod_clase_alf FROM mod_catalogo.clase ORDER BY clase_id ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<div class="abr panel-abr" data-color="#31cbfd" data-bgcolor="#FFFFFF" data-active="0" data-cid="<?php echo $r["clase_id"]; ?>">
			<span><?php echo $r["cod_clase_alf"]; ?></span>
		</div>
		
		<?php
		
	}
	
}

function DrawContainersInd() {			

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT clase_id,cod_nom,color_hex,color_head,cod_clase_alf FROM mod_catalogo.clase ORDER BY clase_id ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<div class="layer-container" data-color="#31cbfd" data-cid="<?php echo $r["clase_id"]; ?>" style="border-color:#FFFFFF">
			<div class="layer-container-header" style="background-color:#31cbfd;">				
				<span><?php echo $r["cod_nom"]; ?></span>		
			</div>
			<div class="layer-container-body scrollbar-content">
				<?php DrawIndicadores($r["clase_id"]); ?>
			</div>
		</div>
		
		<?php
		
	}
	
}

function DrawIndicadores($clase_id) {			

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT DISTINCT * FROM mod_indicadores.ind_panel WHERE ind_id = " . $clase_id . " ORDER BY dt_titulo ASC";
	
	$query = pg_query($conn,$query_string);
	
	$records = pg_num_rows($query);
	
	if ($records>0) {
	
		while ($r = pg_fetch_assoc($query)) {
			
			?>
			
			<div class="layer-group" data-state="0" data-cid="<?php echo $r["clase_id"]; ?>">
			
				<div class="layer-header">
					
					<a href="#" class="layer-label" onclick="stats.dataset.loadVars(<?php echo $r["ind_id"]; ?>); stats.dataset.loadContent(<?php echo $r["ind_id"]; ?>);">
						<span><?php echo $r["ind_desc"]; ?></span>
					</a>
					
				</div>
			
			</div>
			
			<?php
			
		}
	
	}else{
		
		?>
		
		<div class="layer-group" data-state="0" data-cid="<?php echo $r["clase_id"]; ?>">
			
			<div class="layer-header">
				
				<p>
					<span>No se encontraron datasets asociados a esta clase.</span>
				</p>
				
			</div>
		
		</div>
		
		<?php
		
	}
	
}

function ComboCruce() {		

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT * FROM mod_estadistica.dt_cruce ORDER BY dt_cruce_etiqueta ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<option value="<?php echo $r["dt_cruce_table"]; ?>"><?php echo $r["dt_cruce_etiqueta"]; ?></option>
		
		<?php
		
	}
	
}

?>