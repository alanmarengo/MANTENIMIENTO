<?php

function startLink($hash) {
	
	if (strpos($hash,"index.php")) {
	
		return "#";
	
	}else{
	
		return "./index.php";
	
	}

}

/*function tempty($v,$rep) {
	
	if (empty(trim($v))) {
	
		return $rep;
	
	}else{
	
		return $v;
	
	}

}*/



function ComboSubclase($clase_id) {		

	$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
	$conn = pg_connect($string_conn);
	
	$query_string = "SELECT * FROM mod_geovisores.vw_filtros_avanzados_subclase WHERE clase_id = $clase_id ORDER BY subclase_desc ASC";
	
	$query = pg_query($conn,$query_string);
	
	$html = "<option value=\"-1\" selected>Subclase</option>";
	
	while ($r = pg_fetch_assoc($query)) {
		
		$html .= "<option value=\"" . $r["subclase_id"] . "\">" . $r["subclase_desc"] . "</option>";
		
	}
	
	return $html;
	
}

?>