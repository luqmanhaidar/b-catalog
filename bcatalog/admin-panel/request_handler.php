<?php

// http://bcatalog.dev:8888/admin-panel/request_handler.php?obj=bank&cmd=add&name_short=short&name_full=full&name_eng=eng&www=http://google.com&http=http://ikea.ru&logo_min=logo_min&logo=logo&our_http=http://our.com&adress=adress&licence=licence&owners=owners&note=note&city_id=1&services_tab=1

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

//echo "<pre>";
//print_r($_GET);
//echo "</pre>";

switch ($obj) {
// ----- REGION ----------------------------------------------------------------
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
// ----- AREA ------------------------------------------------------------------
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

// ----- CITY ------------------------------------------------------------------
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
// ----- BANK ------------------------------------------------------------------
    case "bank": {
        switch ($command) {
            case "edit": {
                if(empty($_GET["bank_id"]) ||
                   empty($_GET["name_short"]) ||
                   empty($_GET["name_full"]) ||
                   empty($_GET["name_eng"]) ||
                   empty($_GET["www"]) ||
                   empty($_GET["http"]) ||
                   empty($_GET["logo_min"]) ||
                   empty($_GET["logo"]) ||
                   empty($_GET["our_http"]) ||
                   empty($_GET["adress"]) ||
                   empty($_GET["licence"]) ||
                   empty($_GET["owners"]) ||
                   empty($_GET["note"]) ||
                   empty($_GET["city_id"]))
                    die($config["errors"]["data"]["no-ness"]);

                if(!empty($_GET["services_tab"]))
                    $_GET["services_tab"] = 1;
                if(!empty($_GET["deposits_tab"]))
                    $_GET["deposits_tab"] = 1;
                if(!empty($_GET["credits_tab"]))
                    $_GET["credits_tab"] = 1;

                $bank = new Bank($db->getDBH(), NULL, $_GET["bank_id"], $_GET["name_short"], $_GET["name_full"], $_GET["name_eng"], $_GET["www"], $_GET["http"], $_GET["logo_min"], $_GET["logo"], $_GET["our_http"], $_GET["adress"], $_GET["licence"], $_GET["owners"], $_GET["note"], $_GET["city_id"], $_GET["services_tab"], $_GET["deposits_tab"], $_GET["credits_tab"]);

                if($bank->update())
                    die(json_encode(array("success" => "1")));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при внесении изменений в базу")));

                break;
            }
            case "add": {

                if(empty($_GET["name_short"]) ||
                   empty($_GET["name_full"]) ||
                   empty($_GET["name_eng"]) ||
                   empty($_GET["www"]) ||
                   empty($_GET["http"]) ||
                   empty($_GET["logo_min"]) ||
                   empty($_GET["logo"]) ||
                   empty($_GET["our_http"]) ||
                   empty($_GET["adress"]) ||
                   empty($_GET["licence"]) ||
                   empty($_GET["owners"]) ||
                   empty($_GET["note"]) ||
                   empty($_GET["city_id"]))
                    die($config["errors"]["data"]["no-ness"]);

                $bank = new Bank($db->getDBH(), NULL, 0, $_GET["name_short"], $_GET["name_full"], $_GET["name_eng"], $_GET["www"], $_GET["http"], $_GET["logo_min"], $_GET["logo"], $_GET["our_http"], $_GET["adress"], $_GET["licence"], $_GET["owners"], $_GET["note"], $_GET["city_id"], $_GET["services_tab"], $_GET["deposits_tab"], $_GET["credits_tab"]);

                if($inserted_id = $bank->add())
                    die(json_encode(array("success" => "1", "inserted_id" => $inserted_id)));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при добавлении в базу")));

                break;
            }
            case "remove": {
                if(empty($_GET["bank_id"]))
                    die($config["errors"]["data"]["no-ness"]);
                else if(!is_numeric($_GET["bank_id"]))
                    die($config["errors"]["data"]["wrong-data"]);

                $bank = new Bank($db->getDBH(), NULL, $_GET["bank_id"]);

                if($bank->remove())
                    die(json_encode(array("success" => "1")));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при удалении записи из БД")));

                break;
            }
            default:
                die($config["errors"]["data"]["no-ness"]);
        }
    }
    default:
        die($config["errors"]["data"]["no-ness"]);
}

?>