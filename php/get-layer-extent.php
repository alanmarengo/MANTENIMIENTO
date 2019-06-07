<?php

include("../pgconfig.php");

$layer_id = $_POST["layer_id"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT layer_schema,layer_table FROM mod_geovisores.vw_layers WHERE layer_id = " . $layer_id . " LIMIT 1";

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$query_string = "SELECT 
st_xmin(st_expand(st_extent(st_transform(T.geom, 3857)), 200::double precision)::box3d) AS minx,
st_ymin(st_expand(st_extent(st_transform(T.geom, 3857)), 200::double precision)::box3d) AS miny,
st_xmax(st_expand(st_extent(st_transform(T.geom, 3857)), 200::double precision)::box3d) AS maxx,
st_ymax(st_expand(st_extent(st_transform(T.geom, 3857)), 200::double precision)::box3d) AS maxy
FROM \"" . $data["layer_schema"] . "\".\"" . $data["layer_table"] . "\" T";

$extent = pg_fetch_assoc(pg_query($conn,$query_string));

$json = "";

$json .= "{";
$json .= "\"minx\":\"" . $extent["minx"] . "\",";
$json .= "\"miny\":\"" . $extent["miny"] . "\",";
$json .= "\"maxx\":\"" . $extent["maxx"] . "\",";
$json .= "\"maxy\":\"" . $extent["maxy"] . "\"";
$json .= "}";

echo $json;

?>