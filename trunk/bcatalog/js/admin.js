function AdminUI(settings){

    this.cityList = settings.cityList;
    this.handler  = typeof settings.handler == 'undefined' ? 'http://'+document.domain+':8888/admin-panel/request_handler.php' : settings.handler;
    this.imgSrc   = typeof settings.imgSrc == 'undefined' ? "http://"+document.domain+":8888/img/layout/" : settings.imgSrc;

    this.init();
    console.log('initialized');
}

AdminUI.prototype.init = function(){

    var admin_ui = this;
    console.log(document.domain+":8888/img/layout/");
    this.cityList.find('td.regions li').live('click', {ui:admin_ui}, this.selectRegion);
    this.cityList.find('td.areas li').live('click', {ui:admin_ui}, this.selectArea);
    this.cityList.find('td.cities li').live('click', {ui:admin_ui}, this.selectCity);
    this.cityList.find('span.show-all').bind('click', {ui:admin_ui}, this.showRegionCities);

    this.cityList.find('button.add').bind('click', {ui:admin_ui}, this.addItem);

    this.cityList.find('li').live('dblclick', {ui:admin_ui}, this.appendEditBlock);
    this.cityList.find('select').live('change', {ui:admin_ui}, function(){
        var selectList = $(this);
        selectList.closest('li').attr('selected_item', selectList.val());
    });

    $.ajaxSetup({
        url : this.handler,
        type : "GET",
        dataType : "json",
        error : this.requestErrHandler,
        beforeSend : function(){admin_ui.cityList.find('img.loader').show();},
        complete : function(){admin_ui.cityList.find('img.loader').hide();}
    });

    
}

AdminUI.prototype.selectRegion = function(evtObj){
    //console.log(evtObj.data.ui);
    var clickedRegion = $(this);
    var regions = evtObj.data.ui.cityList.find('td.regions:eq(1) ul');
    var areas = evtObj.data.ui.cityList.find('td.areas:eq(1)');
    var cities = evtObj.data.ui.cityList.find('td.cities:eq(1)');

    regions.find('li.selected').removeClass('selected');
    regions.find('li[region_id='+clickedRegion.attr('region_id')+']').addClass('selected');
    areas.find('ul.current').removeClass('current').find('li.selected').removeClass('selected');
    areas.find('ul[region_id='+clickedRegion.attr('region_id')+']').addClass('current');
    cities.find('ul.current').removeClass('current').find('li').show().filter('li.selected').removeClass('selected');
    cities.find('ul[region_id='+clickedRegion.attr('region_id')+']').addClass('current');
}


AdminUI.prototype.selectArea = function(evtObj){

    var clickedArea = $(this);
    var areas = evtObj.data.ui.cityList.find('td.areas:eq(1) ul.current');
    var cities = evtObj.data.ui.cityList.find('td.cities:eq(1) ul.current');

    areas.find('li[area_id]').removeClass('selected');
    clickedArea.addClass('selected');
    cities.find('li[area_id='+clickedArea.attr('area_id')+']').show();
    cities.find('li[area_id!='+clickedArea.attr('area_id')+']').hide();
}


AdminUI.prototype.selectCity = function(evtObj){

    var clickedCity = $(this);
    
    clickedCity.closest('ul').find('li').removeClass('selected');
    clickedCity.addClass('selected');
}


AdminUI.prototype.showRegionCities = function(evtObj){

    evtObj.data.ui.cityList.find('td.cities ul.current li').show();
}


AdminUI.prototype.appendEditBlock = function(evtObj){

    evtObj.data.ui.cityList.find('img.cancel').trigger('click');

    var cnt = $(this);
    var content = cnt.text();
    var src = evtObj.data.ui.imgSrc;

    var editBlock = $('<div class="edition">'+
                        '<input type="text" value="'+content+'"><br/>'+
                      '</div>');

    var selectList = evtObj.data.ui.generateSelectList(cnt);

    editBlock.append(selectList);
    editBlock.append('<div class="act"><img src="'+src+'ajax-loader.gif" class="loader" /><img class="accept" title="подтвердить изменения" src="'+src+'tick.png" /><img class="remove" title="удалить" src="'+src+'bin.png" /><img class="cancel" title="отмена" src="'+src+'cancel.png" /></div>');
    editBlock.click(function(evt){evt.stopPropagation();return false;});
    editBlock.dblclick(function(evt){evt.stopPropagation();return false;});
    editBlock.find("img.cancel").bind("click", {ui:evtObj.data.ui}, evtObj.data.ui.removeEditBlock);
    editBlock.find("img.remove").bind("click", {ui:evtObj.data.ui}, evtObj.data.ui.removeItem);
    editBlock.find("img.accept").bind("click", {ui:evtObj.data.ui}, evtObj.data.ui.editItem);
    cnt.attr('default_val', content).removeClass('selected').html("");
    editBlock.appendTo(cnt).find('select').trigger('change');
}

