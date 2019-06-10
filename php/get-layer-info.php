<?php

include("../pgconfig.php");

$gid = $_POST["gid"];
$layer_name = $_POST["layer_name"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT DISTINCT layer_schema,layer_table FROM mod_geovisores.vw_layers WHERE layer_wms_layer = '" . $layer_name . "' LIMIT 1";

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$schema = $data["layer_schema"];
$table= $data["layer_table"];

$query_string = "SELECT * FROM \"$schema\".\"$table\" WHERE gid = $gid";
echo $query_string;
$query = pg_query($conn,$query_string);

$html = "<table>";

while($r = pg_fetch_assoc($query)) {
	
	$html .= "<tr>";
	
	foreach ($r as $item => $value){
	
		$html .= "<td>" . $item . "</td>";
		$html .= "<td>" . $value . "</td>";
	
	}
	
	$html .= "</tr>";
	
}

$html .= "</table>";

echo $html;

?>