<?php

include("../pgconfig.php");
include("../tools.php");

$results = $_POST["results"];

$layer_id_arr = array();

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

for ($i=0; $i<sizeof($results); $i++) {
	
	$sep = explode(";",$results[$i]);
	
	$qs_name = "SELECT layer_id,layer_desc FROM mod_geovisores.vw_layers WHERE trim(layer_wms_layer) = '" . trim($sep[0]) . "' LIMIT 1";
	$qs_query = pg_query($conn,$qs_name);
	$qs_name_data = pg_fetch_assoc($qs_query);
	$layer_id = $qs_name_data["layer_id"];
	$layer_desc = $qs_name_data["layer_desc"];
	
	echo "<p>" . $qs_name . "</p>";
	echo "<p>" . $layer_id . " :: " . $sep[0] . "</p>";
	
	array_push($layer_id_arr,$layer_id);
	
}

$layer_id_arr = array_unique($layer_id_arr);
$layer_id_arr = array_values($layer_id_arr);

var_dump($layer_id_arr);

$html = "";

for ($i=0; $i<sizeof($layer_id); $i++) {
	
	$query_string = "SELECT DISTINCT layer_id FROM mod_geovisores.vw_layers WHERE layer_id = '" . $layer_id[$i] . "' LIMIT 1";
	
	$query = pg_query($conn,$query_string);

	$data = pg_fetch_assoc($query);

	$layer_id = $data["layer_id"];
	
	$query_string2 = "SELECT * FROM ambiente.gp_programas WHERE layer_id = " . $layer_id;
	echo $query_string2;
	$query2 = pg_query($conn,$query_string2);
	
	$query_count = pg_num_rows($query2);
	
	$metadata_url = $data["metadata_url"];
	$target = " target=\"_blank\"";
					
	if ($metadata_url == "") {
						
		$metadata_url = "javascript:alert('Esta capa no posee metadatos asociados');";
		$target = "";
						
	}
	
	$html .= "<div class=\"popup-layer-node jus-between\" data-state=\"0\">";
		$html .= "<div class=\"popup-layer-node-icons ml-15\">";
			$html .= "<div class=\"layer-icon\" title=\"Ver/Ocultar\">";
				$html .= "<a href=\"#\" onclick=\"geomap.map.togglePopupLayers(this)\"><img src=\"./images/geovisor/icons/popup-layer-closed.png\" data-inactive=\"./images/geovisor/icons/popup-layer-closed.png\"
				data-active=\"./images/geovisor/icons/popup-layer-opened.png\"></a>";
			$html .= "</div>";
		$html .= "</div>";
		$html .= "<a href=\"#\" class=\"layer-label\" style=\"cursor:text\" alt=\"" . $layer_desc[$i] . "\">" . $layer_desc[$i] . "</a>";
	$html .= "</div>";
	
	$html .= "<div style=\"display:none;\" class=\"popup-layer-content\">";	
		
		$html .= "<table class=\"popup-table gfi-info-table\" cellpadding=\"5\">";
				
			$html .= "<tr>";
			$html .= "<th>Programas Asociados</th>";
			$html .= "</tr>";
	
		while($r = pg_fetch_assoc($query2)) {
				
			$html .= "<tr>";
			$html .= "<td>" . $r["programa"] . "</td>";
			$html .= "</tr>";
			
		}
	
		$html .= "</table>";
	$html .= "</div>";

}

echo $html;

?>