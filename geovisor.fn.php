<?php

function ListaProyectos() {			

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT proyecto_id,proyecto_titulo FROM mod_geovisores.proyectos ORDER BY proyecto_titulo ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<a class="dropdown-item" href="#" data-id="<?php echo $r["proyecto_id"]; ?>"><?php echo $r["proyecto_titulo"]; ?></a>
		
		<?php
		
	}
	
}

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
	
	$query_string = "SELECT clase_id,cod_nom,color_hex,color_head,cod_clase_alf FROM mod_catalogo.clase ORDER BY clase_id ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<div class="layer-container" data-color="<?php echo $r["color_hex"]; ?>" data-cid="<?php echo $r["clase_id"]; ?>" style="border-color:<?php echo $r["color_hex"]; ?>;">
			<div class="layer-container-header" style="background-color:<?php echo $r["color_head"]; ?>;">
				<div class="pretty p-default p-curve p-toggle">
					<input type="checkbox" class="layer-checkbox default-empty-checkbox" id="layer-checkbox-<?php echo $r["layer_id"]; ?>" data-layer="<?php echo $r["layer_wms_layer"]; ?>" data-wms="<?php echo $r["layer_wms_server"]; ?>"/>
					<div class="state p-success p-on">
						<i class="fa fa-eye"></i>
					</div>
					<div class="state p-danger p-off">
						<i class="fa fa-eye-slash"></i>
					</div>
				</div>
				<span><?php echo $r["cod_nom"]; ?> (<span id="abr-layer-count-<?php echo $r["clase_id"]; ?>" class="abr-layer-count"></span>)</span>		
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
	
	$query_string = "SELECT DISTINCT * FROM mod_geovisores.vw_layers WHERE clase_id = " . $clase_id . " ORDER BY layer_desc ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<div class="layer-group" data-state="0" data-layer="<?php echo $r["layer_id"]; ?>" data-cid="<?php echo $r["clase_id"]; ?>" data-layer-type="<?php echo $r["tipo_layer_id"]; ?>">
		
			<div class="layer-header">
				<!--<a href="javascript:void(0);">
					<i class="fa fa-eye"></i>
				</a>-->
				
				<div class="pretty p-default p-curve p-toggle">
					<input type="checkbox" class="layer-checkbox default-empty-checkbox" id="layer-checkbox-<?php echo $r["layer_id"]; ?>" data-lid="<?php echo $r["layer_id"]; ?>" data-cid="<?php echo $r["clase_id"]; ?>" data-added="0" data-layer="<?php echo $r["layer_wms_layer"]; ?>" data-wms="<?php echo $r["layer_wms_server"]; ?>" data-layer-type="<?php echo $r["tipo_layer_id"]; ?>"/>
					<div class="state p-success p-on">
						<i class="fa fa-eye"></i>
					</div>
					<div class="state p-danger p-off">
						<i class="fa fa-eye-slash"></i>
					</div>
				</div>
				
				<a href="#" class="layer-label" onclick="$(this).parent().next().slideToggle('slow');">
					<span><?php echo $r["layer_desc"]; ?></span>
				</a>
				
				<!--<a href="#" class="simple-tree-pm-button ml-1 btn-plus-layer">
					<i class="fa fa-plus-circle popup-panel-tree-item-icon-toggler popup-icon"></i>
				</a>-->
				
				<a href="#" class="simple-tree-pm-button" onclick="geomap.panel.removeLayer(<?php echo $r["layer_id"]; ?>,<?php echo $r["clase_id"]; ?>); geomap.map.updateLayerCount();">
					<i class="fa fa-trash popup-panel-tree-item-icon-toggler popup-icon"></i>
				</a>
			</div>
			
			<div class="layer-body">
			
				<div class="layer-icons">
				
					<div class="layer-icon" onclick="geomap.map.zoomToLayerExtent(<?php echo $r["layer_id"]; ?>);">
						<a href="javascript:void(0);">
							<img src="./images/geovisor/icons/layer-bar-zoom.png">
						</a>
					</div>
				
					<div class="layer-icon" onclick="$(this).children('a').trigger('click');">
						<a href="<?php echo $r["layer_metadata_url"]; ?>" target="_blank">
							<img src="./images/geovisor/icons/layer-bar-info.png">
						</a>
					</div>
				
					<div class="layer-icon" onclick="$('.layer-tool-wrapper').not('#layer-colorpicker-<?php echo $r["layer_id"]; ?>').hide(); $('#layer-colorpicker-<?php echo $r["layer_id"]; ?>').slideToggle('slow');">
						<a href="javascript:void(0);">
							<img src="./images/geovisor/icons/layer-bar-relleno.png">
						</a>
					</div>
				
					<div class="layer-icon" onclick="$('.layer-tool-wrapper').not('#layer-opacity-<?php echo $r["layer_id"]; ?>').hide(); $('#layer-opacity-<?php echo $r["layer_id"]; ?>').slideToggle('slow');">
						<a href="javascript:void(0);">
							<img src="./images/geovisor/icons/layer-bar-gota.png">
						</a>
					</div>
				
					<div class="layer-icon" onclick="$(this).children('a').trigger('click');">
						<a href="http://observatorio.atic.com.ar/cgi-bin/mapserver?map=wms_atic&service=WFS&version=1.0.0&request=GetFeature&typeName=<?php echo $r["layer_wms_layer"]; ?>&outputFormat=shape-zip" target="_blank">
							<img src="./images/geovisor/icons/layer-bar-download.png">
						</a>
					</div>
				
				</div>
			
				<div class="layer-colorpicker layer-tool-wrapper" id="layer-colorpicker-<?php echo $r["layer_id"]; ?>">
					
					<div class="colorpicker-bullet-content">
						<div class="colorpicker-bullet"></div>
					</div>
					
					<div id="layer-colorpicker-inner-<?php echo $r["layer_id"]; ?>">
					
					</div>
					
				</div>
			
				<div class="layer-opacity layer-tool-wrapper" id="layer-opacity-<?php echo $r["layer_id"]; ?>">
					
					<div class="opacity-bullet-content">
						<div class="opacity-bullet"></div>
					</div>
					
					<p>
						<label for="transp-value-<?php echo $r["layer_id"]; ?>">Opacidad:</label>
						<input type="text" id="transp-value-<?php echo $r["layer_id"]; ?>" class="transp-value" readonly="readonly" style="border:0;">
					</p>
					
					<div class="slider-range" id="slider-range-<?php echo $r["layer_id"]; ?>"></div>
					
				</div>
				
				<div class="layer-legend" id="layer-legend-<?php echo $r["layer_id"]; ?>"></div>
			
			</div>
		
		</div>
		
		<?php
		
	}
	
}

