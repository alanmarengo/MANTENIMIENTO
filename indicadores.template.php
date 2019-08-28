<?php

include("../pgconfig.php");

$ind_id = $_POST["ind_id"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT template_id FROM mod_indicadores.ind_panel WHERE ind_id = " . $ind_id;

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$template_id = $data["template_id"];

$query_string = "SELECT * FROM mod_indicadores.template WHERE template_id = " . $template_id;

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$file = file_get_contents($data["template_path"]);

if ($file !== false && !empty($file)) {

	echo $file . "<br> ARCHIVO CARGADO <br>";

}else{
	
	echo "CADENA VACIA " . $data["template_path"];
	
}

?>