<?php

include("../pgconfig.php");
include("../tools.php");

$results = $_POST["results"];

$layer_names = array();
$gids = array();

for ($i=0; $i<sizeof($results); $i++) {
	
	$sep = explode(";",$results[$i]);
	
	array_push($layer_names,$sep[0]);
	
	if (!$gids[$sep[0]]) {
		
		$gids[$sep[0]] = array();
		
	}
	
	array_push($gids[$sep[0]],$sep[1]);
	
}

$layer_names = array_unique($layer_names);

$layer_names = array_values($layer_names);

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$html = "";

for ($i=0; $i<sizeof($layer_names); $i++) {
	
	$query_string = "SELECT DISTINCT layer_schema,layer_table FROM mod_geovisores.vw_layers WHERE layer_wms_layer = '" . $layer_names[$i] . "' LIMIT 1";

	$query = pg_query($conn,$query_string);

	$data = pg_fetch_assoc($query);

	$schema = $data["layer_schema"];
	$table= $data["layer_table"];
	
	$query_string2 = "SELECT * FROM \"$schema\".\"$table\" WHERE gid IN (" . implode(",",$gids[$layer_names[$i]]) . ")";
	
	$query2 = pg_query($conn,$query_string2);
		
	$html .= "<h3 style=\"font-size:18px; margin-bottom:20px;\">CAPA: " . $layer_names[$i] . "</h3>";

	while($r = pg_fetch_assoc($query2)) {
		
		$html .= "<table class=\"popup-table gfi-info-table\" cellpadding=\"5\">";
		
		foreach ($r as $item => $value){
			
			if(( strpos( $item, "geom" ) === false) && (strpos( $item, "id" ) === false)) {
			
				$html .= "<tr>";
				$html .= "<td>" . $item . "</td>";
				$html .= "<td>" . $value . "</td>";	
				$html .= "</tr>";
			
			}
		
		}
	
		$html .= "</table>";
		$html .= "<br><hr><br>";
		
	}

	$html .= "<div style=\"text-align:center\" class=\"mt-20\">";

	$html .= "<p>";
	$html .= "<a ";
	$html .= "class=\"popup-header-button popup-header-button-toggleable popup-header-button-active-fixed\" onclick=\"geomap.map.exportCSV();\"";
	$html .= "href=\"#\" data-q=\"".encrypt($query_string2)."\"";
	$html .= ">";
	$html .= "<span>EXPORTAR TABLA</span>";
	$html .= "</a>";
	$html .= "</p>";

	$html .= "<p>";
	$html .= "<a ";
	$html .= "class=\"popup-header-button popup-header-button-toggleable popup-header-button-active-fixed\" ";
	$html .= "href=\"#\" ";
	$html .= ">";
	$html .= "<span>VER MODELO 3D</span>";
	$html .= "</a>";
	$html .= "</p>";

	$html .= "<p>";
	$html .= "<a ";
	$html .= "class=\"popup-header-button popup-header-button-toggleable popup-header-button-active-fixed\" ";
	$html .= "href=\"#\" ";
	$html .= ">";
	$html .= "<span>VER RECURSOS ASOCIADOS</span>";
	$html .= "</a>";
	$html .= "</p>";
		
	$html .= "<br><hr><br>";

	$html .= "</div>";

}

echo $html;

?>