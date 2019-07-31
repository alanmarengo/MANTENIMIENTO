<?php

include("../pgconfig.php");

$page = $_POST["page"];
$dt_id = $_POST["dt_id"];
$dt_variables = $_POST["dt_variables"];
$dt_cruce = $_POST["dt_cruce"];
$colstr = $_POST["colstr"];
$colstr_original = $colstr;

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_estadistica.get_dt_from($dt_id,'$dt_variables','$dt_cruce') AS query";

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$rquery_string = $data["query"];

$colstr_select = "\"" . implode("\"::TEXT,\"",explode(",",$colstr)) . "\"::TEXT";
$colstr = "\"" . implode("\",\"",explode(",",$colstr)) . "\"";

$colstr_order = str_replace(","," ASC,",$colstr);
$colstr_order = substr($colstr_order,0,strlen($colstr)-1) ."\" ASC";;

$new_query_string = "SELECT $colstr_select FROM ($rquery_string) AS sub ORDER BY " . $colstr_order;

?>
	
<div class="dataset">

	<div class="dataset-row dataset-row-header dataset-columns-row">

	<?php

	$col = explode(",",$colstr_original);
	
	$query = pg_query($conn,$rquery_string);	
	
	while($r = pg_fetch_assoc($query)) {
		
		for($i=0; $i<sizeof($col); $i++) {
			
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