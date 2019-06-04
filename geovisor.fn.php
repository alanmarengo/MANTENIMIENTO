<?php

function DrawAbr() {			

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

function DrawContainers() {			

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT clase_id,cod_nom,color_hex,color_head,cod_clase_alf,mod_geovisores.get_layers_count_by_clase(clase_id) AS layer_count FROM mod_catalogo.clase ORDER BY clase_id ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<div class="layer-container" data-color="<?php echo $r["color_hex"]; ?>" data-cid="<?php echo $r["clase_id"]; ?>" style="border-color:<?php echo $r["color_hex"]; ?>;">
			<div class="layer-container-header" style="background-color:<?php echo $r["color_head"]; ?>;">
				<a href="javascript:void(0);">
					<i class="fa fa-eye"></i>
				</a>
				<span><?php echo $r["cod_nom"]; ?> (<?php echo $r["layer_count"]; ?>)</span>		
			</div>
			<div class="layer-container-body scrollbar-content">
				<?php DrawLayers($r["clase_id"]); ?>
			</div>
		</div>
		
		<?php
		
	}
	
}

function DrawLayers($clase_id) {			

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT * FROM mod_geovisores.vw_layers WHERE clase_id = " . $clase_id . " ORDER BY layer_desc ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<div class="layer-header" data-state="0">
			<!--<a href="javascript:void(0);">
				<i class="fa fa-eye"></i>
			</a>-->
			
			<div class="pretty p-default p-curve p-toggle">
				<input type="checkbox" class="layer-checkbox" data-layer="<?php echo $r["layer_wms_layer"]; ?>" data-wms="<?php echo $r["layer_wms_server"]; ?>"/>
				<div class="state p-success p-on">
					<i class="fa fa-eye"></i>
				</div>
				<div class="state p-danger p-off">
					<i class="fa fa-eye-slash"></i>
				</div>
			</div>

			<span><?php echo $r["layer_desc"]; ?></span>
			
			<a href="#" class="simple-tree-pm-button">
				<i class="fa fa-plus-circle popup-panel-tree-item-icon-toggler popup-icon"></i>
			</a>
		</div>
		
		<?php
		
	}
	
}

?>