AdminUI.prototype.generateSelectList = function(clickedItem){

    var column = clickedItem.closest('td');
    var row = clickedItem.closest('tr');
    var selectList = $('<select></select>');

    if(column.hasClass('regions')){
        var region_id = clickedItem.attr('region_id');
        var cities = row.find('td.cities ul[region_id='+region_id+'] li');

        cities.each(function(index, element){
            var elt = $(element);
            var opt = $('<option>', {text:elt.text(), "value" : elt.attr("city_id")});

            if(elt.attr('city_id') == clickedItem.attr('reg_center'))
                opt.attr('selected', 'true');

            opt.appendTo(selectList);
        });
    }
    else if(column.hasClass('areas')){
        var region_id = clickedItem.closest('ul').attr('region_id');
        var regions = row.find('td.regions ul li');

        regions.each(function(index, element){
            var elt = $(element);
            var opt = $('<option>', {text:elt.text(), "value" : elt.attr("region_id")});

            if(elt.attr('region_id') == region_id)
                opt.attr('selected', 'true');

            opt.appendTo(selectList);
        });
    }
    else if(column.hasClass('cities')){
        var area_id = clickedItem.attr('area_id');
        var region_id = clickedItem.closest('ul').attr('region_id');
        var areas = row.find('td.areas ul[region_id='+region_id+'] li');

        areas.each(function(index, element){
            var elt = $(element);
            var opt = $('<option>', {text:elt.text(), "value" : elt.attr("area_id")});

            if(elt.attr('area_id') == area_id)
                opt.attr('selected', 'true');

            opt.appendTo(selectList);
        });
    }

    return selectList;
}

AdminUI.prototype.removeEditBlock = function(evtObj){
    var listItem = $(this).closest('li');
    listItem.html("").text(listItem.attr('default_val')).trigger('click');
}

AdminUI.prototype.removeItem = function(evtObj){

    var listItem = $(this).closest('li');
    if(!confirm("Точно удаляем «"+listItem.attr('default_val')+"» ?"))
        return false;

    var obj = evtObj.data.ui.getItemPrefix(listItem);
    var dataToSend = {
        "obj"     : obj,
        "cmd"     : "remove"
    };
    dataToSend[obj+"_id"] = listItem.attr(obj+'_id');

    $.ajax({
        data : dataToSend,
        success : function(response, status, xhr){
            if(response.success == "1")
                listItem.remove();
            else if(response.error == "1")
                alert("Произошла ошибка при обращении к серверу.\n"+response.notification);
        }
    });
}


AdminUI.prototype.editItem = function(evtObj){

    var listItem = $(this).closest('li');
    var obj = evtObj.data.ui.getItemPrefix(listItem);
    var dependsAttr = (obj == "region" ? "center_id" : (obj == "area" ? "region_id" : "area_id"));
    var dataToSend = {
        "obj"     : obj,
        "cmd"     : "edit"
    };
    
    dataToSend[obj+"_id"] = listItem.attr(obj+'_id');
    dataToSend[obj+"_name"] = listItem.find('input[type=text]').val();
    dataToSend[dependsAttr] = listItem.attr('selected_item');

    $.ajax({
        data : dataToSend,
        success : function(response, status, xhr){
            console.log(response);
            if(response.success == "1"){
                listItem.attr("default_val",listItem.find('input[type=text]').val());
                listItem.find('img.cancel').trigger('click');

                
            }
            else if(response.error == "1")
                alert("Произошла ошибка при обращении к серверу.\n"+response.notification);
        }
    });
}


/*
 * возвращает тиа объекта с которым работает (region|area|city)
 * @param {jQuery} item элемент списка (li) по которому был сделан клик
 */
AdminUI.prototype.getItemPrefix = function(item){

    var column = item.closest('td');

    if(column.hasClass("regions"))
        return "region";
    else if(column.hasClass("areas"))
        return "area";
    else if(column.hasClass("cities"))
        return "city";
    else
        return false;
}


AdminUI.prototype.requestErrHandler = function(xhr, status, errorObj){
    console.log("---");
    console.log(xhr);
    console.log(status);
    console.log(errorObj);
    console.log("---");
    //alert("Произошла ошибка при обращении к серверу.");
}


AdminUI.prototype.addItem = function(evtObj){

    var cell = $(this).closest('td');
    var obj = evtObj.data.ui.getItemPrefix($(this));
    var dataToSend = {
        "obj"     : obj,
        "cmd"     : "add"
    };

    dataToSend[obj+"_name"] = cell.find('input[type=text]').val();

    var tempId = 0;
    if(cell.hasClass('areas')){
        tempId = cell.closest('tbody').find('tr:eq(1) td.regions li.selected').attr('region_id');
        dataToSend["region_id"] = tempId ? tempId : 0;
    }
    else if(cell.hasClass('cities')){
        tempId = cell.closest('tbody').find('tr:eq(1) td.areas li.selected').attr('area_id');
        dataToSend["area_id"] = tempId ? tempId : 0;
    }

    $.ajax({
        data : dataToSend,
        success : function(response, status, xhr){
            console.log(response);
            if(response.success == "1"){

                var cellIndex = cell.closest('tr').find('td').index(cell);
                var newItem = $('<li '+obj+'_id="'+response.inserted_id+'">'+dataToSend[obj+"_name"]+'</li>');
                    console.log(newItem);
                if(cellIndex == 2){
                    newItem.attr('area_id', dataToSend.area_id);
                }
                console.log(cellIndex);
                cell.closest('tbody').find('tr:eq(1) td:eq('+cellIndex+') ul.current').append(newItem);
            }
            else if(response.error == "1")
                alert("Произошла ошибка при обращении к серверу.\n"+response.notification);
        }
    });

}