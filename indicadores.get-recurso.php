<?php

include("../pgconfig.php");

$ind_id = $_POST["ind_id"];
$pos = $_POST["pos"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_indicadores.vw_recursos WHERE ind_id = $ind_id AND posicion = $pos";

$query = pg_query($conn,$query_string);

$layer_id = array();

while($r = pg_fetch_assoc($query)) {
	
	switch($r["resource_type"]) {
		
		case "capa":
		$type = "capa";
		array_push($layer_id,$r["resource_id"]);
		break;
		
	}
	
}

?>

<!DOCTYPE html>
<html lang="es">
<head>

	<title>Geovisor</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">		
		
	<?php include("./scripts.default.php"); ?>	
	<?php include("./scripts.openlayers.php"); ?>	
	<?php include("./scripts.highcharts.php"); ?>	
	<?php include("./scripts.map.php"); ?>	

	<script type="text/javascript">
	
		$(document).ready(function() {
	
		<?php
		
		if ($type == "capa") {
			
		?>
		
		alert('<?php echo implode(",",$layer_id); ?>');
		
		<?php
			
		}
		
		?>
		
		});
	
	</script>
	
	</head>
	<body style="overflow:hidden;">
		<?php echo implode(",",$layer_id); ?>
	</body>
</html>