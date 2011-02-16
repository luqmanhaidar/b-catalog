 /*  
 * @constructor
 * @param {jQuery} container общий контейнер
 * @param {jQuery} searchCnt контейнер с элементами поиска
 * @param {jQuery} tabs массив вкладок, дли зависит от того, насколько детальна информация о банке
 * @param {jQuery} cityNavCnt содержит информация о текущем городе и кнопку, инициирующую разворачивание списка
 * @param {jQuery} cityListCnt содержит список областей/районов/городов
 * @param {jQuery} deptListCnt содержит список отделений
 * @param {jQuery} pageNavCnt содержит элемент постраничной навигации
 * @param {jQuery} errCnt блок для отображения ошибок
 * @param {id} currCity id текущего города
 * @param {Integer} currBank id текущего банка
 * @param {Integer} pageLength количество строк на страницу списка
 * @param {String} handler обработчик AJAX запросов
 */
function DepartmentList(container, searchCnt, tabs, cityNavCnt, cityListCnt, deptListCnt, pageNavCnt, errCnt, typeSelCnt, currCity, currBank, pageLength, handler){

    this.container = container;
    this.searchCnt = searchCnt;
    this.cityNavCnt = cityNavCnt;
    this.cityListCnt = cityListCnt;
    this.tabs = tabs;
    this.deptListCnt = deptListCnt;
    this.pageNavCnt = pageNavCnt;
    this.errMsgCnt = errCnt;

    this.typeSelector = new TypeSelector({container:typeSelCnt});

    this.currCity = (typeof currCity == 'undefined' || !currCity) ? "1" : currCity;
    this.currBank = currBank;
    this.pageLength = (typeof pageLength == 'undefined' || !pageLength ) ? "20" : pageLength;

    this.handlerUrl = (typeof handler == 'undefined' || !handler) ? "request_handler.php" : handler;
    //this.bankUrl = (typeof bankUrl == 'undefined' || !bankUrl) ? "bank.php" : bankUrl;

}


DepartmentList.prototype.init = function(settings){
    // объявляем фиктивную переменную вместо this,
    // чтобы его можно было использовать в методах, выполняющихся в другом контексте
    var DeptsUI = this;

    this.cityNavCnt.find('span.city-list-trigger').bind('click', {ui:DeptsUI}, this.toggleCityList);
    this.cityListCnt.find('span.close').bind('click', {ui:DeptsUI}, this.toggleCityList);

    this.cityListCnt.find('td.regions li').bind('click', {ui:DeptsUI}, this.selectRegion);
    this.cityListCnt.find('td.areas li').bind('click', {ui:DeptsUI}, this.selectArea);
    this.cityListCnt.find('td.cities li').bind('click', {ui:DeptsUI}, this.selectCity);
    this.cityListCnt.find('span.show-all').bind('click', {ui:DeptsUI}, this.showRegionCities);

    // делаем клик по областному центру аналогом клика по аналогичному элементу в списке городов
    this.cityListCnt.find('div.area-center').bind('click', {ui:DeptsUI}, function(evtObj){
        $('td.cities li:contains("'+evtObj.target.innerHTML+'")', evtObj.data.ui.cityListCnt).trigger('click');
    });

    // инициализируем элементы постраничной навигации
    this.pageNavCnt.find('li').live('click', {ui:DeptsUI}, this.selectPage);

    // инициализируем autocomplete поиска по городу
    var cityInput = this.searchCnt.find('input');
    var citySearchTrigger = this.searchCnt.find('img');

    citySearchTrigger.bind('click', {ui:DeptsUI}, function(evtObj){
        evtObj.data.ui.updateDeptList(evtObj.data.ui.currBank, evtObj.data.ui.currCity, evtObj.data.ui.pageLength, 1, 1, cityInput.val());
    });

    cityInput.focus(function(evtObj){
        if(cityInput.val().indexOf('введите адрес') == 0)
            cityInput.val('');
    });
    cityInput.blur(function(evtObj){       
        if(cityInput.val().length == 0)
            cityInput.val('введите адрес');
    });
    cityInput.bind("keydown", {ui:DeptsUI}, function(evtObj){
        if(evtObj.keyCode == 13)
            DeptsUI.searchCnt.find('img').click();
    });
    this.searchCnt.find('img').bind('click', function(evtObj){
        DeptsUI.updateDeptList(DeptsUI.currBank, DeptsUI.currCity, DeptsUI.pageLength, 1, 1, cityInput.val());
    });

    cityInput.autocomplete({
        source : [],
        minLength : 1,
        delay : 300,
        select : function(eventObj, ui){
            DeptsUI.updateDeptList(DeptsUI.currBank, DeptsUI.currCity, DeptsUI.pageLength, 1, 1, cityInput.val());
        }
    });

    // инициализируем autocomplete поиска города
    var cityNameInput = this.cityListCnt.find('input.city-search-input');
    cityNameInput.focus(function(evtObj){
        var input = $(evtObj.target);
        if(input.val().indexOf('введите название города') == 0)
            input.val('');
    });
    cityNameInput.blur(function(evtObj){
        var input = $(evtObj.target);
        if(input.val().length == 0)
            input.val('введите название города');
    });
    cityNameInput.autocomplete({
        source    : Helper.array_unique(Helper.getInnerHTMLToArr(this.cityListCnt.find('tbody td.cities li'))),
        minLength : 1,
        delay     : 0,
        select    : function(evtObj, ui){ $(evtObj.target).next().click(); }
    });

    this.cityListCnt.find('.city-search-btn').bind('click', {ui:DeptsUI}, this.triggerCityClick);

    this.getAdresses("", true);
}


