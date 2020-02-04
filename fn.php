<?php

function startLink($hash) {
	
	if (strpos($hash,"index.php")) {
	
		return "#";
	
	}else{
	
		return "./index.php";
	
	}

}

/*function tempty($v,$rep) {
	
	if (empty(trim($v))) {
	
		return $rep;
	
	}else{
	
		return $v;
	
	}

}*/

?>