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

    if(empty($valueToTest))
        return $config[$configTitle];
    else if($numeric && !is_numeric($valueToTest))
        return false;
    else
        return $valueToTest;
}

/*
 * тестит данные на соответствие формату:
 * <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
 * <div class="days">сб-вс. :</div><div class="hours">выходной</div>
 *
 * если НЕ совпадает считает обычной строкой и пытается распарсить РВ,
 * затем вернуть в приведенном формате
 *
 * @param {String} $strToProcess строка для проверки
 */
function processWorkHoursToHRD($strToProcess, $deptType = 1, $deptWorkDays = "123456"){

    $resultArr = array();
    $result = "";

    if(strstr($strToProcess, "<div"))
        return $strToProcess;
    
    if(preg_match_all("/( ?([а-я]{2}\.(,| )?)(.? ?([а-я]{2}\.(,| )?))?)(([a-zа-я:] ([0-9]+\.[0-9]{2}).{3,4}([0-9]+\.[0-9]{2})( без обеда)?)|(и праздничные дни.{3}выходной))/iu", $strToProcess, $resultArr)){
        for( $q= 0; $q < count($resultArr[1]); $q++){
            $result .= ("<div class='days'>".str_replace(" ", "", str_replace(",","-",$resultArr[1][$q])).":</div>");
            $result .= ("<div class='hours'>".str_replace("без обеда","", preg_replace("/^:|(и праздничные дни.{3})|(без обеда)| |c|с|/iu", "", str_replace("до","-",trim($resultArr[7][$q]))))."</div>");
        }
        if(preg_match_all("/(((обед( и технические перерывы)?)|(технические перерывы)):( ?([0-9]+\.[0-9]{2}).{3,4}([0-9]+\.[0-9]{2})(,|;)?)+)/iu", $strToProcess, $resultArr)){

            $resultArr = preg_split("/;|,/", preg_replace("/(обед)|(технические перерывы)| |и|:/iu", "", $resultArr[0][0]));

            $result .= "<div class='days'>обед и перерывы:</div><div class='hours'><ul>";
            for($q = 0; $q < count($resultArr); $q++)
                $result .= "<li>".$resultArr[$q]."</li>";
            $result .= "</ul></div>";
        }
    }
    else if(preg_match_all("/(([0-9]+\.[0-9]{2}).{3,4}([0-9]+\.[0-9]{2}))/iu", $strToProcess, $resultArr)){

        $result .= ("<div class='days'>пн.-вс.:</div>");
        $result .= ("<div class='hours'>".str_replace(" ", "", $resultArr[0][0])."</div>");

        if(preg_match_all("/(((обед( и технические перерывы)?)|(технические перерывы)):( ?([0-9]+\.[0-9]{2}).{3,4}([0-9]+\.[0-9]{2})(,|;)?)+)/iu", $strToProcess, $resultArr)){

            $resultArr = preg_split("/;|,/", preg_replace("/(обед)|(технические перерывы)| |и|:/iu", "", $resultArr[0][0]));

            $result .= "<div class='days'>обед и перерывы:</div><div class='hours'><ul>";
            for($q = 0; $q < count($resultArr); $q++)
                $result .= "<li>".$resultArr[$q]."</li>";
            $result .= "</ul></div>";
        }
    }
    else
        return "<div class='hours'>".$strToProcess."</div>";

    return $result;
}

?>