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
            <div class="select-bank">
                <select>
                    <?php foreach($banks as $bank): ?>
                    <option value="<?php echo $bank->Kod_B; ?>"><?php echo $bank->Name_short; ?></option>
                    <?php endforeach; ?>                    
                </select>
                <button>редактировать</button>
            </div>
            <div id="bank-edit">
                <ul>
                    <li><a href="#preedit">Редактирование</a></li>
                    <li><a href="#preview" class="to-preview">Предпросмотр</a></li>
                </ul>
                <div id="preedit">
                    <form id="bank-info-input">
                        <table>
                            <tr>
                                <td>&nbsp;</td>
                                <td><h2><span class="action">Добавить новый банк</span><span id="bank_id"></span></h2></td>
                            </tr>
                            <tr>
                                <td class="titles">Короткое название</td>
                                <td class="values"><input type="text" name="name_short" value="" /></td>
                            </tr>
                            <tr>
                                <td class="titles">Полное название</td>
                                <td class="values"><input type="text" name="name_full" value="" /></td>
                            </tr>
                            <tr>
                                <td class="titles">Название [ENG]</td>
                                <td class="values"><input type="text" name="name_eng" value="" /></td>
                            </tr>
                            <tr>
                                <td class="titles">Ссылки</td>
                                <td class="values">
                                    <textarea name="www" id="" cols="30" rows="10"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="titles">Ссылка на сайт</td>
                                <td class="values"><input type="text" name="http" value="" /></td>
                            </tr>
                            <tr>
                                <td class="titles">URL мини логотипа</td>
                                <td class="values"><input type="text" name="logo_min" value="" /></td>
                            </tr>
                            <tr>
                                <td class="titles">URL полноразмерного логотипа</td>
                                <td class="values"><input type="text" name="logo" value="" /></td>
                            </tr>
                            <tr>
                                <td class="titles">Наша ссылка</td>
                                <td class="values"><input type="text" name="our_http" value="" /></td>
                            </tr>
                            <tr>
                                <td class="titles">Адрес, телефоны, контакты</td>
                                <td class="values">
                                    <textarea name="adress" id="" cols="30" rows="10"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="titles">Лицензия</td>
                                <td class="values">
                                    <textarea name="licence" id="" cols="30" rows="10"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="titles">Акционеры</td>
                                <td class="values">
                                    <textarea name="owners" id="" cols="30" rows="10"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="titles">Примечание</td>
                                <td class="values">
                                    <textarea name="note" id="" cols="30" rows="10"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="titles">Локация головного офиса</td>
                                <td class="values">
                                    <select name="city_id" id="main-office-location">
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="titles">Вкладка «услуги»</td>
                                <td class="values">
                                    <input type="radio" name="services_tab" value="0" checked="checked" /> Выкл.<br/>
                                    <input type="radio" name="services_tab" value="1" /> Вкл.
                                </td>
                            </tr>
                            <tr>
                                <td class="titles">Вкладка «депозиты»</td>
                                <td class="values">
                                    <input type="radio" name="deposits_tab" value="0" checked="checked" /> Выкл.<br/>
                                    <input type="radio" name="deposits_tab" value="1" /> Вкл.
                                </td>
                            </tr>
                            <tr>
                                <td class="titles">Вкладка «кредиты»</td>
                                <td class="values">
                                    <input type="radio" name="credits_tab" value="0" checked="checked" /> Выкл.<br/>
                                    <input type="radio" name="credits_tab" value="1" /> Вкл.
                                </td>
                            </tr>
                        </table>
                    </form>
                    <div class="act-block">
                        <button class="accept">Добавить</button><button class="cancel">Сбросить значения</button>
                    </div>
                </div>
                <div id="preview">
                    <table class="bank-info">
                        <tr>
                            <td class="title-col">
                                Лицензия
                            </td>
                            <td class="info-col">
                                <span class="licence"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="title-col">Контакты</td>
                            <td class="info-col">
                                <span class="adress"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="title-col">Ссылки</td>
                            <td class="info-col">
                                <span class="www"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="title-col">Акционеры</td>
                            <td class="info-col">
                                <span class="owners"></span>
                            </td>
                        </tr>
                        <tr class="last">
                            <td class="title-col">Доп. информация</td>
                            <td class="info-col">
                                <span class="note"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
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
                    bankSelect : $('div.select-bank', container),
                    preEdit : $('div#preedit', container),
                    preView : $('div#preview', container),
                    handler : "http://bcatalog.dev:8888/admin-panel/request_handler.php",
                    imgSrc : "http://bcatalog.dev:8888/img/layout/"
                });


                $("#bank-edit").tabs({selected:0});

                
//                $('div.full-data', container).eq(0).tabs({
//                    selected : 0
//                });

                

            });
        </script>
	</body>
</html>