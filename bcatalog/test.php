<!DOCTYPE HTML>
<html lang="ru-RU">
    <head>
        <meta charset="UTF-8">
        <title>SELECT.BY</title>
	</head>
	<body>
        <?php
//            require_once('source/config.php');
//            require_once('models/bank.model.php');
//
//            $bank =  new Bank(null, $config, 3, "Alpha", "Alpha-Bank");
//
//            print_r(Bank::getAllBanks($bank->getDBH()));

//phpinfo();

        $dbh=mysql_connect ("localhost", "ctrigge8_bcatuse", "hQ_3Fg7K") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("ctrigge8_bankcatalog");
        ?>
    </body>
</html>
