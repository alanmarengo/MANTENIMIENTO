<?php

include("../pgconfig.php");

$proyectos = $_POST["proyectos"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);
	
for ($i=0; $i<sizeof($proyectos); $i++) {
	
	$query_string = "SELECT clase_id,subclase_id,clase_desc,subclase_desc FROM mod_geovisores.vw_catalogo_search WHERE sub_proyecto_id IN (".implode(",",$proyectos).") GROUP BY clase_id,subclase_id,clase_desc,subclase_desc ORDER BY clase_desc ASC, subclase_desc ASC;";
	
	$query = pg_query($conn,$query_string);
	
	while($r = pg_fetch_assoc($query)) {
	
	?>
	
	<div class="popup-panel-tree-item" data-state="0">
		<div class="popup-panel-tree-item-header">
			<i class="fas fa-folder popup-panel-tree-item-icon popup-icon"></i>
			<a href="#" class="popup-panel-tree-item-label popup-text">
				<span><?php echo $r["clase_desc"] . " - " . $r["subclase_desc"]; ?></span>
			</a>
			<a href="#" class="simple-tree-pm-button">
				<i class="fa fa-plus-circle popup-panel-tree-item-icon-toggler popup-icon"></i>
			</a>
		</div>
		
		<div class="popup-panel-tree-item-subpanel">
			<ul>
			
				<?php
				
				$layer_query_string = "SELECT * FROM mod_geovisores.vw_layers WHERE clase_id = " . $r["clase_id"] . " AND subclase_id = " . $r["subclase_id"];
				$layer_query = pg_query($conn,$layer_query_string);
				
				while($l = pg_fetch_assoc($layer_query)) {
					
					?>
					
					<li>
						<i class="fa fa-cube popup-text-active"></i>
						<?php echo $l["layer_desc"]; ?>
					</li>
					
					<?php
					
				}
				
				?>
			</ul>
		</div>
	</div>
	
	<?php
	
	}
	
}

?>