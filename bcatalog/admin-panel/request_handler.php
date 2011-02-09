<!DOCTYPE HTML>
<html lang="ru-RU">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
<?php


require_once(realpath(dirname(__FILE__))."/../source/config.php");
require_once(realpath(dirname(__FILE__))."/../source/db_connect.class.php");
require_once(realpath(dirname(__FILE__))."/../source/helper.php");
require_once(MODEL_PATH."/bank.model.php");
require_once(MODEL_PATH."/department.model.php");
require_once(MODEL_PATH."/city.model.php");
require_once(MODEL_PATH."/area.model.php");
require_once(MODEL_PATH."/region.model.php");

$obj     = empty($_GET["obj"]) ? null : $_GET["obj"];
$command = empty($_GET["cmd"]) ? null : $_GET["cmd"];
$db      = new DB_connect(NULL, $config);

switch ($obj) {
    case "region": {
        switch ($command) {
            case "edit": {
                if(empty($_GET["region_id"]) || !is_numeric($_GET["region_id"]) || empty($_GET["center_id"]) || !is_numeric($_GET["center_id"]) || empty($_GET["region_name"]))
                    die($config["errors"]["data"]["wrong-data"]);

                $_GET["region_name"] = addslashes(htmlspecialchars(($_GET["region_name"])));
                $region = new Region($db->getDBH(), NULL, $_GET["region_id"], $_GET["center_id"], $_GET["region_name"]);

                if($region->update())
                    die(json_encode(array("success" => "1")));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при внесении изменений в базу")));

                break;
            }
            case "add": {
                if(empty($_GET["region_name"]) || (!empty($_GET["center_id"]) && !is_numeric($_GET["center_id"])))
                    die($config["errors"]["data"]["wrong-data"]);

                if(empty($_GET["center_id"]))
                    $_GET["center_id"] = 0;

                $_GET["region_name"] = addslashes(htmlspecialchars(($_GET["region_name"])));
                $region = new Region($db->getDBH(), NULL, 0, $_GET["center_id"], $_GET["region_name"]);

                if($inserted_id = $region->add())
                    die(json_encode(array("success" => "1", "inserted_id" => $inserted_id)));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при добавлении в базу")));

                break;
            }
            case "remove": {
                if(empty($_GET["region_id"]) || !is_numeric($_GET["region_id"]))
                    die($config["errors"]["data"]["wrong-data"]);

                $region = new Region($db->getDBH(), NULL, $_GET["region_id"]);

                if($region->remove())
                    die(json_encode(array("success" => "1")));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при удалении записи из БД")));

                break;
            }
            default:
                die($config["errors"]["data"]["no-ness"]);
        }
    }
    case "area" : {
        switch ($command) {
            case "edit": {
                if(empty($_GET["area_id"]) || !is_numeric($_GET["area_id"]) || empty($_GET["region_id"]) || !is_numeric($_GET["region_id"]) || empty($_GET["area_name"]))
                    die($config["errors"]["data"]["wrong-data"]);

                $_GET["area_name"] = addslashes(htmlspecialchars(($_GET["area_name"])));
                $area = new Area($db->getDBH(), NULL, $_GET["area_id"], $_GET["region_id"], $_GET["area_name"]);

                if($area->update())
                    die(json_encode(array("success" => "1")));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при внесении изменений в базу")));

                break;
            }
            case "add": {

                if(empty($_GET["area_name"]) || (!empty($_GET["region_id"]) && !is_numeric($_GET["region_id"])))
                    die($config["errors"]["data"]["wrong-data"]);

                if(empty($_GET["region_id"]))
                    $_GET["region_id"] = 0;

                $_GET["area_name"] = addslashes(htmlspecialchars(($_GET["area_name"])));
                $area = new Area($db->getDBH(), NULL, 0, $_GET["region_id"], $_GET["area_name"]);

                if($inserted_id = $area->add())
                    die(json_encode(array("success" => "1", "inserted_id" => $inserted_id)));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при добавлении в базу")));

                break;
            }
            case "remove": {
                if(empty($_GET["area_id"]) || !is_numeric($_GET["area_id"]))
                    die($config["errors"]["data"]["wrong-data"]);

                $area = new Area($db->getDBH(), NULL, $_GET["area_id"]);

                if($area->remove())
                    die(json_encode(array("success" => "1")));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при удалении записи из БД")));

                break;
            }
            default:
                die($config["errors"]["data"]["no-ness"]);
        }
    }
    case "city": {
        switch ($command) {
            case "edit": {
                if(empty($_GET["city_id"]) || !is_numeric($_GET["city_id"]) || empty($_GET["area_id"]) || !is_numeric($_GET["area_id"]) || empty($_GET["city_name"]))
                    die($config["errors"]["data"]["wrong-data"]);

                $_GET["city_name"] = addslashes(htmlspecialchars(($_GET["city_name"])));
                $city = new City($db->getDBH(), NULL, $_GET["city_id"], $_GET["area_id"], $_GET["city_name"]);

                if($city->update())
                    die(json_encode(array("success" => "1")));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при внесении изменений в базу")));

                break;
            }
            case "add": {

                if(empty($_GET["city_name"]) || (!empty($_GET["area_id"]) && !is_numeric($_GET["area_id"])))
                    die($config["errors"]["data"]["wrong-data"]);

                if(empty($_GET["area_id"]))
                    $_GET["area_id"] = 0;

                $_GET["city_name"] = addslashes(htmlspecialchars(($_GET["city_name"])));
                $city = new City($db->getDBH(), NULL, 0, $_GET["area_id"], $_GET["city_name"]);

                if($inserted_id = $city->add())
                    die(json_encode(array("success" => "1", "inserted_id" => $inserted_id)));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при добавлении в базу")));

                break;
            }
            case "remove": {
                if(empty($_GET["city_id"]) || !is_numeric($_GET["city_id"]))
                    die($config["errors"]["data"]["wrong-data"]);

                $city = new City($db->getDBH(), NULL, $_GET["city_id"]);

                if($city->remove())
                    die(json_encode(array("success" => "1")));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при удалении записи из БД")));

                break;
            }
            default:
                die($config["errors"]["data"]["no-ness"]);
        }
    }
    case "bank": {
        die($config["errors"]["temp"]);
    }
    case "topic": {
        die($config["errors"]["temp"]);
    }
    default:
        die($config["errors"]["data"]["no-ness"]);
}

?>
</body>
</html>