<?php

try{
    require_once(realpath(dirname(__FILE__))."/source/config.php");
    require_once(realpath(dirname(__FILE__))."/source/db_connect.class.php");
    require_once(realpath(dirname(__FILE__))."/source/helper.php");
    require_once(MODEL_PATH."/bank.model.php");
    require_once(MODEL_PATH."/region.model.php");
    require_once(MODEL_PATH."/department.model.php");
    
    $db = new DB_connect(null, $config);

    $bank_id = $_GET["bank_id"];
    $city_id = ifEmptyGetFromConfig($config, "capital_id", $_GET["city_id"], true);
    $page_length = ifEmptyGetFromConfig($config, "page_length", $_GET["page_length"], true);    
    setcookie("page_length", $page_length, time(3600*24*90));
    $page_num = (empty($_GET["page_num"]) || !is_numeric($_GET["page_num"]) ) ? 1 : $_GET["page_num"];

    if(empty($bank_id) || !is_numeric($bank_id)){
        //Header("HTTP/1.1 301 Moved Permanently");
        //Header("Location: ".BASE_URL);
        echo "empty";
        die();
    }

    $currBank = new Bank($db->getDBH(), NULL, $bank_id);
    $currCity = new City($db->getDBH(), NULL, $city_id);

    if(!$currBank->getDataById()){
        renderView("error.view.php", array("title"=>"Ошибка сервера", "msg"=>"Приносим свои извинения.<br/>В обработчик был передан наверный идентификатор банка.<br/>Выберите банк на <a href='".BASE_URL."'>главной странице</a>."));
        die();
    }

    $data["page_qnt"]    = ceil(Department::countPageNum($db->getDBH(), $bank_id, $city_id)/$page_length);
    $data["page_num"]    = $page_num;
    $data["page_length"] = $page_length;
    $data["bank"]        = $currBank;
    $data["title"]       = str_replace("<b>", "", str_replace("</b>", "", $currBank->Name_short));
    $data["regions"]     = Region::getAllRegions($db->getDBH());
    $data["departments"] = Department::getBankDepartments($db->getDBH(), $currBank->Kod_B, $city_id, $page_length, $page_num);
    $data["city_id"]     = $city_id;
    $data["city_name"]   = $currCity->getNameById();

    renderView("bank.view.php", $data);
}
catch(Exception $exp){
    log_err($exp);
    //renderView("error.view.php", array("title"=>"Ошибка сервера", "msg"=>"Приносим свои извинения.<br/>Попробуйте перезагрузить страницу."));
}
?>