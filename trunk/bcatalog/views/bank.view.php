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
            <!--
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
            -->

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
                    <li><a href="#exchange">Пункты обмена</a></li>
                    <li><a href="#atm">Банкоматы</a></li>
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
                    <div class="city-nav">
                        <span class="curr-city">Минск</span>&nbsp;
                        <span class="city-list-trigger">выбрать другой город</span>
                    </div>
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
                                <tr>
                                    <td class="title-col">
                                        <div class="name">ГОПЕРУ</div>
                                        <div class="work-time">
                                            <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
                                            <div class="days">сб-вс. :</div><div class="hours">выходной</div>
                                        </div>
                                    </td>
                                    <td class="addr-col">ул. Машурова 12</td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon-passive.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-col">
                                        <div class="name">ГОПЕРУ</div>
                                        <div class="work-time">
                                            <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
                                            <div class="days">сб-вс. :</div><div class="hours">выходной</div>
                                        </div>
                                    </td>
                                    <td class="addr-col">ул. Машурова 12</td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-col">
                                        <div class="name">ГОПЕРУ</div>
                                        <div class="work-time">
                                            <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
                                            <div class="days">сб-вс. :</div><div class="hours">выходной</div>
                                        </div>
                                    </td>
                                    <td class="addr-col">ул. Машурова 12</td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-col">
                                        <div class="name">ГОПЕРУ</div>
                                        <div class="work-time">
                                            <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
                                            <div class="days">сб-вс. :</div><div class="hours">выходной</div>
                                        </div>
                                    </td>
                                    <td class="addr-col">ул. Машурова 12</td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon-passive.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-col">
                                        <div class="name">ГОПЕРУ</div>
                                        <div class="work-time">
                                            <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
                                            <div class="days">сб-вс. :</div><div class="hours">выходной</div>
                                        </div>
                                    </td>
                                    <td class="addr-col">ул. Машурова 12</td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon-passive.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="exchange">
                    <div class="search">
                        <input type="text" length="150" value="введите название банка">
                        <img src="<?php echo BASE_URL."img/layout/search-icon.png"; ?>" />
                    </div>
                    <div class="city-nav">
                        <span class="curr-city">Минск</span>&nbsp;
                        <span class="city-list-trigger">выбрать другой город</span>
                    </div>
                    <div class="exchange-list">
                        <table>
                            <thead>
                                <tr>
                                    <td class="title-col">Время работы</td>
                                    <td class="addr-col">Адрес</td>
                                    <td class="map-col">Карта</td>
                                    <td class="phone-col">Телефоны</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="title-col">
                                        <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
                                        <div class="days">сб-вс. :</div><div class="hours">выходной</div>
                                    </td>
                                    <td class="addr-col">
                                        ул. Руссиянова 24-А<br/>
                                        <div class="note">универсам «Полесье». 2-ой этаж.</div>
                                    </td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-col">
                                        <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
                                        <div class="days">сб-вс. :</div><div class="hours">выходной</div>
                                    </td>
                                    <td class="addr-col">
                                        ул. Ванеева 93
                                    </td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon-passive.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-col">
                                        <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
                                        <div class="days">сб-вс. :</div><div class="hours">выходной</div>
                                    </td>
                                    <td class="addr-col">
                                        ул. Сурганова 48<br/>
                                        <div class="note">универсам «Рига». Главный вход.</div>
                                    </td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-col">
                                        <div class="days">пн-вс. :</div><div class="hours">0:00-24:00</div>
                                    </td>
                                    <td class="addr-col">
                                        ул. Якубы Коласа 15/2<br/>
                                        <div class="note">здание бассейна «Олимп».</div>
                                    </td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="atm">
                    <div class="search">
                        <input type="text" length="150" value="введите название банка">
                        <img src="<?php echo BASE_URL."img/layout/search-icon.png"; ?>" />
                    </div>
                    <div class="city-nav">
                        <span class="curr-city">Минск</span>&nbsp;
                        <span class="city-list-trigger">выбрать другой город</span>
                    </div>
                    <div class="atm-list">
                        <table>
                            <thead>
                                <tr>
                                    <td class="title-col">Время работы</td>
                                    <td class="addr-col">Адрес</td>
                                    <td class="map-col">Карта</td>
                                    <td class="phone-col">Телефоны</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="title-col">
                                        <div class="days">пн-вс. :</div><div class="hours">0:00-24:00</div>
                                    </td>
                                    <td class="addr-col">
                                        ул. Якубы Коласа 15/2<br/>
                                        <div class="note">здание бассейна «Олимп».</div>
                                    </td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon-passive.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-col">
                                        <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
                                        <div class="days">сб-вс. :</div><div class="hours">выходной</div>
                                    </td>
                                    <td class="addr-col">
                                        ул. Руссиянова 24-А<br/>
                                        <div class="note">универсам «Полесье». 2-ой этаж.</div>
                                    </td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-col">
                                        <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
                                        <div class="days">сб-вс. :</div><div class="hours">выходной</div>
                                    </td>
                                    <td class="addr-col">
                                        ул. Ванеева 93
                                    </td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon-passive.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-col">
                                        <div class="days">пн-пт. :</div><div class="hours">9:00-18:00</div>
                                        <div class="days">сб-вс. :</div><div class="hours">выходной</div>
                                    </td>
                                    <td class="addr-col">
                                        ул. Сурганова 48<br/>
                                        <div class="note">универсам «Рига». Главный вход.</div>
                                    </td>
                                    <td class="map-col">
                                        <img src="<?php echo BASE_URL; ?>img/layout/map-icon.png" alt="место на карте" />
                                    </td>
                                    <td class="phone-col">
                                        <div class="phone">(017) 275-13-27</div>
                                        <div class="fax">(017) 275-13-28</div>
                                        <div class="mobile">(029) 301-89-28</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                    selected : 2
                });
            });
        </script>
        <div id="complete-cnt"></div>
	</body>
</html>