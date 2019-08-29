<!DOCTYPE html>
<html lang="es">
<head>

	<title>Geovisor</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<?php include("./scripts.default.php"); ?>
	<?php include("./scripts.openlayers.php"); ?>
	
	<script type="text/javascript">
	
		$(document).ready(function() {
			
			var osm = new ol.layer.Tile({
				name: 'openstreets',
				title: 'OSM',
				type: 'base',
				visible: false,
				source: new ol.source.XYZ({
					url: '//{a-c}.tile.openstreetmaps.org/{z}/{x}/{y}.png',
					crossOrigin: 'anonymous'
				})
			})
			
			var map = new ol.Map({
				layers:[osm],
				target: 'map',
				extent: [-13281237.21183002,-7669922.0600572005,-738226.6183457375,-1828910.1066171727],
				controls: [],
				view: new ol.View({
					center: [-7176058.888636417,-4680928.505993671],
					zoom:3.8,
					minZoom: 3.8,
					maxZoom: 21
				})
			});
			
		});
	
	</script>
	
</head>

<body style="overflow:hidden;">
		
	<div id="map" style="width:100%; height:100%;"></div>

</body>

</html>