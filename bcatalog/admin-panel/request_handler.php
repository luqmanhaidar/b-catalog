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

$obj     = empty($_REQUEST["obj"]) ? null : $_REQUEST["obj"];
$command = empty($_REQUEST["cmd"]) ? null : $_REQUEST["cmd"];
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

                if(empty($_REQUEST["bank_id"]) ||
                   empty($_REQUEST["name_short"]) ||
                   empty($_REQUEST["name_full"]) ||
                   empty($_REQUEST["name_eng"]) ||
                   empty($_REQUEST["www"]) ||
                   empty($_REQUEST["http"]) ||
                   empty($_REQUEST["logo_min"]) ||
                   empty($_REQUEST["logo"]) ||
                   empty($_REQUEST["our_http"]) ||
                   empty($_REQUEST["adress"]) ||
                   empty($_REQUEST["licence"]) ||
                   empty($_REQUEST["owners"]) ||
                   empty($_REQUEST["note"]) ||
                   empty($_REQUEST["city_id"]))
                    die($config["errors"]["data"]["no-ness"]);

                if(!empty($_REQUEST["services_tab"]))
                    $_REQUEST["services_tab"] = 1;
                if(!empty($_REQUEST["deposits_tab"]))
                    $_REQUEST["deposits_tab"] = 1;
                if(!empty($_REQUEST["credits_tab"]))
                    $_REQUEST["credits_tab"] = 1;

                $bank = new Bank($db->getDBH(), NULL, $_REQUEST["bank_id"], $_REQUEST["name_short"], $_REQUEST["name_full"], $_REQUEST["name_eng"], $_REQUEST["www"], $_REQUEST["http"], $_REQUEST["logo_min"], $_REQUEST["logo"], $_REQUEST["our_http"], $_REQUEST["adress"], $_REQUEST["licence"], $_REQUEST["owners"], $_REQUEST["note"], $_REQUEST["city_id"], $_REQUEST["services_tab"], $_REQUEST["deposits_tab"], $_REQUEST["credits_tab"]);

                if($bank->update())
                    die(json_encode(array("success" => "1")));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при внесении изменений в базу")));

                break;
            }
            case "add": {

                if(empty($_REQUEST["name_short"]) ||
                   empty($_REQUEST["name_full"]) ||
                   empty($_REQUEST["name_eng"]) ||
                   empty($_REQUEST["www"]) ||
                   empty($_REQUEST["http"]) ||
                   empty($_REQUEST["logo_min"]) ||
                   empty($_REQUEST["logo"]) ||
                   empty($_REQUEST["our_http"]) ||
                   empty($_REQUEST["adress"]) ||
                   empty($_REQUEST["licence"]) ||
                   empty($_REQUEST["owners"]) ||
                   empty($_REQUEST["note"]) ||
                   empty($_REQUEST["city_id"]))
                    die($config["errors"]["data"]["no-ness"]);

                $bank = new Bank($db->getDBH(), NULL, 0, $_REQUEST["name_short"], $_REQUEST["name_full"], $_REQUEST["name_eng"], $_REQUEST["www"], $_REQUEST["http"], $_REQUEST["logo_min"], $_REQUEST["logo"], $_REQUEST["our_http"], $_REQUEST["adress"], $_REQUEST["licence"], $_REQUEST["owners"], $_REQUEST["note"], $_REQUEST["city_id"], $_REQUEST["services_tab"], $_REQUEST["deposits_tab"], $_REQUEST["credits_tab"]);

                if($inserted_id = $bank->add())
                    die(json_encode(array("success" => "1", "inserted_id" => $inserted_id)));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при добавлении в базу")));

                break;
            }
            case "remove": {
                if(empty($_REQUEST["bank_id"]))
                    die($config["errors"]["data"]["no-ness"]);
                else if(!is_numeric($_REQUEST["bank_id"]))
                    die($config["errors"]["data"]["wrong-data"]);

                $bank = new Bank($db->getDBH(), NULL, $_REQUEST["bank_id"]);

                if($bank->remove())
                    die(json_encode(array("success" => "1")));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при удалении записи из БД")));

                break;
            }
            case "get-full-data": {
                if(empty($_REQUEST["bank_id"]))
                    die($config["errors"]["data"]["no-ness"]);
                else if(!is_numeric($_REQUEST["bank_id"]))
                    die($config["errors"]["data"]["wrong-data"]);

                $bank = new Bank($db->getDBH(), NULL, $_REQUEST["bank_id"]);

                if($bank->getDataById())
                    die(json_encode(array("success" => "1", "bank" => $bank)));
                else
                    die(json_encode (array("success" => "0", "error" => "1", "notification" => "ошибка при получении данных из БД")));

                break;
            }
            default:
                die($config["errors"]["data"]["wrong-cmd"]);
        }
    }
    default:
        die($config["errors"]["data"]["wrong-cmd"]);
}

?>