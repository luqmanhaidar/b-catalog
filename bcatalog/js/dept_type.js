function TypeSelector(settings){

    this.container = settings.container ? settings.container : $(document).find('div.dept-class-nav').eq(0);
    this.needTypes = new Array();


    this.init();

}

TypeSelector.prototype.init = function(){

    this.container.find('input:checkbox:not(.all)').bind('click', {ui:this}, this.updateNeedTypes);
    this.container.find('input.all').bind('click', {ui:this}, function(evtObj){
        var box = $(this);

        if(box.is(':not(:checked)')){
            box.nextAll(':not(:checked)').attr('checked','checked');
            evtObj.data.ui.needTypes = new Array("1", "2", "3", "4", "5");
        }
        else{
            box.nextAll(':checked').removeAttr('checked');
            box.nextAll(':checkbox:first').attr('checked', 'checked');
            evtObj.data.ui.needTypes = new Array("1");
        }
    });
    this.container.find('span.title').click(function(){
       $(this).prev().click();
    });
}

TypeSelector.prototype.updateNeedTypes = function(evtObj){

    var ui = evtObj.data.ui;
    var box = $(this);

    if(box.not(':checked') && !Helper.in_array(box.val(), ui.needTypes)){
        ui.needTypes.push(box.val());
        ui.container.find('input.all').removeAttr('checked');
    }
    else if(box.is(':checked') && Helper.in_array(box.val(), ui.needTypes)){
        for (var i = 0; i < ui.needTypes.length; i++) {
            if (ui.needTypes[i] == box.val()) {
                ui.needTypes.splice(i,1);
                break;
            }
        }

        if(ui.needTypes.length == 0)
            ui.container.find('input:checkbox:not(.all)').eq(0).trigger('click');
    }
}