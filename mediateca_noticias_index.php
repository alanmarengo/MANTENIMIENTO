<?php

header('Content-Type: application/json');

include("./pgconfig.php");

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;

$conn = pg_connect($string_conn);

$SQL = "SELECT ('./cache/'||recurso_id::TEXT||'.jpg')::text AS path_img, recurso_titulo as titulo,recurso_fecha as fecha,recurso_path_url as path_pdf,recurso_desc as desc,recurso_id from  mod_mediateca.recurso r where formato_id in(102) order by recurso_fecha desc limit 11";

$recordset = pg_query($conn,$SQL);

function draw_tupla($row)
{
       echo '{';
       echo '"path_img":"'.$row[0].'",';
       echo '"titulo":"'.$row[1].'",';
       echo '"fecha":"'.$row[2].'",';
       echo '"path_pdf":"'.$row[3].'",';
       echo '"desc":"'.$row[4].'"';
       echo '}';
       
       return true;
};

$fflag = false;

echo "[";

$row = pg_fetch_row($recordset);

while($row) 
{
  if ($fflag)
  {
      echo ',';
  }
  else
  {
      $fflag = true;
  };
  
  draw_tupla($row);
  
  $row = pg_fetch_row($recordset);//NEXT
};

echo "]";
pg_close($conn);

?>

