<?php

include("../pgconfig.php");

$dt_id = $_POST["dt_id"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_estadistica.get_dt_variales(".$dt_id.") ORDER BY origen ASC";

$query = pg_query($conn,$query_string);

$origen = "-1";

$first = true;

while ($r = pg_fetch_assoc($query)) {
	
	if ($r["origen"] != $origen) {
		
		$origen = $r["origen"];
		
		if (!$first) {
			
			?>
			
			</div>
				</div>
			
			<?php
			
		}
		
		?>
		
		<div class="panel-dataset-group-list">
			
			<div class="panel-dataset-group-list-header">
				<span>SELECCIONAR VARIABLE DE ORIGEN: <?php echo $r["origen"]; ?></span>
				<a href="#" class="toggeable-icon" onclick="$(this).children('i').toggleClass('fa-minus-circle'); $(this).parent().next().slideToggle('fast');">
					<i class="fa fa-plus-circle fa-minus-circle"></i>
				</a>
			</div>
			<div class="panel-dataset-group-list-body">
		
				<div class="panel-dataset-group-item">							
					<div class="pretty p-icon p-curve">
						<input type="checkbox" class="dataset-var-check"/>
						<div class="state">
							<i class="icon mdi mdi-check"></i>
							<label><?php echo $r["dt_variable_nombre"]; ?></label>
						</div>
					</div>
				</div>
		
		<?php
		
	}else{
		
		?>
		
		<div class="panel-dataset-group-item">							
			<div class="pretty p-icon p-curve">
				<input type="checkbox" class="dataset-var-check"/>
				<div class="state">
					<i class="icon mdi mdi-check"></i>
					<label><?php echo $r["dt_variable_nombre"]; ?></label>
				</div>
			</div>
		</div>
		
		<?php
		
	}
	
	$first = false;
	
}

?>
		
	</div>
</div>