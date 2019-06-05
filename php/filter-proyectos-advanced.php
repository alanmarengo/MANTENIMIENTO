<?php

include("../pgconfig.php");

$param = array();

$param["busqueda"] = "";
$param["fdesde"] = "";
$param["fhasta"] = "";
$param["proyecto_id"] = -1;
$param["clase_id"] = -1;
$param["subclase_id"] = -1;
$param["responsable"] = "";
$param["esia_id"] = -1;
$param["objeto_id"] = -1;

if (isset($_POST["adv-search-busqueda"])) { $param["busqueda"] = $_POST["adv-search-busqueda"]; }
if (isset($_POST["adv-search-fdesde"])) { $param["fdesde"] = $_POST["adv-search-fdesde"]; }
if (isset($_POST["adv-search-fhasta"])) { $param["fhasta"] = $_POST["adv-search-fhasta"]; }
if (isset($_POST["adv-search-proyecto-combo"])) { $param["proyecto_id"] = $_POST["adv-search-proyecto-combo"]; }
if (isset($_POST["adv-search-clase-combo"])) { $param["clase_id"] = $_POST["adv-search-clase-combo"]; }
if (isset($_POST["adv-search-subclase-combo"])) { $param["subclase_id"] = $_POST["adv-search-subclase-combo"]; }
if (isset($_POST["adv-search-responsable-combo"])) { $param["responsable"] = $_POST["adv-search-responsable-combo"]; }
if (isset($_POST["adv-search-esia-combo"])) { $param["esia_id"] = $_POST["adv-search-esia-combo"]; }
if (isset($_POST["adv-search-objeto-combo"])) { $param["objeto_id"] = $_POST["adv-search-objeto-combo"]; }

//var_dump($_POST);
//var_dump($param);

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);
	
	$query_string = "SELECT * FROM mod_geovisores.layers_find(";
	$query_string .= "'".$param["busqueda"]."',";
	$query_string .= "'".$param["fdesde"]."',";
	$query_string .= "'".$param["fhasta"]."',";
	$query_string .= "'".$param["proyecto_id"]."',";
	$query_string .= "".$param["clase_id"].",";
	$query_string .= "".$param["subclase_id"].",";
	$query_string .= "-1,";
	$query_string .= "'".$param["responsable"]."',";
	$query_string .= "".$param["esia_id"].",";
	$query_string .= "".$param["objeto_id"]."";
	$query_string .= ");";
	
	echo $query_string;
	
	//$query = pg_query($conn,$query_string);
	
	//while($r = pg_fetch_assoc($query)) {
	

?>