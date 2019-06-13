<?php

//header("Content-Type: text/csv");
//header("Content-Disposition: attachment; filename=file.csv");

function parseSQLToCSV($recordset)
			{
			
 			$TotalColum = pg_num_fields($recordset);
                        
                        $fflag_delimitador = false;
 
                        $omitir_index = array();
			$omitir_column = array("the_geom","geom","filtro_id");
			
  			for ($index = 0; $index < $TotalColum; $index++) 
  			{
				if($fflag_delimitador) {$json.= ";";};
                                
				$fieldname = pg_field_name($recordset, $index);
                                
                                if (!in_array($fieldname, $omitir_column))
                                {
                                    $json.= "\"".$fieldname."\"";
                                    $fflag_delimitador = true;
                                }
                                else 
                                {
                                    array_push ($omitir_index,$index);
                                    $fflag_delimitador = false;
                                };
  			};
  			
  			$json.= "\n\r";
    
  			$flagFirstSeparator = true;
                         
  			while ($row = pg_fetch_row($recordset)) 
  			{
  	
				if($flagFirstSeparator)
   				{
   	 			 $flagFirstSeparator = false;
   				}else $json.= "\n\r";
                                
                                $fflag_delimitador  = false;
   
  				for ($index = 0; $index < $TotalColum; $index++) 
  				{
                                        if($fflag_delimitador) {$json.= ";";}; 
                                        
                                        if(!in_array($index, $omitir_index))
                                        {
                                            $json.= "\"".$row[$index]."\"";
                                            $fflag_delimitador = true;
                                        }else $fflag_delimitador = false;                                  
                                        
  	 			}
  	      
  			};
  			
			return $json;
				
			};
			
/*			
$conn = pg_connect("host=localhost port=5432 dbname=ahrsc user=postgres password=plahe100%");

$SQL = "SELECT * FROM obra.area_obra_uso";

$recordset = pg_query($conn,$SQL);

echo parseSQLToCSV($recordset);

pg_close($conn);
 
 */


function encrypt($string) {
	
	$new_string = "";
	
	for ($i=0; $i<strlen($string); $i++) {
		
		$new_string .= ord(substr($string,$i,1)) . ";";
		
	}
	
	return $new_string;
	
}

function decrypt($string) {
	
	$new_string = "";
	$arr = explode(";",$string);
	
	for ($i=0; $i<sizeof($arr); $i++) {
		
		$new_string .= chr($arr[$i]) . "";
		
	}
	
	return $new_string;
	
}

?>
