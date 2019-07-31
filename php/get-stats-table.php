<?php

include("../pgconfig.php");

$page = $_POST["page"];
$dt_id = $_POST["dt_id"];
$dt_variables = $_POST["dt_variables"];
$dt_cruce = $_POST["dt_cruce"];
$colstr = $_POST["colstr"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_estadistica.get_dt_from($dt_id,'$dt_variables','$dt_cruce') AS query";

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$rquery_string = $data["query"];

$colstr_order = str_replace(","," ASC,",$colstr);
$colstr_order = substr($colstr_order,0,strlen($colstr)-1);

$new_query_string = "SELECT $colstr FROM ($rquery_string) AS sub ORDER BY " $colstr_order;

echo $new_query_string;

?>