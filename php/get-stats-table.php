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
	
	$query = pg_query($conn,$rquery_string);
	
	while($r = pg_fetch_assoc($query)) {		
			
		if ($first) {
		
			foreach($r as $colname => $val) {
		
				array_push($col,$colname);		
			
			}	
		
			$first = false;	
			
		}		
			
		for ($i=0; $i<sizeof($col); $i++) {
			
			?>
			
			<div class="dataset-cell dataset-cell-header">
				<span><?php echo $r[$col[$i]]; ?></span>
			</div>
			
			<?php
			
		}
		
	}

	?>

	</div>

</div>