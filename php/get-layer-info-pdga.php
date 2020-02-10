<?php

include("../pgconfig.php");
include("../tools.php");

$results = $_POST["results"];

$layer_names = array();
$layer_desc = array();
$estudios_id = array();
$gids = array();

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

for ($i=0; $i<sizeof($results); $i++) {
	
	$sep = explode(";",$results[$i]);
	
	$qs_name = "SELECT layer_desc,cod_oficial FROM mod_geovisores.vw_layers WHERE layer_wms_layer = '" . $sep[0] . "' LIMIT 1";
	$qs_query = pg_query($conn,$qs_name);
	$qs_name_data = pg_fetch_assoc($qs_query);
	$layer_d = $qs_name_data["layer_desc"];
	$cod_oficial = $qs_name_data["cod_oficial"];
	
	array_push($layer_desc,$layer_d);
	array_push($layer_names,$sep[0]);
	array_push($estudios_id,$cod_oficial);
	
	if (!$gids[$sep[0]]) {
		
		$gids[$sep[0]] = array();
		
	}
	
	array_push($gids[$sep[0]],$sep[1]);
	
}

$layer_names = array_unique($layer_names);

$layer_names = array_values($layer_names);

$html = "";

for ($i=0; $i<sizeof($layer_names); $i++) {
	
	$query_string = "SELECT DISTINCT layer_id FROM mod_geovisores.vw_layers WHERE layer_wms_layer = '" . $layer_names[$i] . "' LIMIT 1";
	
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