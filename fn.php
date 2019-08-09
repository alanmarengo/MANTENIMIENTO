<?php

function startLink($hash) {
	echo "HASH " . $hash;
	if (strpos($hash,"index.php")) {
	
		return "#";
	
	}else{
	
		return "./index.php";
	
	}

}

?>