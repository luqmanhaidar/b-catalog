<!DOCTYPE HTML>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/reset.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/style.css" />
	<title><?php echo $title?> | SELECT.BY</title>
	</head>

	<!--[if gt IE 6]>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/ie.css" />
	<![endif]-->

	<body>
		<div id="bc-wrapper">
            <div class="search">
                <input type="text" length="150"> <img src="<?php echo BASE_URL."img/layout/search-icon.png"; ?>" />
            </div>
            <div class="city-nav">
                <div class="curr-city">Минск</div>&nbsp;
                <div class="city-list-trigger">выбрать другой город</div>
            </div>
            <div class="city-list">

                &nbsp;<br/>
                &nbsp;<br/>
                &nbsp;<br/>
                &nbsp;<br/>
                &nbsp;<br/>
                &nbsp;<br/>

            </div>
            <div class="alpha-nav">
                <!-- generateAlphaNav($city = null) -->
                <ul>
                    <li class="variant first">Все&nbsp;&nbsp;&nbsp;| </li>
                    <li class="variant">A</li>
                    <li class="variant">Б</li>
                    <li>В</li>
                    <li class="variant">Г</li>
                    <li>Д</li>
                    <li>Е</li>
                    <li class="variant">Ж</li>
                    <li class="variant">З</li>
                    <li class="variant">И</li>
                    <li>К</li>
                    <li class="variant">Л</li>
                    <li class="variant">М</li>
                    <li class="variant">Н</li>
                    <li>О</li>
                    <li>П</li>
                    <li>Р</li>
                    <li>С</li>
                    <li>Т</li>
                    <li class="variant">У</li>
                    <li class="variant">Ф</li>
                    <li class="variant">Х</li>
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
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/alpha_logo.gif";?>"/></td>
                            <td class="title-col">Альфа-БАНК</td>
                            <td class="link-col"><a target="_blank" href="http://alpha.ru">www.alpha.ru</a></td>
                        </tr>
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/vtb24_logo.png";?>"/></td>
                            <td class="title-col">ВТБ</td>
                            <td class="link-col"><a target="_blank" href="http://vtb24.ru">www.vtb24.ru</a></td>
                        </tr>
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/bsb_logo.png";?>"/></td>
                            <td class="title-col">BelSwissBank</td>
                            <td class="link-col"><a target="_blank" href="http://alpha.ru">www.bsb.ru</a></td>
                        </tr>
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/credex_logo.png";?>"/></td>
                            <td class="title-col">CREDEX</td>
                            <td class="link-col"><a target="_blank" href="http://vtb24.ru">www.credex.ru</a></td>
                        </tr>
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/mm_logo.png";?>"/></td>
                            <td class="title-col">Москва-Минск</td>
                            <td class="link-col"><a target="_blank" href="http://alpha.ru">www.mm.ru</a></td>
                        </tr>
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/belarus-bank.by.png";?>"/></td>
                            <td class="title-col">Беларусбанк</td>
                            <td class="link-col"><a target="_blank" href="http://vtb24.ru">www.belarusbank.ru</a></td>
                        </tr>
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/alpha_logo.gif";?>"/></td>
                            <td class="title-col">Альфа-БАНК</td>
                            <td class="link-col"><a target="_blank" href="http://alpha.ru">www.alpha.ru</a></td>
                        </tr>
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/vtb24_logo.png";?>"/></td>
                            <td class="title-col">ВТБ</td>
                            <td class="link-col"><a target="_blank" href="http://vtb24.ru">www.vtb24.ru</a></td>
                        </tr>
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/bsb_logo.png";?>"/></td>
                            <td class="title-col">BelSwissBank</td>
                            <td class="link-col"><a target="_blank" href="http://alpha.ru">www.bsb.ru</a></td>
                        </tr>
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/credex_logo.png";?>"/></td>
                            <td class="title-col">CREDEX</td>
                            <td class="link-col"><a target="_blank" href="http://vtb24.ru">www.credex.ru</a></td>
                        </tr>
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/mm_logo.png";?>"/></td>
                            <td class="title-col">Москва-Минск</td>
                            <td class="link-col"><a target="_blank" href="http://alpha.ru">www.mm.ru</a></td>
                        </tr>
                        <tr>
                            <td class="logo-col"><img src="<?php echo BASE_URL."/img/content/belarus-bank.by.png";?>"/></td>
                            <td class="title-col">Беларусбанк</td>
                            <td class="link-col"><a target="_blank" href="http://vtb24.ru">www.belarusbank.ru</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="page-nav"></div>
        </div>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>js/jq.js"></script>
	</body>
</html>