/**
 * отобразит список городов, если он скрыт и скроет в противном случае
 * @param {jQueryEvent} evtObj
 */
DepartmentList.prototype.toggleCityList = function(evtObj){

    if(evtObj.data.ui.cityListCnt.is(':visible'))
        evtObj.data.ui.cityListCnt.slideUp(400);
    else
        evtObj.data.ui.cityListCnt.slideDown(400);
}


DepartmentList.prototype.selectRegion = function(evtObj){

    var clickedRegion = $(evtObj.target);
    var regions = evtObj.data.ui.cityListCnt.find('td.regions:last ul');
    var areas = evtObj.data.ui.cityListCnt.find('td.areas:last');
    var cities = evtObj.data.ui.cityListCnt.find('td.cities:last');

    regions.find('li.selected').removeClass('selected');
    regions.find('li[region_id='+clickedRegion.attr('region_id')+']').addClass('selected');
    areas.find('ul.current').removeClass('current').find('li.selected').removeClass('selected');
    areas.find('ul[region_id='+clickedRegion.attr('region_id')+']').addClass('current');
    cities.find('ul.current').removeClass('current').find('li').show().filter('li.selected').removeClass('selected');
    cities.find('ul[region_id='+clickedRegion.attr('region_id')+']').addClass('current');

    clickedRegion.closest('table').find('div.area-center').html(cities.find('li[city_id='+clickedRegion.attr('reg_center')+']').text());
    clickedRegion.closest('table').find('div.area-center').attr('city_id', clickedRegion.attr('reg_center'));
}


DepartmentList.prototype.selectArea = function(evtObj){

    var clickedArea = $(evtObj.target);
    var areas = evtObj.data.ui.cityListCnt.find('td.areas:last ul.current');
    var cities = evtObj.data.ui.cityListCnt.find('td.cities:last ul.current');

    areas.find('li[area_id]').removeClass('selected');
    clickedArea.addClass('selected');
    cities.find('li[area_id='+clickedArea.attr('area_id')+']').show();
    cities.find('li[area_id!='+clickedArea.attr('area_id')+']').hide();
}


DepartmentList.prototype.selectCity = function(evtObj){

    var clickedCity = $(evtObj.target);
    var cities = clickedCity.closest('ul');
    var newCityId = clickedCity.attr('city_id');

    cities.find('li').removeClass('selected');
    clickedCity.addClass('selected');
    evtObj.data.ui.cityNavCnt.find('span.curr-city').html(clickedCity.text()).attr('city_id', newCityId);
    evtObj.data.ui.currCity = newCityId;
    evtObj.data.ui.getAdresses("", true);
    evtObj.data.ui.cityNavCnt.find('span.city-list-trigger').trigger("click");

    evtObj.data.ui.updateDeptList(evtObj.data.ui.currBank, evtObj.data.ui.currCity, evtObj.data.ui.pageLength, 1, 1);
}


DepartmentList.prototype.showRegionCities = function(evtObj){

    evtObj.data.ui.cityListCnt.find('td.cities ul.current li').show();
}


DepartmentList.prototype.selectPage = function(evtObj){

    var clickedLink = $(evtObj.target);
    var liCnt = clickedLink.closest('ul');
    var currentLink = liCnt.find('.current');
    var dept_ui = evtObj.data.ui;
    var page_set = 0;

    if(clickedLink.hasClass('passive') || clickedLink.hasClass('current'))
        return false;

    // определяем нужную страницу и, если необходимо, деактивируем стрелки  ←→
    var needPage = clickedLink.text();
    if(clickedLink.hasClass('prev')){
        if(currentLink.hasClass('first')){
            needPage = parseInt(currentLink.text(), 10) - 1;
            page_set = 1;
        }
        else{
            needPage = currentLink.prev().text();      
        }
        
        // если стрелка «вперед» не активна
        if(liCnt.find('li.next').hasClass('passive'))
            liCnt.find('li:last').removeClass('passive');

        if(parseInt(currentLink.text(), 10) == 2)
            clickedLink.addClass('passive');
    }
    else if(clickedLink.hasClass('next')){
        if(currentLink.next().hasClass('next-range')){
            needPage = parseInt(currentLink.text(), 10) + 1;
            page_set =1;
            // add command to generate pagination
        }
        else
            needPage = currentLink.next().text();

        // если стрелка «назад» не активна
        if(liCnt.find('li.prev').hasClass('passive'))
            liCnt.find('li.prev').removeClass('passive');
    }
    else if (clickedLink.hasClass('next-range')){
        needPage = parseInt(clickedLink.prev().text(), 10) + 1;
        page_set = 1;
    }
    else{
        if(!clickedLink.hasClass('first'))
            liCnt.find('li.prev').removeClass('passive');
        else if(parseInt(clickedLink.text(), 10) != 1)
            liCnt.find('li.prev').addClass('passive');

        if(clickedLink.hasClass('last'))
            page_set = 1;
    }

    dept_ui.updateDeptList(dept_ui.currBank, dept_ui.currCity, dept_ui.pageLength, needPage, page_set);
}

