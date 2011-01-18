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

            if(empty($_GET["city"]))
                die($config["errors"]["data"]["no-ness"]);

            $db = new DB_connect(null, $config);
            $bankIdArr = Bank::getCitySortBanks($db->getDBH(), addslashes($_GET["city"]));

            die(json_encode(array("success"=>"1","data"=>$bankIdArr)));
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
    $log = fopen(LOG_PATH."/err.log", "a");
    $report = "-----\n".
              "ERROR:\n".
              $exp->getMessage()."\n".
              "in: ".$exp->getFile()." at: ".$exp->getLine()."\n".
              "trace: ".$exp->getTraceAsString()."\n".
              "-----\n\n";

    fwrite($log, $report);
    fclose($log);

    renderView("error.view.php", array("title"=>"Ошибка сервера", "msg"=>"Приносим свои извинения.<br/>Попробуйте перезагрузить страницу."));
}
?>
