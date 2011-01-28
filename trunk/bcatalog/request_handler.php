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

    //renderView("error.view.php", array("title"=>"Ошибка сервера", "msg"=>"Приносим свои извинения.<br/>Попробуйте перезагрузить страницу."));
}
?>
