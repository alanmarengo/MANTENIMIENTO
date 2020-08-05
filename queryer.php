<?php

include("./pgconfig.php");

$proyectos = $_POST["proyectos"];
$geovisor = $_POST["geovisor"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query = $_GET["q"];

?>

<html>
	<head>	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="./css/pretty-checkbox.css"/>
	
	</head>
	<body>
	
		<?php
		
			var_dump($conn);
		
		?>
	
	</body>
</html>