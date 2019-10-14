<?php

include("../pgconfig.php");
include("../tools.php");

$results = $_POST["results"];

$layer_names = array();
$layer_desc = array();
$gids = array();

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

for ($i=0; $i<sizeof($results); $i++) {
	
	$sep = explode(";",$results[$i]);
	
	$qs_name = "SELECT layer_desc FROM mod_geovisores.vw_layers WHERE layer_wms_layer = '" . $sep[0] . "' LIMIT 1";
	$qs_query = pg_query($conn,$qs_name);
	$qs_name_data = pg_fetch_assoc($qs_query);
	$layer_d = $qs_name_data["layer_desc"];
	
	array_push($layer_desc,$layer_d);
	array_push($layer_names,$sep[0]);
	
	if (!$gids[$sep[0]]) {
		
		$gids[$sep[0]] = array();
		
	}
	
	array_push($gids[$sep[0]],$sep[1]);
	
}

$layer_names = array_unique($layer_names);

$layer_names = array_values($layer_names);

$html = "";

for ($i=0; $i<sizeof($layer_names); $i++) {
	
	$query_string = "SELECT DISTINCT layer_id,layer_schema,layer_table FROM mod_geovisores.vw_layers WHERE layer_wms_layer = '" . $layer_names[$i] . "' LIMIT 1";
	
	$query = pg_query($conn,$query_string);

	$data = pg_fetch_assoc($query);

	$layer_id = $data["layer_id"];
	$schema = $data["layer_schema"];
	$table= $data["layer_table"];
	
	$query_string2 = "SELECT * FROM \"$schema\".\"$table\" WHERE id IN (" . implode(",",$gids[$layer_names[$i]]) . ")";
	
	$query2 = pg_query($conn,$query_string2);
	
	$query_count = pg_num_rows($query2);
	
	$html .= "<div class\"popup-layer-node\">";
		$html .= "<a href=\"#\" class=\"layer-label\" onclick=\"$(this).parent().next().slideToggle('slow');\">" . $layer_desc[$i] . "</a>";
		$html .= "<div class=\"active-layer-node-icons\">";
			$html .= "<div class=\"layer-icon\">";
				$html .= "<a href=\"#\"><img src=\"./images/geovisor/icons/popup-layer-info-inactive.png\" data-inactive=\"./images/geovisor/icons/popup-layer-info-inactive.png\"
				data-active=\"./images/geovisor/icons/popup-layer-info-active.png\"></a>";
			$html .= "</div>";
			$html .= "<div class=\"layer-icon\">";
				$html .= "<a href=\"#\"><img src=\"./images/geovisor/icons/popup-layer-download-inactive.png\" data-inactive=\"./images/geovisor/icons/popup-layer-download-inactive.png\"
				data-active=\"./images/geovisor/icons/popup-layer-download-active.png\"></a></a>";
			$html .= "</div>";
			$html .= "<div class=\"layer-icon\">";
				$html .= "<a href=\"#\"><img src=\"./images/geovisor/icons/popup-layer-recurso-inactive.png\" data-inactive=\"./images/geovisor/icons/popup-layer-recurso-inactive.png\"
				data-active=\"./images/geovisor/icons/popup-layer-recurso-active.png\"></a></a>";></a>";
			$html .= "</div>";
			$html .= "<div class=\"layer-icon\">";
				$html .= "<a href=\"#\" onclick=\"geomap.map.togglePopupLayers(this)\"><img src=\"./images/geovisor/icons/popup-layer-opened\" data-inactive=\"./images/geovisor/icons/popup-layer-opened.png\"
				data-active=\"./images/geovisor/icons/popup-layer-closed.png\"></a></a>";></a>";></a>";
			$html .= "</div>";
		$html .= "</div>";
	$html .= "</div>";

	$html .= "<div style=\"display:none;\" class=\"popup-layer-content\">";	

	$html .= "<div style=\"text-align:center\" class=\"mt-20\">";

	$html .= "<p>";
	$html .= "<a ";
	$html .= "class=\"popup-header-button popup-header-button-toggleable popup-header-button-active-fixed\" style=\"display:inline-block; background:none!important;\"";
	$html .= "href=\"./csv.php?q=".encrypt(str_replace("geom,","",$query_string2))."\" target=\"_blank\"";
	$html .= ">";
	$html .= "<img src=\"./images/export.png\">";
	$html .= "</a>";
	$html .= "<a ";
	$html .= "class=\"popup-header-button popup-header-button-toggleable popup-header-button-active-fixed\"  style=\"display:inline-block; background:none!important;\"";
	$html .= "href=\"#\" ";
	$html .= ">";
	$html .= "<img src=\"./images/3d.png\">";
	$html .= "</a>";
	$html .= "<a ";
	$html .= "class=\"popup-header-button popup-header-button-toggleable popup-header-button-active-fixed\"  style=\"display:inline-block; background:none!important;\"";
	$html .= "href=\"./mediateca.php?mode=10&mode_id=".$layer_id."&mode_label=".$layer_desc[$i]."\" ";
	$html .= ">";
	$html .= "<img src=\"./images/file.png\">";
	$html .= "</a>";
	$html .= "</p>";
		
	$html .= "<br><hr><br>";

	$html .= "</div>";
	
	while($r = pg_fetch_assoc($query2)) {
		
		$html .= "<table class=\"popup-table gfi-info-table\" cellpadding=\"5\">";
		
		foreach ($r as $item => $value){
			
			if(( strpos( $item, "geom" ) === false) && (strpos( $item, "id" ) === false) && (strpos( $item, "cod_" ) === false)&& (strpos( $item, "origen" ) === false)) {
			
				$html .= "<tr>";
				$html .= "<td>" . str_replace("_"," ",$item) . "</td>";
				$html .= "<td>" . $value . "</td>";
				$html .= "</tr>";
			
			}
		
		}
	
		$html .= "</table>";
		$html .= "<br><hr><br>";
		
	}
	
	$html .= "</div>";

}

echo $html;

?>