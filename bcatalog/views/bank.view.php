<!DOCTYPE HTML>
<html lang="ru-RU">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/reset.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/jquery-ui.css" />
        <title><?php echo $title; ?> | BCATALOG</title>
    </head>

	<!--[if gt IE 6]>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL; ?>css/ie.css" />
	<![endif]-->

	<body>
        <?php /*print_r($bank);*/ ?>
		<div id="bc-wrapper">
            <div class="bheader">
                <div class="logo">
                    <img src="<?php echo $bank->Logo; ?>" alt="<?php echo $title; ?>" />
                </div>
                <div class="descr">
                    <div class="title"><?php echo $title; ?></div>
                    <div class="full-name"><br/><?php echo str_replace("<i>", "", str_replace("</i>", "", $bank->Name_full)); ?></div>
                </div>&nbsp;
            </div>

            <div class="full-data">
                <ul>
                    <li><a href="#info">О банке</a></li>
                    <li><a href="#departments">Отделения</a></li>
                    <?php if($bank->services_tab == 1): ?>
                    <li><a href="#services">Услуги</a></li>
                    <?php endif; ?>
                    <?php if($bank->deposits_tab == 1): ?>
                    <li><a href="#deposits">Вклады</a></li>
                    <?php endif; ?>
                    <?php if($bank->credits_tab == 1): ?>
                    <li><a href="#credits">Кредиты</a></li>
                    <?php endif; ?>
                </ul>
                <div id="info">
                    <table class="bank-info">
                        <tr>
                            <td class="title-col">
                                Лицензия
                            </td>
                            <td class="info-col">
                                <?php echo $bank->Licence; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="title-col">Контакты</td>
                            <td class="info-col">
                                <?php echo $bank->Adress; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="title-col">Ссылки</td>
                            <td class="info-col">
                                <?php echo $bank->Www; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="title-col">Акционеры</td>
                            <td class="info-col">
                                <?php echo $bank->Owners; ?>
                            </td>
                        </tr>
                        <tr class="last">
                            <td class="title-col">Доп. информация</td>
                            <td class="info-col">
                                <?php echo $bank->Note; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="departments">
                    <div class="search bank">
                        <input type="text" length="150" value="введите адрес">
                        <img src="<?php echo BASE_URL."img/layout/search-icon.png"; ?>" />
                        
                    </div>
                    <div class="dept-class-nav">
                        <input type="checkbox" checked="checked" value="0" class="all" /><span class="title"> все</span><br/>
                        <div class="separator">&nbsp;</div>
                        <input type="checkbox" checked="checked" value="1" /><span class="title"> отделение</span><br/>
                        <input type="checkbox" checked="checked" value="2" /><span class="title"> банкомат</span><br/>
                        <input type="checkbox" checked="checked" value="3" /><span class="title"> обменный пункт</span><br/>
                        <input type="checkbox" checked="checked" value="4" /><span class="title"> инфокиоск</span><br/>
                        <input type="checkbox" checked="checked" value="5" /><span class="title"> терминал</span>
                    </div>
                    <?php
                        $data["regions"] = $regions;
                        $data["city_id"] = $city_id;
                        $data["city_name"] = $city_name;
                        $data["city_nav"] = true;
                        $data["city_search"] = true;
                        renderView("city-nav.view.php", $data);
                    ?>
                    <div class="error"></div>
                    <div class="department-list" bank_id="<?php echo $bank->Kod_B; ?>">
                        <table>
                            <thead>
                                <tr>
                                    <td class="title-col">Отделение</td>
                                    <td class="addr-col">Адрес</td>
                                    <td class="map-col">Карта</td>
                                    <td class="phone-col">Телефоны</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($departments as $department){
                                    renderView("department.view.php", $department, true);
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        $pag_data["page_num"] = $page_num;
                        $pag_data["page_qnt"] = $page_qnt;
                        $pag_data["page_length"] = $page_length;
                        renderView("pagination.view.php", $pag_data)
                    ?>
                </div>
                <?php if($bank->services_tab == 1): ?>
                <div id="services">
                    <?php echo $bank->services; ?>
                </div>
                <?php endif; ?>
                <?php if($bank->deposits_tab == 1): ?>
                <div id="deposits">
                    <?php echo $bank->deposits; ?>
                </div>
                <?php endif; ?>
                <?php if($bank->credits_tab == 1): ?>
                <div id="credits">
                    <?php echo $bank->credits; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

		<script type="text/javascript" src="<?php echo BASE_URL; ?>js/jq.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.core.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.position.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.autocomplete.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.ui.tabs.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/helper.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/dept_type.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/depts.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.tmpl.js"></script>
        <script id="dept-row-template" type="text/x-jquery-tmpl" >
        <tr dept_type="${Type}">
            <td class="title-col">
                <div class="name">${Name}</div>
                <div class="work-time">
                    {{html Work_hour}}
                </div>
            </td>
            <td class="addr-col">
                ${Adress}<br/>
                <div class="note">
                    ${Comment}
                </div>
            </td>
            <td class="map-col">
                <img src="<?php echo BASE_URL; ?>img/layout/map-icon{{if (map_link == "")}}-passive{{/if}}.png" alt="место на карте" />
            </td>
            <td class="phone-col">
                {{html Phone}}
            </td>
        </tr>
        </script>
        <script type="text/javascript" >
            $(function(){

                var container = $('#bc-wrapper');
                var searchBlock = $('div.search', container);
                var cityNavBlock = $('div.city-nav', container);
                var cityListBlock = $('div.city-list', container);
                var deptListBlock = $('div.department-list', container);
                var paginationBlock = $('div.page-nav', container);
                var tabArr = $('div.full-data > div', container);
                var bank_id = deptListBlock.attr('bank_id');
                var city_id = cityNavBlock.find('span.curr-city').attr('city_id');
                var errCnt = $('div.error', container);
                var typeSel =$('div.dept-class-nav', container);

                $('div.full-data', container).eq(0).tabs({
                    selected : 1
                });

                var DEPTS = new DepartmentList(container, searchBlock, tabArr, cityNavBlock, cityListBlock, deptListBlock, paginationBlock, errCnt, typeSel,city_id, bank_id, 20, "http://bcatalog.dev:8888/request_handler.php");//http://ctrigger.ru/bcatalog/ | bcatalog.dev:8888/
                DEPTS.init();

            });
        </script>
        <div id="complete-cnt"></div>
	</body>
</html>