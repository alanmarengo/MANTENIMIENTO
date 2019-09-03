<?php

include("./pgconfig.php");

$ind_id = $_POST["ind_id"];
$pos = $_POST["pos"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_indicadores.vw_recursos WHERE ind_id = $ind_id AND posicion = $pos";
//$query_string = "SELECT * FROM mod_indicadores.vw_recursos WHERE ind_id = 1 AND posicion = 1";

$query = pg_query($conn,$query_string);

$layer_id = array();
$layer_name = array();
$layer_server = array();

$type = "noresource";

while($r = pg_fetch_assoc($query)) {
	
	switch($r["resource_type"]) {
		
		case "capa":
		$type = "capa";
		array_push($layer_id,$r["resource_id"]);
		array_push($layer_name,$r["layer_name"]);
		array_push($layer_server,$r["layer_server"]);
		break;
		
		case "tabla":
		$type = "tabla";
		
		$query_string = "SELECT * FROM " . $r["tabla_fuente"];
		$query_tabla = pg_query($conn,$query_string);
		$firstCur = true;
		$columns = array();
		$data = "";
		
		while($s = pg_fetch_assoc($query_tabla)) {

			if ($firstCur) {

				foreach($s as $colname => $val) {

					if (strpos($colname,"geom") === false) {

						array_push($columns,$colname);

					}

				}

			}
			
			$data .= "[";
			
			foreach($s as $colname => $val) {
				
				if (strpos($colname,"geom") === false) {
				
					$data .= "\"" . $s[$colname] . "\",";
				
				}
				
			}
			
			$data = substr($data,0,strlen($data)-1);
			$data .= "],";
			
			$firstCur = false;
			
		}
		
		$data = substr($data,0,strlen($data)-1);		
		
		break;
		
		case "grafico":	
		
		$query_string = "SELECT * FROM mod_graficos.grafico WHERE grafico_id = " . $r["grafico_id"];
		$query_grafico = pg_query($conn,$query_string);
		$data = pg_fetch_assoc($query_grafico);
		
		$g_tipo = $data["grafico_tipo"];
		$g_titulo = $data["grafico_titulo"];
		$g_desc = $data["grafico_desc"];
		$g_data_schema = $data["data_schema"];
		$g_data_tabla = $data["data_tabla"];
		
		$query_grafico_data_string = "SELECT * FROM \"" . $g_data_schema . "\".\"" . $g_data_tabla . "\"";
		$query_grafico_data = pg_query($conn,$query_grafico_data_string);
		
		$sector = "";
		$valor = "";
		
		$data_string = "";
		
		while ($r = pg_fetch_assoc($query_grafico_data)) {
			
			$data_string .= "{";
			$data_string .= "\"name\":\"" . $r["sector"] . "\",";
			$data_string .= "\"value\":" . $r["valor"];			
			$data_string .= "},";
			
		}
		
		$data_string = substr($data_string,0,strlen($data_string)-1);
		
		$data_out = "{";
		$data_out .= "\"titulo\":\"" . $g_titulo . "\",";
		$data_out .= "\"desc\":\"" . $g_desc . "\",";
		$data_out .= "\"data\":[" . $data_string . "]";
		
		echo $data_out;
		
		break;
		
	}
	
}

$out = "";

switch($type) {
	
	case "capa":
	$out .= "{";
	$out .= "\"type\":\"layer\",";
	$out .= "\"layers\":[\"".implode("\",\"",$layer_name)."\"],";
	$out .= "\"layers_server\":[\"".implode("\",\"",$layer_server)."\"]";
	$out .= "}";
	break;
	
	case "tabla":
	$out .= "{";
	$out .= "\"type\":\"table\",";
	$out .= "\"columns\":[\"". implode("\",\"",$columns)."\"],";
	$out .= "\"data\":[". $data . "]";
	$out .= "}";
	break;
	
	case "grafico":
	$out .= "{";
	$out .= "\"type\":\"grafico\",";
	$out .= "\"series\":[\"". implode("\",\"",$columns)."\"],";
	$out .= "\"data\":[". $data . "]";
	$out .= "}";
	break;
	
	case "noresource":
	$out .= "{";
	$out .= "\"noresource\":true";
	$out .= "}";
	break;
	
}

echo $out;


?>