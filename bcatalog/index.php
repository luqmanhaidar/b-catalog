<?php

require_once(realpath(dirname(__FILE__))."/source/config.php");
require_once(realpath(dirname(__FILE__))."/source/helper.php");


$data["title"] = "Каталог банков";

renderView("main.view.php", $data);
?>