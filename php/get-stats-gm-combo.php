<?php

include("../pgconfig.php");

$dt_variables = $_POST["dt_variables"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_estadistica.get_dt_from($dt_id,'$dt_variables','$dt_cruce') AS query";

$query = pg_query($conn,$query_string);

$output = "<option value=\"-1\">Elija una Variable</option>";

while ($r = pg_fetch_assoc($query)) {
	
	$output .= "<option value=\"" . $r["dt_variable_id"] . "\">" . $r["dt_variable_nombre"] ."</option>";
	
}

echo $output;

?>