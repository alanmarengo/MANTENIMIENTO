<?php

include("../pgconfig.php");
include("../tools.php");

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");

//$ind_id = $_POST["ind_id"];
//$pos = $_POST["pos"];

$ind_id = 1;
$pos = 4;

$query_string = "SELECT tabla_fuente FROM mod_indicadores.vw_recursos WHERE ind_id = $ind_id AND posicion = $pos LIMIT 1";

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$new_query_string = "SELECT * FROM " . $data["tabla_fuente"];
echo $new_query_string;
$query = pg_query($conn,$new_query_string);

$csv = parseSQLToCSV($query);

echo $csv;

pg_close($conn);

?>
