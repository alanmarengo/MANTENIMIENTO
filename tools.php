<?php

//header("Content-Type: text/csv");
//header("Content-Disposition: attachment; filename=file.csv");

function parseSQLToCSV($recordset)
			{
			
 			$TotalColum = pg_num_fields($recordset);
 
  			//$json.= '"columnas":[';
  
  			for ($index = 0; $index < $TotalColum; $index++) 
  			{
				if($index<>0) {$json.= ";";}; 
				$fieldname = pg_field_name($recordset, $index);
				$json.= "\"".$fieldname."\"";
  			};
  			
  			$json.= "\n\r";
    
  			$flagFirstSeparator = true;
  
  			while ($row = pg_fetch_row($recordset)) 
  			{
  	
				if($flagFirstSeparator)
   				{
   	 			 //$json.= "[";
   	 			 $flagFirstSeparator = false;
   				}else $json.= "\n\r";
   
  				for ($index = 0; $index < $TotalColum; $index++) 
  				{
  		
  					if($index<>0) {$json.= ";";}; 
  					
  		 				$json.= "\"".$row[$index]."\"";
  	 			}
  	      
  			};
  			
   		
 
			
			//echo indent($json);
			
			return $json;
				
			};
			
/*			
$conn = pg_connect("host=localhost port=5432 dbname=ahrsc user=postgres password=plahe100%");

$SQL = "SELECT * FROM mod_catalogo.vw_filtros_values ORDER BY filtro_id ASC";

$recordset = pg_query($conn,$SQL);

echo parseSQLToCSV($recordset);

pg_close($conn);
*/

function encrypt($string) {
	
	$encrypted = explode($string);
	
	for ($i=0; $i<sizeof($start); $i++) {
		
		$encrypted[$i] = chr($start[$i]);
		
	}
	
	$encrypted = implode(" ",$start);
	
	return $encrypted;
	
}

?>
