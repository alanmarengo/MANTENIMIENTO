<?php

include("./pgconfig.php");

$ind_id = $_POST["ind_id"];
$pos = $_POST["pos"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT *,(select extent from mod_indicadores.ind_capa where ind_id=$ind_id and posicion=$pos limit 1)as ext FROM mod_indicadores.vw_recursos WHERE ind_id = $ind_id AND posicion = $pos";
//$query_string = "SELECT * FROM mod_indicadores.vw_recursos WHERE ind_id = 1 AND posicion = 1";

$query = pg_query($conn,$query_string);

$layer_id = array();
$layer_name = array();
$layer_server = array();
$layer_extent = '';/*Fix*/

$sliderItem = array();

$type = "noresource";

while($r = pg_fetch_assoc($query)) {
	
	$titulo_ind = $r["titulo"];
	$desc_ind = $r["desc"];
	
	switch($r["resource_type"]) {
		
		case "capa":
		$type = "capa";
		array_push($layer_id,$r["resource_id"]);
		array_push($layer_name,$r["layer_name"]);
		array_push($layer_server,$r["layer_server"]);
		$layer_extent = $r["ext"]; /*Fix*/
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
		$type = "grafico";
		
		$query_string = "SELECT * FROM mod_graficos.grafico WHERE grafico_id = " . $r["resource_id"];
		$query_grafico = pg_query($conn,$query_string);
		$data = pg_fetch_assoc($query_grafico);
		
		$g_tipo = $data["grafico_tipo"];
		$g_titulo = $data["grafico_titulo"];
		$g_desc = $data["grafico_desc"];
		$g_data_schema = $data["grafico_data_schema"];
		$g_data_tabla = $data["grafico_data_tabla"];
		
		$query_grafico_data_string = "SELECT * FROM \"" . $g_data_schema . "\".\"" . $g_data_tabla . "\"";
		$query_grafico_data = pg_query($conn,$query_grafico_data_string);
		
		$sector = "-1";
		$labels = array();
		$labelUnique = array();
		$sectorArr = array();
		$seriesArr = array();
		$typeArr = array();
		$unitArr = array();
		$curInd = -1;
		$unidad = "";
		
		while ($s = pg_fetch_assoc($query_grafico_data)) {
			
			$unidad = $s["unidad"];

			array_push($labelUnique,$s["etiqueta"]);
			
			if ($sector != $s["sector"]) {
				
				$curInd++;
				
				$labels[$curInd] = $s["etiqueta"];
				$sectorArr[$curInd] = $s["sector"];
				if (isset($s["unit"])) { $typeArr[$curInd] = $s["type"]; }
				if (isset($s["type"])) { $unitArr[$curInd] = $s["unit"]; }
				$seriesArr[$curInd] = array();
				
				$sector = $s["sector"];
				
			}
			
			array_push($seriesArr[$curInd],$s["valor"]);
			
		}
		
		$data_string = "";
		
		for ($i=0; $i<sizeof($sectorArr); $i++) {
			
			$data_string .= "{";
			$data_string .= "\"name\":\"" . $sectorArr[$i] . "\",";
			if (isset($typeArr[$i])) { $data_string .= "\"type\":\"" . $typeArr[$i] . "\","; }
			if (isset($unitArr[$i])) { $data_string .= "\"unit\":\"" . $unitArr[$i] . "\","; }
		
			if(sizeof($seriesArr[$i]) > 1) {
				
				$data_string .= "\"data\":[" . implode(",",$seriesArr[$i]) . "]";
				
			}else{
				
				$data_string .= "\"y\":" . implode(",",$seriesArr[$i]);
				
			}
			
			$data_string .= "},";
		
		}

		$labelUnique = array_unique($labelUnique);
		
		$data_string = substr($data_string,0,strlen($data_string)-1);		
		
		$data_out = "{";
		$data_out .= "\"type\":\"grafico\",";
		$data_out .= "\"ind_titulo\":\"" . $titulo_ind . "\",";
		$data_out .= "\"ind_desc\":\"" . $desc_ind . "\",";
		$data_out .= "\"grafico_id\":" . $data["grafico_id"] . ",";
		$data_out .= "\"grafico_tipo_id\":" . $data["grafico_tipo_id"] . ",";
		$data_out .= "\"titulo\":\"" . $g_titulo . "\",";
		$data_out .= "\"desc\":\"" . $g_desc . "\",";
		$data_out .= "\"unidad\":\"" . $unidad . "\",";
		$data_out .= "\"etiquetas\":[\"" . implode("\",\"",$labels) . "\"],";
		$data_out .= "\"etiquetasUnique\":[\"" . implode("\",\"",$labelUnique) . "\"],";
		$data_out .= "\"data\":[" . $data_string . "]";
		$data_out .= "}";
		
		break;
		
		case "recurso":	
		$type = "recurso";
		
		array_push($sliderItem,$r["slide_path"]);
		
		break;
		
	}
	
}

$out = "";

switch($type) {
	
	case "capa":
	$out .= "{";
	$out .= "\"type\":\"layer\",";
	$out .= "\"ind_titulo\":\"" . $titulo_ind . "\",";
	$out .= "\"ind_desc\":\"" . $desc_ind . "\",";
	$out .= "\"layers\":[\"".implode("\",\"",$layer_name)."\"],";
	$out .= "\"extent\":\"".$layer_extent."\","; /*FIX Borrar en caso de falla */
	$out .= "\"layers_server\":[\"".implode("\",\"",$layer_server)."\"]";
	$out .= "}";
	break;
	
	case "tabla":
	$out .= "{";
	$out .= "\"type\":\"table\",";
	$out .= "\"ind_titulo\":\"" . $titulo_ind . "\",";
	$out .= "\"ind_desc\":\"" . $desc_ind . "\",";
	$out .= "\"columns\":[\"". implode("\",\"",$columns)."\"],";
	$out .= "\"data\":[". $data . "]";
	$out .= "}";
	break;
	
	case "grafico":
	$out = $data_out;
	break;
	
	case "recurso":
	$out .= "{";
	$out .= "\"type\":\"slider\",";
	$out .= "\"ind_titulo\":\"" . $titulo_ind . "\",";
	$out .= "\"ind_desc\":\"" . $desc_ind . "\",";
	$out .= "\"images\":[\"".implode("\",\"",$sliderItem)."\"]";
	$out .= "}";
	break;
	
	case "noresource":
	$out .= "{";
	$out .= "\"type\":\"noresource\",";
	$out .= "\"noresource\":true";
	$out .= "}";
	break;
	
}

echo $out;


?>
