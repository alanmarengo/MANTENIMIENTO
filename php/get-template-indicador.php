<?php

include("../pgconfig.php");

$ind_id = $_POST["ind_id"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT template_id FROM mod_indicadores.ind_panel WHERE panel_id = " . $ind_id;
echo $query_string . "<br>";

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$template_id = $data["template_id"];

$query_string = "SELECT * FROM mod_indicadores.template WHERE template_id = " . $template_id . "<br>";
echo $query_string;
$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

echo $data["template_path"];

?>