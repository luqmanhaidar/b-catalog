<?php
try{
    require_once(realpath(dirname(__FILE__))."/source/config.php");
    require_once(realpath(dirname(__FILE__))."/source/db_connect.class.php");
    require_once(realpath(dirname(__FILE__))."/source/helper.php");
    require_once(realpath(dirname(__FILE__))."/models/bank.model.php");
    require_once(realpath(dirname(__FILE__))."/models/department.model.php");

    $cmd = $_GET["cmd"];

    switch($cmd){

        case "get-city-banks" : {

            if(empty($_GET["city_id"]))
                die($config["errors"]["data"]["no-ness"]);

            $db = new DB_connect(null, $config);
            $bankIdArr = Bank::getCitySortBanks($db->getDBH(), addslashes($_GET["city_id"]));

            if($bankIdArr)
                die(json_encode(array("success"=>"1","data"=>$bankIdArr)));
            else
                die($config["errors"]["data"]["zombie-city"]);
        }

        case "get-depts-page" : {

            if(empty($_GET["city_id"]) || empty($_GET["bank_id"]) || empty($_GET["page_num"]) || empty($_GET["page_length"]))
                die($config["errors"]["data"]["no-ness"]);

            if(!is_numeric($_GET["city_id"]) || !is_numeric($_GET["bank_id"]) || !is_numeric($_GET["page_num"]) || !is_numeric($_GET["page_length"]) || !is_numeric($_GET["get_page_set"]))
                die($config["errors"]["data"]["wrong-data"]);

            $db = new DB_connect(null, $config);

            if(empty($_GET["adr_part"]))
                $depts = Department::getBankDepartments($db->getDBH(), $_GET["bank_id"], $_GET["city_id"], $_GET["page_length"], $_GET["page_num"]);
            else{
                $safe_adr_part = preg_replace ("/\.,'\"\(\)\{\}\+\*/ui", "%", $_GET["adr_part"]);
                $depts = Department::getBankDepartmentsByAdress($db->getDBH(), $_GET["bank_id"], $_GET["city_id"], $safe_adr_part, $_GET["page_length"], $_GET["page_num"]);
            }

            if($depts){
                for($q = 0; $q < count($depts); $q++){
                    $depts[$q]["Work_hour"] = processWorkHoursToHRD($depts[$q]["Work_hour"], $depts[$q]["Type"], $depts[$q]["Work_day"]);
                    $depts[$q]["Phone"] = processPhones($depts[$q]["Phone"]);
                }
                
                $pagesArr = array();
                if($_GET["get_page_set"] == 1)
                    $pagesArr = generatePagination($db->getDBH(), $_GET["bank_id"], $_GET["city_id"], $_GET["page_num"], $_GET["page_length"], $safe_adr_part);
                
                die(json_encode(array("success"=>"1", "pag_update" => "0", "depts"=>$depts, "pages"=> $pagesArr)));
            }
            else
                die(json_encode(array("success"=>"1", "pag_update" => "0", "depts"=>array(), "pages"=>array())));
                //die($config["errors"]["data"]["srv-error"]);
        }

        case "get-adresses" : {

            if(empty($_GET["city_id"]) || empty($_GET["bank_id"]))
                die($config["errors"]["data"]["no-ness"]);

            if(!is_numeric($_GET["city_id"]) || !is_numeric($_GET["bank_id"]))
                die($config["errors"]["data"]["wrong-data"]);

            if(!empty($_GET["adr_part"]))
                $_GET["adr_part"] = addslashes(htmlspecialchars($_GET["adr_part"]));

            $db = new DB_connect(null, $config);
            $adresses = Department::getDeptAdress($db->getDBH(), $_GET["bank_id"], $_GET["city_id"], $_GET["adr_part"]);

            die(json_encode(array("success" => "1", "adresses" => $adresses)));
        }

        default : {
            if(empty($cmd))
                die($config["errors"]["data"]["no-ness"]);

            die($config["errors"]["data"]["wrong-cmd"]);
        }
    }


}
catch(Exception $exp){
    //log exceotion info
    lor_err($exp);
    die($config["errors"]["data"]["srv-error"]);
}
?>
