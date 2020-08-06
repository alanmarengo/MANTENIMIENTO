<?php

include("./pgconfig.php");

$proyectos = $_POST["proyectos"];
$geovisor = $_POST["geovisor"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = $_GET["q"];

?>

<html>
	<head>	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="./css/pretty-checkbox.css"/>
	
	<style>
	
		body {
			
			width:10000px;
			
		}
		
		table {
			
			margin:20px;
			
		}
		
		th {
			
			background-color:#efefef;
			
		}
		
		td, th {
			
			padding:10px;
			border-top:1px solid #ccc;
			border-left:1px solid #ccc;
			width:150px;
			
		}
		
		tr td:last-child,th td:last-child {			
			
			border-right:1px solid #ccc;
			
		}
		
		tr:last-child td,tr:last-child th {			
			
			border-bottom:1px solid #ccc;
			
		}
	
	</style>
	
	</head>
	<body>
	
		<div style="padding:10px; border:1px solid #ccc; width:100%;">
			
			<textarea name="query" id="query"></textarea>
			<button onclick="readquery();">Procesar</button>			
		
			<div id="queryresult" style="margin-top:30px; border:1px dashed #ccc; padding:10px;"></div>
			
		</div>
	
	</body>
</html>