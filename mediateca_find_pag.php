<?php

header('Content-Type: application/json');

include("./pgconfig.php");

/*
 * s=condor&o=0&ds=19%2F06%2F2019&de=18%2F06%2F2019&proyecto=1&documento=1%2C3&tema=5&subtema=37
 */
 
 /*
  * 0 A-Z
  * 1 Z-A
  * 2 Más visto
  * 3 Menos Visto
  * 4 Recientes
  * 5 Antiguos
  */

$qt         =  $_REQUEST['s'];
$desde      =  $_REQUEST['ds'];
$hasta      =  $_REQUEST['de'];
$proyecto   =  $_REQUEST['proyecto'];
$clase      =  $_REQUEST['tema'];
$subclase   =  $_REQUEST['subtema'];
$tipo_doc   =  $_REQUEST['documento'];
$orden      =  $_REQUEST['o'];
$estudio_id =  $_REQUEST['estudio_id'];
$ra 	    =  $_REQUEST['ra'];
$solapa	    =  $_REQUEST['solapa'];
$mode	    =  $_REQUEST['mode'];

/************************* ORDER BY **********************************/

switch ($_REQUEST['o'])
		{
			case 0: 	$ORDER = " ORDER BY tipo_formato_solapa,recurso_titulo ASC"; break;
			case 1: 	$ORDER = " ORDER BY tipo_formato_solapa,recurso_titulo DESC"; break;
			case 2: 	$ORDER = " ORDER BY tipo_formato_solapa, mod_mediateca.get_total_vistas_recurso(origen_id_especifico,origen_id) DESC"; break;
			case 3: 	$ORDER = " ORDER BY tipo_formato_solapa, mod_mediateca.get_total_vistas_recurso(origen_id_especifico,origen_id) ASC"; break;
			case 4: 	$ORDER = " ORDER BY tipo_formato_solapa,recurso_fecha DESC"; break;
			case 5: 	$ORDER = " ORDER BY tipo_formato_solapa,recurso_fecha ASC"; break;
			default: 	$ORDER = " ORDER BY tipo_formato_solapa,recurso_titulo ASC"; break;
		};



/********************Parametros paginador ***************************/

$pagina	= $_REQUEST['pagina'];	//Por defecto Página 1
$salto 	= $_REQUEST['salto'];	//Por defecto 5	

function IsSetVar($var)
{
	if((isset($var))&&(!empty($var)))
	{
		return TRUE;
	}else return FALSE;
};

if (!IsSetVar($pagina))
{
	$pagina = 0;
};

if(!IsSetVar($salto))
{
	$salto = 20;
};

if(!IsSetVar($solapa))
{
	$solapa = 0;
};

if(!IsSetVar($mode))
{
	$mode = -1;
};

$SUBQUERY = "";

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

