<!DOCTYPE HTML>
<html lang="ru-RU">
    <head>
        <meta charset="UTF-8">
        <title>BCATALOG</title>
	</head>
	<body>  
        <?php
            try{
                require_once(realpath(dirname(__FILE__))."/source/config.php");
                require_once(realpath(dirname(__FILE__))."/source/db_connect.class.php");
                require_once(realpath(dirname(__FILE__))."/source/helper.php");
                require_once(MODEL_PATH."/bank.model.php");
                require_once(MODEL_PATH."/region.model.php");
                require_once(MODEL_PATH."/department.model.php");

                $db = new DB_connect(null, $config);

                $bank_id    = 1;
                $city_id    = ifEmptyGetFromConfig($config, "capital_id", $city_id, true);
                $pageLength = ifEmptyGetFromConfig($config, "page_length", $pageLength);

                $currBank = new Bank($db->getDBH(), NULL, $bank_id);
                $currBank->getDataById();

                $data["bank"] = $currBank;
                $data["regions"] = Region::getAllRegions($db->getDBH());
                $data["departments"] = Department::getBankDepartments($db->getDBH(), 1, 1, 20, 2);

                // 8 (017) 237-97-97
                // 8 (0165) 32-44-16, 8 (0165) 32-24-31
                echo "<pre>";
                print_r(generatePagination($db->getDBH(), $bank_id, $city_id, 1, 20));
                //print_r(Department::getDeptAdress($db->getDBH(), 1, 1, ""));
                echo "</pre>";

            }
            catch(Exception $exp){
                // log exception info
                log_err($exp);

                //renderView("error.view.php", array("title"=>"Ошибка сервера", "msg"=>"Приносим свои извинения.<br/>Попробуйте перезагрузить страницу."));
            }
        ?>
    </body>
</html>
