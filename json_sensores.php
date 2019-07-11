<?php

header('Content-Type: application/json');

/*
 * {
 *  [
 *                  {
 *                      "filtro_nombre":'',
 *                      "filtro_id":0,
 *                      "valor_id":
 *                      "valor_desc":
 *                      "parent_filtro_id":
 *                      "parent_valor_id":
 *                  }
 *                  ,
 *                  {
 *                      "filtro_nombre":'',
 *                      "filtro_id":0,
 *                      "valor_id":
 *                      "valor_desc":
 *                      "parent_filtro_id":
 *                      "parent_valor_id":
 *                  }
 *                  ,
 *                  n..
 *   ]
 * }
 * */

$conn = pg_connect("host=localhost port=5432 dbname=ahrsc user=postgres password=plahe100%");

$SQL = "SELECT * FROM mod_sensores.vw_sensores_data_index ORDER BY estacion ASC";

$recordset = pg_query($conn,$SQL);

function draw_tupla($row)
{
       echo '{';
       echo '"estacion":"'.$row[0].'",';
       echo '"dato_nombre":"'.$row[1].'",';
       echo '"dato":"'.$row[2].'",';
       echo '"maximo":"'.$row[3].'",';
       echo '"minimo":"'.$row[4].'",';
       echo '"media":"'.$row[5].'",';
       echo '"ultima_act":"'.$row[5].'"';
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