function getSQL($solapa) {
	global $mode;
	global $estudio_id;
	global $qt;
	global $desde;
	global $hasta;
	global $proyecto;
	global $clase;
	global $subclase;
	global $tipo_doc;
	global $ra;
	global $ORDER;
	global $SUBQUERY;

	$SQL = "";

	if($mode==-1)
	{
		if (!IsSetVar($estudio_id))
		{
			
		$SUBQUERY  = "SELECT "
					. "tipo_formato_solapa AS \"Solapa\","
					. "origen_id,"
					. "origen_id_especifico AS \"Id\","
					. "recurso_titulo AS \"Titulo\","
					. "recurso_desc AS \"Descripcion\","
					. "recurso_path_url AS \"LinkImagen\","
					. "recurso_categoria_desc AS \"MetaTag\","
					. "CASE WHEN recurso_autores IS NULL THEN responsable::TEXT ELSE recurso_autores::TEXT END AS \"Autores\","
					. "mod_catalogo.get_estudio(origen_id,origen_id_especifico) AS estudios_id,"
					. "recurso_fecha AS Fecha,"
					. "COALESCE(subclase_desc,'') AS Tema,"
					. "mod_catalogo.get_ico(origen_id,origen_id_especifico) AS ico"
					. " FROM mod_mediateca.mediateca_find('$qt','$desde','$hasta','$proyecto','$clase','$subclase','$tipo_doc') "
					. " WHERE tipo_formato_solapa=$solapa " 
					//. " GROUP BY mod_catalogo.get_ico(origen_id,origen_id_especifico),recurso_fecha,COALESCE(subclase_desc,''),tipo_formato_solapa,origen_id,origen_id_especifico,recurso_titulo,recurso_desc,recurso_path_url,recurso_categoria_desc,CASE WHEN recurso_autores IS NULL THEN responsable::TEXT ELSE recurso_autores::TEXT END"
					. $ORDER;
	
		$SQL = "SELECT row_to_json(T)::text AS r FROM ($SUBQUERY)T";
		
		}
		else
		{
			   if ((IsSetVar($ra))&&($ra==1)) //if ((!IsSetVar($ra))&&($ra==1))
			   {
				$SUBQUERY  = "SELECT "
							. "tipo_formato_solapa AS \"Solapa\","
							. "origen_id,"
							. "origen_id_especifico AS \"Id\","
							. "recurso_titulo AS \"Titulo\","
							. "recurso_desc AS \"Descripcion\","
							. "recurso_path_url AS \"LinkImagen\","
							. "recurso_categoria_desc AS \"MetaTag\","
							. "CASE WHEN recurso_autores IS NULL THEN responsable::TEXT ELSE recurso_autores::TEXT END AS \"Autores\","
							. "estudios_id,"
							. "recurso_fecha AS Fecha,"
							. "COALESCE(subclase_desc,'') AS Tema, "
							. "mod_catalogo.get_ico(origen_id,origen_id_especifico) AS ico"
							. " FROM mod_catalogo.vw_catalogo_data C WHERE "
							. " C.estudios_id IN(SELECT sub_estudio_id FROM mod_catalogo.estudio_subestudio WHERE estudios_id=$estudio_id) "
							. " AND C.estudios_id=$estudio_id  AND  tipo_formato_solapa=$solapa " /* Tambíen incluye el mismo estudio */ 
							. $ORDER;
				
				$SQL = "SELECT row_to_json(T)::text AS r FROM ($SUBQUERY)T";
			   }
			   else
			   {
				$SUBQUERY  = "SELECT "
							. "tipo_formato_solapa AS \"Solapa\","
							. "origen_id,"
							. "origen_id_especifico AS \"Id\","
							. "recurso_titulo AS \"Titulo\","
							. "recurso_desc AS \"Descripcion\","
							. "recurso_path_url AS \"LinkImagen\","
							. "recurso_categoria_desc AS \"MetaTag\","
							. "CASE WHEN recurso_autores IS NULL THEN responsable::TEXT ELSE recurso_autores::TEXT END AS \"Autores\","
							. "estudios_id,"
							. "recurso_fecha AS Fecha,"
							. "COALESCE(subclase_desc,'') AS Tema, "
							. "mod_catalogo.get_ico(origen_id,origen_id_especifico) AS ico"
							. " FROM mod_catalogo.vw_catalogo_data C WHERE estudios_id=$estudio_id AND tipo_formato_solapa=$solapa "
							. $ORDER;
				
			   $SQL = "SELECT row_to_json(T)::text AS r FROM ($SUBQUERY)T";
			   };
		};
	}
	else
	{
		switch ($mode)
		{
			case 0: 	$SQL = ""; die("Modo desconocido."); break;
			case 1: 	$SQL = ""; die("Modo desconocido."); break;
			case 2: 	$SQL = ""; die("Modo desconocido."); break;
			default: 	$SQL = ""; die("Modo desconocido."); break;
		};
	};

	return $SQL;
}


/*
 * Data para paginador
 */

 function getTotalRegistros($_solapa) 
 {
	global $conn;

	$subquery = getSQL($_solapa); 

	$data_query	= "SELECT COUNT(*) registros FROM ($subquery) A;";
	$recordset	= pg_query($conn,$data_query);
	$row		= pg_fetch_row($recordset);
	
	return $row[0];  		
 };
 
 function getEstudioNombre($_estudio_id) 
 {
	global $conn;
	$estudio_nombre = '';

	if(IsSetVar($_estudio_id))
	{
		$data_query	= "SELECT nombre FROM mod_catalogo.estudios E WHERE E.estudios_id=$_estudio_id limit 1;";
		$recordset	= pg_query($conn,$data_query);
		$row		= pg_fetch_row($recordset);
		
		$estudio_nombre = $row[0];
	}
	else
	{
		$estudio_nombre = '';
	};
	
	return $estudio_nombre;  		
 };

