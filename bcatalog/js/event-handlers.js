/**
 * BCatalog UI interface class
 * @constructor
 * @param {jQuery} container common container
 * @param {jQuery} searchCnt contains the serch input and btns
 * @param {jQuery} cityNavCnt contains current city monitor & city list trigger btn
 * @param {jQuery} cityListCnt contains the list if the cities
 * @param {jQuery} alphaNavCnt contains aphabeth navigation elts
 * @param {jQuery} bankListCnt contains bank list
 * @param {jQuery} pageNavCnt contains pagination
 */
function BCatalog(container, searchCnt, cityNavCnt, cityListCnt, alphaNavCnt, bankListCnt, pageNavCnt){

    this.container = container;
    this.searchCnt = searchCnt;
    this.cityNavCnt = cityNavCnt;
    this.cityListCnt = cityListCnt;
    this.alphaNavCnt = alphaNavCnt;
    this.bankListCnt = bankListCnt;
    this.pageNavCnt = pageNavCnt;

}

BCatalog.prototype.init = function(settings){
    // add here all event handlers
    var BCatalogUI = this;

    this.cityNavCnt.find('span.city-list-trigger').bind('click', {ui:BCatalogUI}, this.toggleCityList);
    this.cityListCnt.find('span.close').bind('click', {ui:BCatalogUI}, this.toggleCityList);

    this.alphaNavCnt.find('li').bind('click', {ui:BCatalogUI}, this.alphaFilter);

    this.cityListCnt.find('td.regions li').bind('click', {ui:BCatalogUI}, this.selectRegion);
    this.cityListCnt.find('td.areas li').bind('click', {ui:BCatalogUI}, this.selectArea);
    this.cityListCnt.find('td.cities li').bind('click', {ui:BCatalogUI}, this.selectCity);
    this.cityListCnt.find('span.show-all').bind('click', {ui:BCatalogUI}, this.showRegionCities)
}


/**
 * отобразит список городов, если он скрыт и скроет в противном случае
 * @param {jQueryEvent} evtObj 
 */
BCatalog.prototype.toggleCityList = function(evtObj){

    if(evtObj.data.ui.cityListCnt.is(':visible'))
        evtObj.data.ui.cityListCnt.slideUp(400);
    else
        evtObj.data.ui.cityListCnt.slideDown(400);
}


/**
 * прячет все элементы списка, которые не начинаются с заданной буквы
 * @param {String} letter буква, относительно которой ведется сортировка
 */
BCatalog.prototype.alphaFilter = function(evtObj){

    var clickedItem = $(evtObj.target);

    // если фильтрация по текущей букве не имеет смысла
    if(!clickedItem.hasClass('variant'))
        return false;

    var letter = clickedItem.hasClass('first') ? null : clickedItem.text();
    var bankColumns = evtObj.data.ui.bankListCnt.find("tbody td.title-col");
    bankColumns.closest('tr').show();
    
    if(!letter)
        return false;
    
    for(var q=0;q<bankColumns.length;q++)
        if((bankColumns.eq(q).text()).search(new RegExp("^"+letter+".*$","gi")) == -1)
            bankColumns.eq(q).closest('tr').hide();

    // добавляем индикатор к букве, относительно которой произведена фильтрация
    clickedItem.closest('ul').find('li.selected').removeClass('selected');
    clickedItem.addClass('selected');

}

BCatalog.prototype.selectRegion = function(evtObj){

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

    clickedRegion.closest('table').find('div.area-center').html(clickedRegion.attr('reg_center'));
}



BCatalog.prototype.selectArea = function(evtObj){

    var clickedArea = $(evtObj.target);
    var areas = evtObj.data.ui.cityListCnt.find('td.areas:last ul.current');
    var cities = evtObj.data.ui.cityListCnt.find('td.cities:last ul.current');

    areas.find('li[area_id]').removeClass('selected');
    clickedArea.addClass('selected');
    cities.find('li[area_id='+clickedArea.attr('area_id')+']').show();
    cities.find('li[area_id!='+clickedArea.attr('area_id')+']').hide();
}


BCatalog.prototype.selectCity = function(evtObj){

    var clickedCity = $(evtObj.target);
    var cities = clickedCity.closest('ul');

    cities.find('li').removeClass('selected');
    clickedCity.addClass('selected');
    evtObj.data.ui.cityNavCnt.find('span.curr-city').html(clickedCity.text());
}

BCatalog.prototype.showRegionCities = function(evtObj){

    evtObj.data.ui.cityListCnt.find('td.cities ul.current li').show();
}
