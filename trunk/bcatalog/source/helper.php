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

function log_err($exp){
    $log = fopen(LOG_PATH."/err.log", "a");
    $report = "\n".
              "ERROR (".date("H:i:s | d M Y", time())."):\n".
              $exp->getMessage()."\n".
              "in: ".$exp->getFile()." at: ".$exp->getLine()."\n".
              "trace: \n".$exp->getTraceAsString()."\n".
              "-----\n\n";

    fwrite($log, $report);
    fclose($log);
}


/*
 * проверяет значение $valueToTest, если оно пустое
 * возвращает одноименное ему из массива $config
 * если $numeric истина, то еще и проверит на соответствие числу или числовой строки
 * @param {array} $config массив установок
 * @param {String} $configTitle название проверяемого элемента в массиве установок
 * @param {mixed} $valueToTest значение, которое необходимо проверить
 * @param {boolean} $numeric индикатор, показывающий является ли переданное значение числовым
 */
function ifEmptyGetFromConfig($config, $configTitle, $valueToTest, $numeric = false){
    
    if(!$configTitle)
        return false;

    if(empty($valueToTest)){
        if($numeric && !is_numeric($valueToTest))
            return false;
        else
            return $config[$configTitle];
        return $config[$configTitle];
    }
}

?>