$data_query	= "SELECT COUNT(*) registros FROM (".getSQL($solapa).") A;";

//echo $data_query;

$recordset	= pg_query($conn,$data_query);

$row		= pg_fetch_row($recordset);

$registros	= $row[0];

$total_paginas	= ceil(($registros-1)/($salto-1));

$offset_pag 	= (($salto-1)*$pagina);

$paginador_text = " LIMIT $salto OFFSET $offset_pag";

//$SQL = $SQL." WHERE T.\"Solapa\"=$solapa";
//$SQL = $SQL.$paginador_text;

$total_0 = getTotalRegistros(0);
$total_1 = getTotalRegistros(1);
$total_2 = getTotalRegistros(2);
$total_3 = getTotalRegistros(3);
$estudio_nombre = getEstudioNombre($estudio_id);

echo "{"; // JSON - Inicio
echo "	\"paginas\":$total_paginas,";
echo "	\"solapa\": $solapa,";
echo "	\"pagina\": $pagina,";
echo "	\"estudio_nombre\": \"$estudio_nombre\",";
echo "	\"registros_total_0\": $total_0,";
echo "	\"registros_total_1\": $total_1,";
echo "	\"registros_total_2\": $total_2,";
echo "	\"registros_total_3\": $total_3,";
echo "	\"rec_per_page\": $salto,";
echo "	\"recordset\":";

$recordset = pg_query($conn,getSQL($solapa).$paginador_text);

$fflag = false;
$sflag = null; /* Solapa */

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
  
  echo $row[0];
  
  $row = pg_fetch_row($recordset);//NEXT
};

echo "],";

/******************************************* FILTROS RECALCULADOS ********************************************/

$SUBQUERY = str_replace("''", "null", $SUBQUERY);

//$SQL = "SELECT * FROM mod_mediateca.get_filtros_totales('$SUBQUERY') ORDER BY filtro_id,valor_desc ASC";

$SUBQUERY  = pg_escape_string($SUBQUERY);

$SQL = 	"SELECT F.*,COALESCE(T.total,0) AS total "
		." FROM "
		." mod_catalogo.vw_filtros_values F "
		."LEFT JOIN "
		."("
		."SELECT * FROM mod_mediateca.get_filtros_total_consulta_filtro('$SUBQUERY',0) WHERE valor_id IS NOT NULL UNION ALL "
		."SELECT * FROM mod_mediateca.get_filtros_total_consulta_filtro('$SUBQUERY',1) WHERE valor_id IS NOT NULL UNION ALL "
		."SELECT * FROM mod_mediateca.get_filtros_total_consulta_filtro('$SUBQUERY',2) WHERE valor_id IS NOT NULL UNION ALL "
		."SELECT * FROM mod_mediateca.get_filtros_total_consulta_filtro('$SUBQUERY',3) WHERE valor_id IS NOT NULL UNION ALL "
		."SELECT * FROM mod_mediateca.get_filtros_total_consulta_filtro('$SUBQUERY',5) WHERE valor_id IS NOT NULL UNION ALL "
		."SELECT * FROM mod_mediateca.get_filtros_total_consulta_filtro('$SUBQUERY',4) WHERE valor_id IS NOT NULL"
		.")T "
		."ON F.filtro_id=T.filtro_id AND F.valor_id = T.valor_id";
	
  

//echo $SQL;

$recordset = pg_query($conn,$SQL);

//$recordset = pg_query_params($conn,"SELECT * FROM mod_mediateca.get_filtros_totales($1) ORDER BY filtro_id,valor_desc ASC",Array($SUBQUERY));
//echo pg_last_error($conn);

function draw_tupla($row)
{
       echo '{';
       echo '"filtro_nombre":"'.$row[0].'",';
       echo '"filtro_id":"'.$row[1].'",';
       echo '"valor_id":"'.$row[2].'",';
       echo '"valor_desc":"'.$row[3].'",';
       echo '"parent_filtro_id":"'.$row[4].'",';
       echo '"total":"'.$row[6].'",';
       echo '"parent_valor_id":"'.$row[5].'"';
       echo '}';
       
       return true;
};

$fflag = false;

echo "\"filtros\":[";

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
/******************************************* FIN FILTROS RECALCULADOS ********************************************/

echo "}";// Fin JSON

pg_close($conn);


?>
