<?php

define("tools_wms_server",'https://observatorio.ieasa.com.ar/geoserver/ows?');

function wms_get_layer_extent($str_layer_name)
{
	$wms_request = tools_wms_server."REQUEST=GetCapabilities&SERVICE=WMS";

	$con = curl_init($wms_request);
	
	curl_setopt($con,CURLOPT_SSL_VERIFYPEER, false);
	echo "PRE CURL EXEC";

	$response = curl_exec($con);

	//echo curl_error($con);

	curl_close($con);

	//echo $responde;


	$capacidades = new SimpleXMLElement($response);

	//echo $capacidades->Layer[0]->Name;

	return 0;
};


wms_get_layer_extent('');

?>
