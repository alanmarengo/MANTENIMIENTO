<?php

include("../pgconfig.php");

$page = $_POST["page"];
$dt_id = $_POST["dt_id"];
$dt_variables = $_POST["dt_variables"];
$dt_cruce = $_POST["dt_cruce"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_estadistica.get_dt_from($dt_id,'$dt_variables','$dt_cruce') AS query";

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$rquery_string = $data["query"];

?>
	
<div class="dataset">

	<div class="dataset-row dataset-row-header dataset-columns-row">

	<?php

	$query_string_a = array();
	$col = array();
	$coltypes = array();
	$bannedCols = array("geo_table_base","gid","geo_table_cruce","gid_cruce","cod_temp");
	
	$query = pg_query($conn,$rquery_string);
	
	while($r = pg_fetch_assoc($query)) {
		$i=0;
		foreach($r as $colname => $val) {
			
			//if (!in_array($colname,$bannedCols)) {
				
				
				$query_test = pg_query($conn,"SELECT \"$colname\",pg_typeof(\"$colname\") FROM ($rquery_string) AS sub LIMIT 1");
				$coltype = pg_field_type($query_test,0);
				
				array_push($query_string_a,"SELECT DISTINCT " . $colname. " FROM ($rquery_string) AS sub");
				array_push($coltypes,$coltype);
				array_push($col,$colname);
				
				?>
				
				<div class="dataset-cell dataset-cell-header" 
					data-col-index="<?php echo $i; ?>" 
					data-col-name="<?php echo $colname; ?>"
					data-col-type="<?php echo $coltype; ?>"
					>
					<span><?php echo $colname; ?></span>
					<i class="fa fa-info-circle"></i>
				</div>
				
				<?php
			
			//}
			
			$i++;
			
		}
		
		break;
		
	}
	
	?>

	</div>
	
	<div class="dataset-row dataset-row-header dataset-filter-row">

	<?php
	
	for ($i=0; $i<sizeof($query_string_a); $i++) {
		
		$query = pg_query($conn,$query_string_a[$i]);
		
		?>
		
		<div class="dataset-cell dataset-cell-header"
					data-col-index="<?php echo $i; ?>" 
					data-col-name="<?php echo $col[$i]; ?>"
					data-col-type="<?php echo $coltypes[$i]; ?>">
			<select class="selectpicker filter-combo">		
				<option value="-1">Todo</option>
				
				<?php
				
				while($r = pg_fetch_assoc($query)) {
					
				?>
					<option value="<?php echo $r[$col[$i]]; ?>"><?php echo $r[$col[$i]]; ?></option>
					
				<?php
					
				}
				
				?>
				
			</select>
		</div>
			
		<?php
	
	}

	?>

	</div>
	
	<div class="dataset-row dataset-row-header dataset-operation-row">

	<?php
	
	for ($i=0; $i<sizeof($col); $i++) {
		
	?>
		<div class="dataset-cell"
					data-col-index="<?php echo $i; ?>" 
					data-col-name="<?php echo $col[$i]; ?>"
					data-col-type="<?php echo $coltypes[$i]; ?>">>
			<select class="selectpicker operation-combo" tabindex="-98">
				<option value="-1">OPERACIONES</option>
				<option value="1">SUMA</option>
				<option value="2">PROMEDIO</option>
				<option value="3">MIN</option>
				<option value="4">MAX</option>
				<option value="5">CUENTA</option>
			</select>
		</div>
			
	
	<?php		
	
	}

	?>

	</div>
	
	<input type="hidden" name="colstr" id="colstr" value="<?php echo implode(",",$col); ?>">
	<input type="hidden" name="coltypestr" id="coltypestr" value="<?php echo implode(",",$coltypes); ?>">

</div>