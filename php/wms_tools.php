<?php

define("tools_wms_server",'https://observatorio.ieasa.com.ar/geoserver/ows?');

function wms_get_layer_extent($str_layer_name)
{
	$wms_request = tools_wms_server."REQUEST=GetCapabilities&SERVICE=WMS";

	$con = curl_init($wms_request);
	
	$response = curl_exec($con);

	curl_close($con);

	echo $responde;

	return 0;
};


wms_get_layer_extent('');

?>
