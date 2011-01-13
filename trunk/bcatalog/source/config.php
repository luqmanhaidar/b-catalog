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
    or define("BASE_URL", 'http://bcatalog.dev:8888/');


$config = array(
    "project_title" => "SELECT.BY",
    "db" => array(
        "hostname" => "localhost",
        "username" => "root",
        "password" => "root",
        "dbname"   => "bank_catalog"
    ),
    "errors" => array(
        "data" => array(
            "no-ness" => '{"success":"0", "error":"1", "notification":"в обработчик не были переданы все необходимые данные"}',
            "temp" => '{"success":"1", "notification":"временная заглушка"}'
        )
    )
);

?>