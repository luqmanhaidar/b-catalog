<!DOCTYPE HTML>
<html lang="ru-RU">
    <head>
        <meta charset="UTF-8">
        <title>SELECT.BY</title>
	</head>
	<body>
        <?php
            require_once('source/config.php');
            require_once('models/bank.model.php');

            $bank =  new Bank(null, $config, 3, "Alpha", "Alpha-Bank");

            print_r(Bank::getAllBanks($bank->getDBH()));
        ?>
    </body>
</html>
