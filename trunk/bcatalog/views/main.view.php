<!DOCTYPE HTML>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/reset.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/jquery-ui-aco.css" />
	<title><?php echo $title?> | SELECT.BY</title>
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
                <span class="curr-city">Минск</span>&nbsp;
                <span class="city-list-trigger">выбрать другой город</span>
            </div>
            <div class="city-list">
                <div class="head"><img src="<?php echo BASE_URL."img/layout/arr.png"; ?>"/><span class="close">скрыть</span></div>
                <div class="content">
                    <table>
                        <tr class="city-search">
                            <td colspan="3">
                                <input type="text" length="150" value="введите название города">
                                <img src="<?php echo BASE_URL."img/layout/search-icon.png"; ?>" />
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
                                    <li region_id="1" reg_center="Брест">Брестская область</li>
                                    <li region_id="2" reg_center="Витебск">Витебская область</li>
                                    <li region_id="3" reg_center="Минск" class="selected">Минская область</li>
                                    <li region_id="4" reg_center="Могилев">Могилевская область</li>
                                    <li region_id="5" reg_center="Гомель">Гомельская область</li>
                                    <li region_id="6" reg_center="Гродно">Гродненская область</li>
                                </ul>
                            </td>
                            <td class="select-base areas">
                                <ul region_id="3" class="current">
                                    <li area_id="1">Красных фонарей</li>
                                    <li area_id="2">Еще один район</li>
                                    <li area_id="3" class="selected">Минский район</li>
                                    <li area_id="4">Воложинский район</li>
                                    <li area_id="5">Чирик район</li>
                                </ul>
                                <ul region_id="2">
                                    <li area_id="1">Бешенковичский</li>
                                    <li area_id="2">Браславский</li>
                                    <li area_id="3">Верхнедвинский</li>
                                    <li area_id="4">Витебский</li>
                                    <li area_id="5">Глубокский</li>
                                    <li area_id="6">Городокский</li>
                                </ul>
                                <ul region_id="1">
                                    <li area_id="1">Брестский</li>
                                    <li area_id="2">Барановичский</li>
                                    <li area_id="3">Берёзовский</li>
                                    <li area_id="4">Ганцевичский</li>
                                    <li area_id="5">Дрогичинский</li>
                                    <li area_id="6">Жабинковский</li>
                                </ul>
                            </td>
                            <td class="select-base cities">
                                <ul region_id="3" class="current">
                                    <li area_id="1">Ечка</li>
                                    <li area_id="1">Асуньен</li>
                                    <li area_id="2">Большой Куяш</li>
                                    <li area_id="2">Раздериха</li>
                                    <li area_id="3" class="selected">Минск</li>
                                    <li area_id="3">Кокаиновые горы</li>
                                    <li area_id="4">Ечка</li>
                                    <li area_id="4">Асуньен</li>
                                    <li area_id="5">Большой Куяш</li>
                                    <li area_id="5">Раздериха</li>
                                    <li area_id="1">Кокаиновые горы</li>
                                </ul>
                                <ul region_id="1">
                                    <li area_id="1">Брест</li>
                                    <li area_id="1">Иваново</li>
                                    <li area_id="2">Барановичи</li>
                                    <li area_id="2">Дрогичин</li>
                                    <li area_id="6">Пинск</li>
                                    <li area_id="3">Ганцевичи</li>
                                    <li area_id="4">Кобрин</li>
                                    <li area_id="4">Жабинка</li>
                                    <li area_id="5">Берёза</li>
                                    <li area_id="5">Белоозёрск</li>
                                    <li area_id="6">Ивацевичи</li>
                                    <li area_id="6">Столин</li>
                                </ul>
                                <ul region_id="2">
                                    <li area_id="1">Витебск</li>
                                    <li area_id="1">Барань</li>
                                    <li area_id="2">Браслав</li>
                                    <li area_id="2">Верхнедвинск</li>
                                    <li area_id="3">Глубокое</li>
                                    <li area_id="3">Городок</li>
                                    <li area_id="4">Дисна</li>
                                    <li area_id="4">Докшицы</li>
                                    <li area_id="5">Дубровно</li>
                                    <li area_id="5">Лепель</li>
                                    <li area_id="6">Лиозно</li>
                                    <li area_id="6">Миоры</li>
                                    <li area_id="6">Новолукомль</li>
                                </ul>
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
                            <td class="logo-col"><img src="<?php echo $bank->Logo_min; ?>"/></td>
                            <td class="title-col"><?php echo $bank->Name_short; ?></td>
                            <td class="link-col"><a target="_blank" href="<?php echo $bank->Http; ?>"><?php echo $bank->Http; ?></a></td>
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
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/bcatalog.js"></script>
        <script type="text/javascript" >
            $(function(){

                var container = $('#bc-wrapper');
                var searchBlock = $('div.search', container);
                var cityNavBlock = $('div.city-nav', container);
                var cityListBlock = $('div.city-list', container);
                var alphaNavBlock = $('div.alpha-nav', container);
                var bankListBlock = $('div.bank-list', container);

                var BCui = new BCatalog(container, searchBlock, cityNavBlock, cityListBlock, alphaNavBlock, bankListBlock, null);

                BCui.init();
            });
        </script>
	</body>
</html>