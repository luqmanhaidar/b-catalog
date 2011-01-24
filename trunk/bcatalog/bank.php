<?php

require_once(realpath(dirname(__FILE__))."/source/config.php");
require_once(realpath(dirname(__FILE__))."/source/helper.php");


$data["title"] = "АЛЬФА-БАНК | SELECT.BY";

renderView("bank.view.php", $data);
?>