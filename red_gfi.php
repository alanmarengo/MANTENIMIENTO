<?php

	$url = $_RESQUEST['url'];

	$wms_request = $url;

	$con = curl_init($wms_request);
	
	curl_setopt($con,CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($con,CURLOPT_RETURNTRANSFER, true);
	
	$response = curl_exec($con);

	curl_close($con);
	
	echo $response;

?>
