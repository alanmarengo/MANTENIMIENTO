<?php

define("tools_wms_server",'https://observatorio.ieasa.com.ar/geoserver/ows?');

function wms_get_layer_extent($str_layer_name)
{
	$wms_request = tools_wms_server."REQUEST=GetCapabilities&SERVICE=WMS";

	$con = curl_init($wms_request);
	
	curl_setopt($con,CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($con,CURLOPT_RETURNTRANSFER, true);
	
	$response = curl_exec($con);

	//echo curl_error($con);

	curl_close($con);

	//echo $responde;

	$capacidades = simplexml_load_string($response);

	echo $capacidades->Capability->Layer->Layer[0]->Name;
	echo $capacidades->Capability->Layer->Layer[0]->BoundingBox[0]["CRS"]."<br>";
	var_dump( $capacidades->Capability->Layer->Layer[0]->BoundingBox);

	return 0;
};


wms_get_layer_extent('');

?>
