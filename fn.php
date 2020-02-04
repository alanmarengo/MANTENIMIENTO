<?php

function startLink($hash) {
	
	if (strpos($hash,"index.php")) {
	
		return "#";
	
	}else{
	
		return "./index.php";
	
	}

}

function testempty($var,$replace) {
	
	if (empty($var)) {
		
		return $replace;
		
	}else{
		
		return $var;
		
	}
	
}

?>