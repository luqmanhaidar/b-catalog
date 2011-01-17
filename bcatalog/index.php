<?php
try{
    require_once(realpath(dirname(__FILE__))."/source/config.php");
    require_once(realpath(dirname(__FILE__))."/source/db_connect.class.php");
    require_once(realpath(dirname(__FILE__))."/source/helper.php");
    require_once(realpath(dirname(__FILE__))."/models/bank.model.php");

    $db = new DB_connect(null, $config);

    $data["title"] = "Каталог банков";
    $data["banks"] = Bank::getBanksShortInfo($db->getDBH());

    renderView("main.view.php", $data);
}
catch(Exception $exp){
    //$exp->logErrorReport();
    renderView("error.view.php", array("title"=>"Ошибка сервера", "msg"=>"Приносим свои извинения.<br/>Попробуйте перезагрузить страницу."));
}
?>