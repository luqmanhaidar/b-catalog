<?php
try{
    require_once(realpath(dirname(__FILE__))."/../source/config.php");
    require_once(realpath(dirname(__FILE__))."/../source/db_connect.class.php");
    require_once(realpath(dirname(__FILE__))."/../source/helper.php");
    require_once(MODEL_PATH."/bank.model.php");
    require_once(MODEL_PATH."/region.model.php");
    require_once(MODEL_PATH."/area.model.php");
    require_once(MODEL_PATH."/city.model.php");
    $db = new DB_connect(null, $config);

    $data["title"] = "Каталог банков";
    $data["banks"] = Bank::getBanksShortInfo($db->getDBH());
    $data["regions"] = Region::getAllRegions($db->getDBH());
    $data["admin"] = true;

    renderView("admin.main.view.php", $data);
}
catch(Exception $exp){
    // log exception info
    log_err($exp);
    //renderView("error.view.php", array("title"=>"Ошибка сервера", "msg"=>"Приносим свои извинения.<br/>Попробуйте перезагрузить страницу."));
}
?>