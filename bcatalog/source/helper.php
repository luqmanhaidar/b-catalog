<?php

require_once("config.php");

function renderView($viewFile, $variables = array(), $inc = false){
	
	$viewFileFullPath = VIEW_PATH . "/" . $viewFile;  

    // making sure passed in variables are in scope of the template  
    // each key in the $variables array will become a variable  
    if (count($variables) > 0) {  
	    foreach ($variables as $key => $value) {  
	        if (strlen($key) > 0) {  
	            ${$key} = $value;  
	        }  
    	}  
	}
	//echo $viewFileFullPath;
	if (file_exists($viewFileFullPath)) {  
	    $inc ? include($viewFileFullPath) : require_once($viewFileFullPath);  
	} else {  
	            /* 
	                If the file isn't found the error can be handled in lots of ways. 
	                In this case we will just include an error template. 
	            */  
		echo "<h1>rendering ERROR</h1>";
	    //require_once(TEMPLATES_PATH . "/error.php");  
	}
}
?>