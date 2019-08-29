<?php

include("../pgconfig.php");

$ind_id = $_POST["ind_id"];
$pos = $_POST["pos"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_indicadores.vw_recursos WHERE ind_id = $ind_id AND posicion = $pos";

$query = pg_query($conn,$query_string);

$layer_id = array();
$layer_name = array();
$layer_server = array();

while($r = pg_fetch_assoc($query)) {
	
	switch($r["resource_type"]) {
		
		case "capa":
		$type = "capa";
		array_push($layer_id,$r["resource_id"]);
		array_push($layer_name,$r["layer_name"]);
		array_push($layer_server,$r["layer_server"]);
		break;
		
	}
	
}

?>

<!DOCTYPE html>
<html lang="es">
<head>

	<title>Geovisor</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
	
	<!-- CSS -->

	<link rel="stylesheet" href="./js/openlayers/ol.css"/>

	<!-- JS -->

	<script src="./js/openlayers/ol.js" type="text/javascript"></script>
	
	<script type="text/javascript">
	
		var map_layers = [];
	
		var map_layers[0] = new ol.layer.Tile({
			name: 'openstreets',
			title: 'OSM',
			type: 'base',
			visible: true,
			source: new ol.source.XYZ({
				url: '//{a-c}.tile.openstreetmaps.org/{z}/{x}/{y}.png',
				crossOrigin: 'anonymous'
			})
		});
		
		<?php
		
		for ($i=0; $i<sizeof($layer_id); $i++) {
			
		?>
		
		map_layers[<?php echo ($i+1); ?>] = new ol.layer.Tile({
				visible:true,
				source: new ol.source.TileWMS({
					url: '<?php echo $layer_server[$i]; ?>'
					params: {
						'LAYERS': '<?php echo $layer_name[$i]; ?>',
						'VERSION': '1.1.1',
						'FORMAT': 'image/png',
						'TILED': false
					}
				})
			});
		
		<?php
			
		}
		
		?>
		
		var indMap = new ol.Map({
			layers:map_layers,
			target: 'resource-loader',
			extent: [-13281237.21183002,-7669922.0600572005,-738226.6183457375,-1828910.1066171727],
			controls: [],
			view: new ol.View({
				center: [-7176058.888636417,-4680928.505993671],
				zoom:3.8,
				minZoom: 3.8,
				maxZoom: 21
			})
		});
	
	</script>
	
</head>
<body>

	<div id="resource-loader" style="width:100%; max-height:400px;">
	
	</div>

</body>
</html>