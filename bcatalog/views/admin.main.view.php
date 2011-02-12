<!DOCTYPE HTML>
<html lang="ru-RU">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/reset.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/jquery-ui.css" />
        <title> Администраторская часть | Каталог банков</title>
    </head>

	<!--[if gt IE 6]>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/ie.css" />
	<![endif]-->

	<body>
		<div id="bc-wrapper">
            <?php
                $data["regions"] = $regions;
                $data["admin"] = true;

                renderView("city-nav.view.php", $data);
            ?>
        </div>
        
		<script type="text/javascript" src="<?php echo BASE_URL; ?>js/jq.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.core.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.position.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.autocomplete.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.tabs.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/helper.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/admin.js"></script>
        <script type="text/javascript" >
            $(function(){

                var container = $('#bc-wrapper');
                var uiObj = new AdminUI({
                    cityList : $('div.city-list', container),
                    handler : "http://bcatalog.dev:8888/admin-panel/request_handler.php",
                    imgSrc : "http://bcatalog.dev:8888/img/layout/"
                });

                
//                $('div.full-data', container).eq(0).tabs({
//                    selected : 0
//                });

                

            });
        </script>
	</body>
</html>