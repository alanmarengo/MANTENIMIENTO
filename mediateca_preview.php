<?php
header("Content-Type: image/jpg");

include("./pgconfig.php");

$recurso_id = $_REQUEST['r'];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$SQL = "SELECT recurso_path_url,upper(right(recurso_path_url,3))AS extension,recurso_preview_path FROM mod_mediateca.recurso R WHERE recurso_id=$recurso_id limit 1;";

$recordset = pg_query($conn,$SQL);

$row = pg_fetch_row($recordset);

$recursor_path = $row[0];
$recursos_extension = $row[1];
$recurso_preview = $row[2];

if ($recurso_preview==NULL)
{
	$recurso_preview='./images/3.jpg';
};

pg_close($conn);

if($recursos_extension=='PDF')
{
	$imagick = new Imagick();
	$imagick->readImage($recursor_path.'[0]');//primer hoja
	$imagick->setImageFormat("jpg");
	$imagick = $imagick->flattenImages();

	echo $imagick->getImagesBlob();
}
else
{
	$imagick = new Imagick();
	$imagick->readImage($recurso_preview);
	$imagick->setImageFormat("jpg");

	echo $imagick->getImagesBlob();
};

?> 
