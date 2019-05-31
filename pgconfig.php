<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$db_name = "ahrsc";

if((strpos($_SERVER["SCRIPT_FILENAME"],"wamp64")) || (strpos($_SERVER["SCRIPT_FILENAME"],"wamp")))//configuracion servidor juampi
{
	define("pg_server","127.0.0.1");
	define("pg_user","postgres");
	define("pg_password","postgres");
	define("pg_portv","5432");
	define("pg_db",$db_name);
	
}else{
	
	define("pg_server","127.0.0.1");
	define("pg_user","postgres");
	define("pg_password","plahe100%");
	define("pg_portv",5432);
	define("pg_db",$db_name);
	
}

?>