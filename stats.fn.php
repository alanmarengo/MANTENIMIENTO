<?php

function DrawAbrStats() {
	
	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT clase_id,color_hex,color_head,cod_clase_alf FROM mod_catalogo.clase ORDER BY clase_id ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<div class="abr panel-abr" data-color="<?php echo $r["color_hex"]; ?>" data-bgcolor="<?php echo $r["color_head"]; ?>" data-active="0" data-cid="<?php echo $r["clase_id"]; ?>">
			<span><?php echo $r["cod_clase_alf"]; ?></span>
		</div>
		
		<?php
		
	}
	
}

function DrawContainersStats() {			

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT clase_id,cod_nom,color_hex,color_head,cod_clase_alf FROM mod_estadistica.vw_dt ORDER BY clase_id ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<div class="layer-container" data-color="<?php echo $r["color_hex"]; ?>" data-cid="<?php echo $r["clase_id"]; ?>" style="border-color:<?php echo $r["color_hex"]; ?>;">
			<div class="layer-container-header" style="background-color:<?php echo $r["color_head"]; ?>;">				
				<span><?php echo $r["cod_nom"]; ?> (<span id="abr-layer-count-<?php echo $r["clase_id"]; ?>" class="abr-layer-count"></span>)</span>		
			</div>
			<div class="layer-container-body scrollbar-content">
				<?php DrawDatasets($r["clase_id"]); ?>
			</div>
		</div>
		
		<?php
		
	}
	
}

function DrawDatasets($clase_id) {			

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT DISTINCT * FROM mod_estadistica.vw_dt WHERE clase_id = " . $clase_id . " ORDER BY dt_titulo ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<div class="layer-group" data-state="0" data-cid="<?php echo $r["clase_id"]; ?>">
		
			<div class="layer-header">
				
				<a href="#" class="layer-label" onclick="$(this).parent().next().slideToggle('slow');">
					<span><?php echo $r["dt_titulo"]; ?></span>
				</a>
				
			</div>
			
			<div class="layer-body">
			</div>
		
		</div>
		
		<?php
		
	}
	
}

?>