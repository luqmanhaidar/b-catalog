function TypeSelector(settings){

    this.container = settings.container ? settings.container : $(document).find('div.dept-class-nav').eq(0);
    this.needTypes = new Array();

    this.init();

}

TypeSelector.prototype.init = function(){

    this.needTypes.push("1","2","3","4","5");
    this.container.find('input.all').bind('change', {ui:this}, function(evtObj){
        var box = $(this);
        
        if(box.attr('checked')){
            box.nextAll(':not(:checked)').attr('checked','checked');
            evtObj.data.ui.needTypes = new Array("1", "2", "3", "4", "5");
        }
        else{
            box.nextAll(':checked').removeAttr('checked');
            box.nextAll(':checkbox:first').attr('checked', 'checked');
            evtObj.data.ui.needTypes = new Array("1");
        }
    });
    this.container.find('input:checkbox:not(.all)').bind('change', {ui:this}, function(evtObj){
        if(evtObj.data.ui.container.find('input:checked:not(.all)').length != 5)
            evtObj.data.ui.container.find('input.all').eq(0).removeAttr('checked');
        else
            evtObj.data.ui.container.find('input.all').eq(0).attr('checked', 'checked');

    });
}

TypeSelector.prototype.getNeedTypesStr = function(){
    if(!this.container.find('input.all').eq(0).attr('checked')){

        var tempArr = new Array();
        this.container.find('input:checked:not(.all)').each(function(index, elt){
           tempArr.push($(elt).val());
        });
        this.needTypes = tempArr;
    }

    return this.needTypes.join('|');
}