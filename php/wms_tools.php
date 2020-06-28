<?php

define("tools_wms_server",'https://observatorio.ieasa.com.ar/geoserver/ows?');

function wms_get_layer_extent($str_layer_name)
{
	$index_layers = 0;/* Indice de capa, hay que buscar la capa $str_layer_name */
	$index_boundind = 0; /* Indice de extent, solo aceptamos 4326 */

	$wms_request = tools_wms_server."REQUEST=GetCapabilities&SERVICE=WMS";

	$con = curl_init($wms_request);
	
	curl_setopt($con,CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($con,CURLOPT_RETURNTRANSFER, true);
	
	$response = curl_exec($con);

	curl_close($con);

	$capacidades = simplexml_load_string($response);

	$json_buffer_extent = '';

	for($index_layers=0;$index_layers<sizeof($capacidades->Capability->Layer);$index_layers++)
	{
		if($capacidades->Capability->Layer->Layer[$index_layers]->Name==$str_layer_name)
		{
			for($index_boundind=0;$index_boundind<sizeof($capacidades->Capability->Layer->Layer[$index_layers]->BoundingBox);$index_boundind++)
			{
				if($capacidades->Capability->Layer->Layer[$index_layers]->BoundingBox[$index_boundind]["CRS"]=='EPSG:4326')
				{
					$json_buffer_extent .= "{";
					$json_buffer_extent .= "\"minx\":\"".$capacidades->Capability->Layer->Layer[$index_layers]->BoundingBox[$index_boundind]["minx"]."\",";
					$json_buffer_extent .= "\"miny\":\"".$capacidades->Capability->Layer->Layer[$index_layers]->BoundingBox[$index_boundind]["miny"]."\",";
					$json_buffer_extent .= "\"maxx\":\"".$capacidades->Capability->Layer->Layer[$index_layers]->BoundingBox[$index_boundind]["maxx"]."\",";
					$json_buffer_extent .= "\"maxy\":\"".$capacidades->Capability->Layer->Layer[$index_layers]->BoundingBox[$index_boundind]["maxy"]."\"";
					$json_buffer_extent .= "}";
				};	
			};	
		};	
	};

	return $json_buffer_extent;
};


//wms_get_layer_extent('ahrsc:vp_geo_fipai_areasevaluarentornoinme_otr1'); //Demo

?>
