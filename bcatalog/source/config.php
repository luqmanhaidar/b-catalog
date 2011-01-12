<?php

defined("VIEW_PATH")  
    or define("VIEW_PATH", realpath(dirname(__FILE__) . '/../views'));
defined("MODEL_PATH")
    or define("MODEL_PATH", realpath(dirname(__FILE__) . '/../models'));
defined("LOG_PATH")
    or define("LOG_PATH", realpath(dirname(__FILE__) . '/../logs'));

defined("BASE_URL")  
    or define("BASE_URL", 'http://drive-test.dev:8888/');


$config = array(
    "db" => array(
        "hostname" => "localhost",
        "username" => "root",
        "password" => "root",
        "dbname"   => "drive_test"
    ),
    "errors" => array(
        "data" => array(
            "no-ness" => '{"success":"0", "error":"1", "notification":"в обработчик не были переданы все необходимые данные"}',
            "temp" => '{"success":"1", "notification":"временная заглушка"}'
        )
    )
);

?>