<?php

defined("VIEW_PATH")  
    or define("VIEW_PATH", realpath(dirname(__FILE__) . '/../views'));
defined("MODEL_PATH")
    or define("MODEL_PATH", realpath(dirname(__FILE__) . '/../models'));
defined("LOG_PATH")
    or define("LOG_PATH", realpath(dirname(__FILE__) . '/../logs'));
defined("IMG_PATH")
    or define("IMG_PATH", realpath(dirname(__FILE__) . '/../img'));

defined("BASE_URL")  
    or define("BASE_URL", 'http://bcatalog.dev:8888/');//'http://bcatalog.dev:8888/' | 'http://ctrigger.ru/bcatalog/'


$config = array(
    "project_title" => "BCATALOG",
    "capital_id" => 1,
    "db" => array(
        "hostname" => "localhost",
        "username" => "root",
        "password" => "root",
        "dbname"   => "bank_catalog"
    ),
//    "db" => array(
//        "hostname" => "localhost",
//        "username" => "ctrigge8_hQjY",
//        "password" => "kRIo",
//        "dbname"   => "ctrigge8_bankcatalog"
//    ),
    "errors" => array(
        "data" => array(
            "no-ness" => '{"success":"0", "error":"1", "notification":"в обработчик не были переданы все необходимые данные"}',
            "wrong-cmd" => '{"success":"0", "error":"1", "notification":"в обработчик была передана неверная команда"}',
            "zombie-city" => '{"success":"0", "error":"1", "notification":"в этом городе нет известных нам отделений"}',
            "wrong-data" => '{"success":"0", "error":"1", "notification":"в обработчик были переданы неверные данные"}',
            "temp" => '{"success":"1", "notification":"временная заглушка"}'
        )
    ),
    "page_length" => 20
);

?>