function DrawLayersSearch($pattern) {			

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT DISTINCT * FROM mod_geovisores.vw_layers WHERE layer_desc ILIKE '%" . $pattern . "%' ORDER BY layer_desc ASC";
	
	$query = pg_query($conn,$query_string);
	
	$output = "<ul>";
	
	while ($r = pg_fetch_assoc($query)) {

		$output .= "<li>";
		$output .= "<a href=\"javascript:void(0);\" onclick=\"geomap.panel.AddLayer(" . $r["clase_id"] . "," . $r["layer_id"] . ")\">" . $r["layer_desc"] . "</a>";
		$output .= "</li>";

	}
	
	$output .= "</ul>";
	
}

function DrawProyectos() {			

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT * FROM mod_catalogo.sub_proyecto ORDER BY sub_proyecto_desc ASC";
	
	$query = pg_query($conn,$query_string);
	
	while ($r = pg_fetch_assoc($query)) {
		
		?>
		
		<div class="popup-panel-tree-item">
			<div class="pretty p-icon p-curve">
				<input type="checkbox" class="basic-filter-checkbox default-empty-checkbox" data-spid="<?php echo $r["sub_proyecto_id"]; ?>"/>
				<div class="state">
					<i class="icon mdi mdi-check" onclick="$(this).parent().prev('input[type=checkbox]').trigger('click');"></i>
					<label><?php echo $r["sub_proyecto_desc"]; ?></label>
				</div>
			</div>
		</div>
		
		<?php
		
	}
	
}

function DrawComboSimple($id,$desc,$schema,$table,$opini,$opini_label,$opini_val,$hname,$hid) {

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);				
	
	$query_string = "SELECT $id,$desc FROM $schema.$table ORDER BY $desc ASC";
	
	$query = pg_query($conn,$query_string);
				
	?>
	
	<select class="selectpicker" data-width="100%" 
	<?php 
		if($hname) {
			echo "name=\"$hname\"";
		}
		if($hid) {
			echo "id=\"$hid\"";
		}?>>
	<?php
	
	if ($opini) {
			
		?>
			
	<option value="<?php echo $opini_val; ?>"><?php echo $opini_label; ?></option>
			
		<?php
			
	}
				
	while ($r = pg_fetch_assoc($query)) {
		
	?>
	
		<option value="<?php echo $r[$id]; ?>"><?php echo $r[$desc]; ?></option>
				
	<?php
					
	}
	
	?>
	
	</select>
	
	<?php
	
}

function DrawComboSimpleFN($id,$desc,$schema,$table,$opini,$opini_label,$opini_val,$hname,$hid,$fn) {

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);				
	
	$query_string = "SELECT $id,$desc FROM $schema.$table ORDER BY $desc ASC";
	
	$query = pg_query($conn,$query_string);
				
	?>
	
	<select onchange="<?php echo str_replace($id,"this.options[this.selectedIndex].value",$fn); ?>" class="selectpicker" 
	<?php 
		if($hname) {
			echo "name=\"$hname\"";
		}
		if($hid) {
			echo "id=\"$hid\"";
		}?>>
	<?php
				
	while ($r = pg_fetch_assoc($query)) {

		if ($opini) {
			
			?>
			
			<option value="<?php echo $opini_val; ?>"><?php echo $opini_label; ?></option>
			
			<?php
			
		}
	?>
	
		<option value="<?php echo $r[$id]; ?>"><?php echo $r[$desc]; ?></option>
				
	<?php
					
	}
	
	?>
	
	</select>
	
	<?php
	
}

?>