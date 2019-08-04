<?php

include("../pgconfig.php");

$page = $_POST["page"];
$dt_id = $_POST["dt_id"];
$dt_variables = $_POST["dt_variables"];
$dt_cruce = $_POST["dt_cruce"];
$operations = $_POST["operations"];
$colstr = $_POST["colstr"];
$colgroup = $_POST["colgroup"];
$groupbycol = $_POST["groupbycol"];
$groupindex = $_POST["groupbycol_index"];
$groupname = $_POST["groupbycol_name"];
$groupby_val = $_POST["groupby_val"];
$colstr_original = $colstr;

$colstrType = -1;

if (isset($_POST["colstrType"])) {
	$colstrType = $_POST["colstrType"];
}
$filters = -1;

if (isset($_POST["filters"])) {
	$filters = $_POST["filters"];
}
	
$no_op = false;
	
for ($i=0; $i<sizeof($operations); $i++) {
	
	if ($operations[$i] == -1) {
		
		$no_op = true;
		break;
		
	}
	
}

$group = "";

if (($groupby_val == 2) || ($groupby_val == 3)) {
	
	$no_op = true;
	
}else{
	
	if (($groupby_val != 1) && ($groupby_val != -1)) {
		
		$group = " GROUP BY \"$groupby_val\"";
		
	}
	
}

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

if ($filters != -1) {
	
	$filter_str = "";
	
	for ($i=0; $i<sizeof($filters); $i++) {
		
		if ($filters[$i]["filtertype"] != -1) {
			
			$slashes = "";
			
			if ($filters[$i]["coltype"] == "text") {
	
				$slashes = "\"";
				$filter_str .= "\"".$filters[$i]["colname"]."\" ILIKE '%" . $filters[$i]["filterval"] . "%' AND ";
				
			}else{
				
				$slashes = "";
				$filter_str .= "\"".$filters[$i]["colname"]."\" " . $filters[$i]["filtertype"] . " " . $slashes . $filters[$i]["filterval"] . $slashes . " AND ";
				
			}
			
			
			
		}		
	
	}
	
	$filter_str = substr($filter_str,0,strlen($filter_str)-5);
	
}

$query_string = "SELECT * FROM mod_estadistica.get_dt_from($dt_id,'$dt_variables','$dt_cruce') AS query";

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$rquery_string = $data["query"];

$colstr_select = "\"" . implode("\"::TEXT,\"",explode(",",$colstr)) . "\"::TEXT";
$colstr = "\"" . implode("\",\"",explode(",",$colstr)) . "\"";

$colstr_order = str_replace(","," ASC,",$colstr) . " ASC";
//$colstr_order = substr($colstr_order,0,strlen($colstr)-1);
$colstr_order = " ORDER BY " . $colstr_order;

if ($no_op) {
	
	if ($colstrType == -1) {
	
		$colstr_select = "\"" . implode("\"::TEXT,\"",explode(",",$colstr)) . "\"::TEXT";
	
	}else{
		
		$col = explode(",",$colstr);
		$colType = explode(",",$colstrType);
		$colstr_select = "";
		
		for ($i=0; $i<sizeof($col); $i++) {
			
			$colstr_select .= $col[$i] . "::" . $colType[$i] . " AS $col[$i],";
			
		}
		
	}
	
}else{
	
	$col = explode(",",$colstr);
	$colType = explode(",",$colstrType);
	$colstr_select = "";
	
	for ($i=0; $i<sizeof($col); $i++) {
		
		if ($operations[$i] == "NONE") {
			
			$colstr_select .= $col[$i] . "::" . $colType[$i] . " AS " . $col[$i] . ",";
			
		}else{
			
			if ($i<3) {				
			
				if ($groupbycol == 1) {
				
					$colstr_select .= $operations[$i] . "(" . $col[$i] . ")::" . $colType[$i] . " AS " . $col[$i] . ",";
			
				}else{
					
					$colstr_select .="MAX('')::TEXT AS " . $col[$i] . ",";
					
				}
				
			}else{
				
				$colstr_select .= $operations[$i] . "(" . $col[$i] . ")::" . $colType[$i] . " AS " . $col[$i] . ",";
				
			}
		
		}
		
	}
	
}

$colstr_select = substr($colstr_select,0,strlen($colstr_select)-1);

$group_by_str = " GROUP BY " . $groupby_val . " ";

$distinct = "";

if ($groupby_val == 2) {
	
	$distinct = " DISTINCT";
	
}

if ($filter_str == "") {

	$new_query_string = "SELECT$distinct $colstr_select FROM ($rquery_string) AS sub $group $colstr_order";

}else{
	
	$new_query_string = "SELECT$distinct $colstr_select FROM ($rquery_string) AS sub WHERE $filter_str $group $colstr_order";
	//$new_query_string = "SELECT $colstr_select FROM ($rquery_string) AS sub $group_by_str HAVING $filter_str $colstr_order";
	
}

if (($groupbycol == 1) && ($groupbycol_index == 0)) {

	$gm_string = explode("ORDER",explode("SELECT",$new_query_string));
	
	var_dump($gm_string);
	
}

?>
	
<div class="dataset">

	<?php

	$col = explode(",",$colstr_original);
	
	$query = pg_query($conn,$new_query_string);	
	
	while($r = pg_fetch_assoc($query)) {
		
	?>

	<div class="dataset-row dataset-row-header dataset-columns-row">
	
	<?php
		
		for($i=0; $i<sizeof($col); $i++) {
			
			?>
			
			<div class="dataset-cell dataset-cell-header" data-col-index="<?php echo $i; ?>">
				<span><?php echo $r[$col[$i]]; ?></span>
			</div>
			
			<?php
			
		}

		?>

	</div>
	
	<?php
		
	}
	
	?>

</div>