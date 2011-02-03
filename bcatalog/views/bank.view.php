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
            <div class="bheader">
                <div class="logo">
                    <img src="<?php echo BASE_URL; ?>img/content/full-size-logo/logo-alfabank-big.png" alt="" />
                </div>
                <div class="descr">
                    <div class="title">Альфабанк</div>
                    <div class="full-name"><br/>Закрытое акционерное общество «Альфабанк»</div>
                </div>&nbsp;
            </div>

            <div class="full-data">
                <ul>
                    <li><a href="#info">О банке</a></li>
                    <li><a href="#departments">Отделения</a></li>
                    <li><a href="#services">Услуги</a></li>
                    <li><a href="#deposits">Вклады</a></li>
                    <li><a href="#credits">Кредиты</a></li>
                </ul>
                <div id="info">
                    <table>
                        <tr>
                            <td class="title-col">
                                Лицензия
                            </td>
                            <td class="info-col">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                            </td>
                        </tr>
                        <tr>
                            <td class="title-col">Контакты</td>
                            <td class="info-col">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/></td>
                        </tr>
                        <tr>
                            <td class="title-col">Ссылки</td>
                            <td class="info-col">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/></td>
                        </tr>
                        <tr class="last">
                            <td class="title-col">Акционеры</td>
                            <td class="info-col">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/></td>
                        </tr>
                    </table>
                </div>
                <div id="departments">
                    <div class="search">
                        <input type="text" length="150" value="введите название банка">
                        <img src="<?php echo BASE_URL."img/layout/search-icon.png"; ?>" />
                    </div>
                    <?php
                        $data["regions"] = $regions;
                        renderView("city-nav.view.php", $data);
                    ?>
                    <div class="department-list">
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
                        renderView("pagination.view.php", $pag_data)
                    ?>
                </div>
                <div id="services">
                    SERV Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis libero nisi, eget hendrerit elit. Sed cursus nulla in sapien pulvinar a mattis lacus ullamcorper. Nunc varius, purus sed interdum aliquet, tellus est adipiscing arcu, rutrum rhoncus risus metus a purus. Mauris vel lacinia ipsum. Nullam neque mauris, viverra sit amet tempus lobortis, hendrerit sit amet metus. Praesent porta, enim non accumsan tempor, dui lacus ultricies urna, et elementum quam augue sit amet tellus. Pellentesque hendrerit, nisl nec egestas aliquet, tellus risus ullamcorper magna, eu tincidunt nulla ante sed orci. Phasellus aliquet, odio et egestas tristique, lectus mauris sollicitudin magna, eget lobortis eros velit id lacus. Mauris nec enim vulputate justo euismod faucibus ut tincidunt enim. Phasellus interdum felis non orci suscipit hendrerit ac non justo. Proin vestibulum libero a urna ornare euismod. Aliquam dictum convallis neque et consequat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                </div>
                <div id="deposits">
                    DEP Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis libero nisi, eget hendrerit elit. Sed cursus nulla in sapien pulvinar a mattis lacus ullamcorper. Nunc varius, purus sed interdum aliquet, tellus est adipiscing arcu, rutrum rhoncus risus metus a purus. Mauris vel lacinia ipsum. Nullam neque mauris, viverra sit amet tempus lobortis, hendrerit sit amet metus. Praesent porta, enim non accumsan tempor, dui lacus ultricies urna, et elementum quam augue sit amet tellus. Pellentesque hendrerit, nisl nec egestas aliquet, tellus risus ullamcorper magna, eu tincidunt nulla ante sed orci. Phasellus aliquet, odio et egestas tristique, lectus mauris sollicitudin magna, eget lobortis eros velit id lacus. Mauris nec enim vulputate justo euismod faucibus ut tincidunt enim. Phasellus interdum felis non orci suscipit hendrerit ac non justo. Proin vestibulum libero a urna ornare euismod. Aliquam dictum convallis neque et consequat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                </div>
                <div id="credits">
                    CRE Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis libero nisi, eget hendrerit elit. Sed cursus nulla in sapien pulvinar a mattis lacus ullamcorper. Nunc varius, purus sed interdum aliquet, tellus est adipiscing arcu, rutrum rhoncus risus metus a purus. Mauris vel lacinia ipsum. Nullam neque mauris, viverra sit amet tempus lobortis, hendrerit sit amet metus. Praesent porta, enim non accumsan tempor, dui lacus ultricies urna, et elementum quam augue sit amet tellus. Pellentesque hendrerit, nisl nec egestas aliquet, tellus risus ullamcorper magna, eu tincidunt nulla ante sed orci. Phasellus aliquet, odio et egestas tristique, lectus mauris sollicitudin magna, eget lobortis eros velit id lacus. Mauris nec enim vulputate justo euismod faucibus ut tincidunt enim. Phasellus interdum felis non orci suscipit hendrerit ac non justo. Proin vestibulum libero a urna ornare euismod. Aliquam dictum convallis neque et consequat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
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
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/bcatalog.js"></script>
        <script type="text/javascript" >
            $(function(){

//                var container = $('#bc-wrapper');
//                var searchBlock = $('div.search', container);
//                var cityNavBlock = $('div.city-nav', container);
//                var cityListBlock = $('div.city-list', container);
//                var alphaNavBlock = $('div.alpha-nav', container);
//                var bankListBlock = $('div.bank-list', container);

                //var BCui = new BCatalog(container, searchBlock, cityNavBlock, cityListBlock, alphaNavBlock, bankListBlock, null, "http://bcatalog.dev:8888/request_handler.php", "http://bcatalog.dev:8888/bank.php");
                //BCui.init();

                $('#bc-wrapper div.full-data').eq(0).tabs({
                    selected : 1
                });
            });
        </script>
        <div id="complete-cnt"></div>
	</body>
</html>