<?php

function startLink($hash) {

	if (strpos($hash,"index.php")) {
	
		return "#";
	
	}else{
	
		return "./index.php";
	
	}

}

?>