DepartmentList.prototype.updateDeptList = function(bank_id, city_id, page_length, page_num, page_set, adr_part){
    
    var dept_ui     = this;
    var liCnt       = dept_ui.pageNavCnt.find('ul');
    var currentLink = liCnt.find('li.current');
    var adr_part    = typeof adr_part == 'undefined' ? "" : (adr_part.indexOf('введите адрес') == 0 ? "" : adr_part);

    $.ajax({
        type : "GET",
        url : dept_ui.handlerUrl,
        data : {
            "cmd"          : "get-depts-page",
            "city_id"      : city_id,
            "bank_id"      : bank_id,
            "page_num"     : page_num,
            "page_length"  : page_length,
            "get_page_set" : page_set,
            "adr_part"     : adr_part,
            "types"        : dept_ui.typeSelector.getNeedTypesStr()
        },
        dataType : "json",
        success : function(response, status, xhr){

            if(response.success === "1") {

                var deptsCnt = dept_ui.deptListCnt.find('tbody');

                if(response.depts.length == 0){
                    dept_ui.deptListCnt.hide();
                    dept_ui.errMsgCnt.html("Мы не знаем ни одного отделения данного банка, в выбранном Вами городе.<br/>Попробуйте выбрать другой город.").show();

                    return false;
                }

                if(response.pages.length > 0){
                    liCnt.find('li').not(".prev").not(".next").remove();
                    var after = liCnt.find('li.prev');

                    if(response.pages.length == 1 && response.pages[0].content == "1"){
                        liCnt.find("li.prev").addClass('passive');
                        liCnt.find("li.next").addClass('passive');
                    }

                    for(var q=0; q < response.pages.length; q++){
                        var newItem = $('<li class="'+response.pages[q].p_class+'">'+response.pages[q].content+'</li>').insertAfter(after);
                        after = newItem;
                    }
                }
                else{
                    currentLink.removeClass('current');
                    liCnt.find('li:contains("'+page_num+'")').addClass('current');
                }

                
                deptsCnt.html("");
                $('#dept-row-template').tmpl(response.depts).appendTo(deptsCnt);
                dept_ui.errMsgCnt.hide();
                dept_ui.deptListCnt.show();

            }
            else if(response.error === "1") {
                alert("Произошла ошибка:\n"+response.notification);
            }
        },
        error : function(xhr, status, errorObj){
            alert("Произошла ошибка при обращении к серверу.");
        }
    });
}


/*
 * возвращает массив адресов, которые хотя бы частично совпадают с adr_part
 * @param {String} adr_part часть адреса для сличения
 * @param {boolean} addToAC добавлять ли данные к виджету
 */
DepartmentList.prototype.getAdresses = function(adr_part, addToAC){

    var dept_ui  = this;
    var adresses = new Array();

    $.ajax({
        type : "GET",
        url : dept_ui.handlerUrl,
        data : {
            "cmd"      : "get-adresses",
            "city_id"  : dept_ui.currCity,
            "bank_id"  : dept_ui.currBank,
            "adr_part" : adr_part
        },
        dataType : "json",
        success : function(response, status, xhr){
            

            if(response.success === "1" && response.adresses){
                adresses = Helper.array_unique(response.adresses);
                dept_ui.searchCnt.find('input').autocomplete("option", "source", adresses);
            }
            else if(response.error === "1")
                alert("Произошла ошибка:\n"+response.notification);

        },
        error : function(xhr, status, errorObj){
            alert("Произошла ошибка при обращении к серверу.");
        }
    });

    return adresses;
}

DepartmentList.prototype.triggerCityClick = function(evtObj){

    var cityName = $(this).prevAll('input:text').val().toLowerCase();
    var cities = evtObj.data.ui.cityListCnt.find('td.cities li');
    
    cities.each(function(index, elt){
        var item = $(elt);

        if($.trim(item.text().toLowerCase()) == $.trim(cityName)){
            item.click();
            return false;
        }
    });
}