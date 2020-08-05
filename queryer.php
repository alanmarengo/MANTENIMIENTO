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
	
		<?php
		
			$html = "<table>";
		
			$query = pg_query($conn,$query_string);
			
			$i = 0;
			
			while ($r=pg_fetch_assoc($query)) {
				
				$html .= "<tr>";
			
				foreach ($r as $item => $value){
					
					if ($i==0) {
						$html .= "<th>" . str_replace("_"," ",$item) . "</th>";
					}else{
						$html .= "<td>" . $value . "</td>";
					}
					
				}
					
				$html .= "</tr>";
				
				$i++;
			
			}
			
			$html .= "</table>";
			
			echo $html;
		
		?>
	
	</body>
</html>