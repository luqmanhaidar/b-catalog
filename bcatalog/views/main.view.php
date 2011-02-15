<!DOCTYPE HTML>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/reset.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/jquery-ui.css" />
	<title><?php echo $title?> | BCATALOG</title>
	</head>

	<!--[if gt IE 6]>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/ie.css" />
	<![endif]-->

	<body>
		<div id="bc-wrapper">
            <div class="search">
                <input type="text" length="150" value="введите название банка">
                <img src="<?php echo BASE_URL."img/layout/search-icon.png"; ?>" />
            </div>
            <div class="city-nav">
                <span class="curr-city" city_id="<?php echo $capital_id; ?>"><?php echo $capital_name; ?></span>&nbsp;
                <span class="city-list-trigger">выбрать другой город</span>
            </div>
            <div class="city-list">
                <div class="head"><img src="<?php echo BASE_URL."img/layout/arr.png"; ?>"/><span class="close">скрыть</span></div>
                <div class="content">
                    <table>
                        <tr class="city-search">
                            <td colspan="3">
                                <input type="text" length="150" value="введите название города">
                                <img class="city-search-btn" src="<?php echo BASE_URL."img/layout/search-icon.png"; ?>" />
                            </td>
                        </tr>
                        <tr class="head">
                            <td class="select-base regions">&nbsp;</td>
                            <td class="select-base areas"><div class="area-center">Минск</div></td>
                            <td class="select-base cities"><span class="show-all">показать все города области</span></td>
                        </tr>
                        <tr>
                            <td class="select-base regions">
                                <ul class="current">
                                    <?php foreach($regions as $region): ?>
                                    <li region_id="<?php echo $region->region_id; ?>" reg_center="<?php echo $region->center_id; ?>"><?php echo $region->name; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td class="select-base areas">
                                <?php foreach($regions as $region): ?>
                                <ul region_id="<?php echo $region->region_id; ?>">
                                    <?php foreach($region->areas as $area): ?>
                                    <li area_id="<?php echo $area->area_id; ?>"><?php echo $area->name; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endforeach; ?>
                            </td>
                            <td class="select-base cities">
                                <?php foreach($regions as $region): ?>
                                <ul region_id="<?php echo $region->region_id; ?>">
                                    <?php foreach($region->areas as $area): ?>
                                        <?php foreach($area->cities as $city): ?>
                                        <li area_id="<?php echo $city->area_id; ?>" city_id="<?php echo $city->city_id; ?>" ><?php echo $city->name; ?></li>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="alpha-nav">
                <ul>
                    <li class="variant first selected">Все</li>
                    <li> | </li>
                    <li>А</li>
                    <li>Б</li>
                    <li>В</li>
                    <li>Г</li>
                    <li>Д</li>
                    <li>Е</li>
                    <li>Ж</li>
                    <li>З</li>
                    <li>И</li>
                    <li>К</li>
                    <li>Л</li>
                    <li>М</li>
                    <li>Н</li>
                    <li>О</li>
                    <li>П</li>
                    <li>Р</li>
                    <li>С</li>
                    <li>Т</li>
                    <li>У</li>
                    <li>Ф</li>
                    <li>Х</li>
                    <li>Ц</li>
                    <li>Ш</li>
                    <li>Э</li>
                    <li>Ю</li>
                    <li>Я</li>
                </ul>
            </div>
            <div class="bank-list">
                <table>
                    <thead>
                        <tr>
                            <td class="logo-col">&nbsp;</td>
                            <td class="title-col">Название</td>
                            <td class="link-col">Сайт</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banks as $bank): ?>
                        <tr bank_id="<?php echo $bank->Kod_B; ?>">
                            <td class="logo-col"><img src="<?php echo str_replace("http://bcatalog.dev:8888/", BASE_URL, $bank->Logo_min); ?>"/></td>
                            <td class="title-col"><?php echo $bank->Name_short; ?></td>
                            <td class="link-col"><a target="_blank" href="<?php echo BASE_URL;?>bank.php?bank_id=<?php echo $bank->Kod_B; ?>"><?php echo $bank->Http; ?></a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="page-nav"></div>
        </div>

		<script type="text/javascript" src="<?php echo BASE_URL; ?>js/jq.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.core.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.position.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.autocomplete.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/helper.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/bcatalog.js"></script>
        <script type="text/javascript" >
            $(function(){

                var container = $('#bc-wrapper');
                var searchBlock = $('div.search', container);
                var cityNavBlock = $('div.city-nav', container);
                var cityListBlock = $('div.city-list', container);
                var alphaNavBlock = $('div.alpha-nav', container);
                var bankListBlock = $('div.bank-list', container);

                var BCui = new BCatalog(container, searchBlock, cityNavBlock, cityListBlock, alphaNavBlock, bankListBlock, null, "http://bcatalog.dev:8888/request_handler.php", "http://bcatalog.dev:8888/bank.php");

                BCui.init();
            });
        </script>
        <div id="complete-cnt"></div>
	</body>
</html>