<?php

include("../pgconfig.php");

$dt_id = $_POST["dt_id"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_estadistica.get_dt_variales(".$dt_id.")";

$query = pg_query($conn,$query_string);

echo "PHP: " . $query_string;

?>