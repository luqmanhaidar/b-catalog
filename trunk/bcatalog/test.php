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
                $data["departments"] = Department::getBankDepartments($db->getDBH(), 1, 1, 20, 9);


//                $strToTest = "пн. - пт. с 10.00 до 19.00, сб. с 9.00 до 17.00, вс. и праздничные дни – выходной";
//                preg_match_all("/( ?([а-я]{2}\.(,| )?)(-? ?([а-я]{2}\.(,| )?))?)((с ([0-9]+\.[0-9]{2}) до ([0-9]+\.[0-9]{2})( без обеда)?)|(и праздничные дни.{3}выходной))/iu", $strToTest, $result);
//                echo "<pre>";
//                print_r($result);
//                echo "</pre>";
                    foreach ($data["departments"] as $dept) {//print_r($dept);
                        echo $dept["Work_hour"]."<br>--<br>".processWorkHoursToHRD($dept["Work_hour"])."</br></br>";
                    }
// 9.00 – 20.00 (без выходных) Обед и технические перерывы: 11.00 – 11.10, 12.30 – 13.00; 16.30 – 17.00; 19.00 – 19.10
// пн. – пт.: 9.00 – 18.00 сб.: 10.00 – 17.00 Обед: 11.30 – 12.00; 14.30 – 15.00
// пн. – пт.: 9.00 – 21.00 (без перерывов) сб. – вс.: 9.00 – 21.00 (Обед: 11.00 – 11.30; 15.30 – 16.00),
                //, вс. и праздничные дни – выходной




//                $strToTest = "9.00 – 20.00 (без выходных) Обед и технические перерывы: 11.00 – 11.10, 12.30 – 13.00; 16.30 – 17.00;";//"пн. – пт.: 9.00 – 18.00 сб.: 10.00 – 17.00 Обед: 11.30 – 12.00; 14.30 – 15.00";
//                preg_match_all("/(([0-9]+\.[0-9]{2}).{3,4}([0-9]+\.[0-9]{2}))/iu", $strToTest, $result);
//                              ///( ?([а-я]{2}\.(,| )?)(.? ?([а-я]{2}\.(,| )?))?)(([a-zа-я:] ([0-9]+\.[0-9]{2}).{3,4}([0-9]+\.[0-9]{2})( без обеда)?)|(и праздничные дни.{3}выходной))/iu
//                echo "<pre>";
//                print_r($result);
//                echo "</pre>";
//
//                $strToTest = "пн. – пт.: 9.00 – 18.00 сб.: 10.00 – 17.00 Обед: 11.30 – 12.00; 14.30 – 15.00";
//                preg_match_all("/(((обед( и технические перерывы)?)|(технические перерывы)):( ?([0-9]+\.[0-9]{2}).{3,4}([0-9]+\.[0-9]{2})(,|;)?)+)/iu", $strToTest, $result);
//                              ///( ?([0-9]+\.[0-9]{2}).{3,4}([0-9]+\.[0-9]{2})(,|;)?)+
//                echo "<pre>";
//                print_r($result);
//                echo "</pre>";
//
//
//                $strToTest = "9.00 – 20.00 (без выходных) Обед и технические перерывы: 11.00 – 11.10, 12.30 – 13.00; 16.30 – 17.00";
//                preg_match_all("/(((обед( и технические перерывы)?)|(технические перерывы)):( ?([0-9]+\.[0-9]{2}).{3,4}([0-9]+\.[0-9]{2})(,|;)?)+)/iu", $strToTest, $result);
//                              ///( ?([0-9]+\.[0-9]{2}).{3,4}([0-9]+\.[0-9]{2})(,|;)?)+
//                echo "<pre>";
//                print_r($result);
//                echo "</pre>";

//                $strToTest = "пн. – пт.: 9.00 – 21.00 (без перерывов) сб. – вс.: 9.00 – 21.00 (Обед: 11.00 – 11.30; 15.30 – 16.00)";
//                preg_match_all("/( ?([а-я]{2}\.(,| )?)(.? ?([а-я]{2}\.(,| )?))?)(([a-zа-я:] ([0-9]+\.[0-9]{2}).{3,4}([0-9]+\.[0-9]{2})( без обеда)?)|(и праздничные дни.{3}выходной))/iu", $strToTest, $result);
//                echo "<pre>";
//                print_r($result);
//                echo "</pre>";
                
            }
            catch(Exception $exp){
                // log exception info
                log_err($exp);

                //renderView("error.view.php", array("title"=>"Ошибка сервера", "msg"=>"Приносим свои извинения.<br/>Попробуйте перезагрузить страницу."));
            }
        ?>
    </body>
</html>
