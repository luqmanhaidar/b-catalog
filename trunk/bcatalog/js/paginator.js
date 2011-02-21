function Paginator(settings){

    this.container = typeof settings.container == 'undefined' ?
                     $('<div/>', {"id":"pagination"}).appendTo("body") :
                     settings.container;

   this.pages = typeof settings.pages == 'undefined' ?
                new Array() :
                settings.pages;

   this.currentPage = null;
   this.generateContent(this.pages);
   this.init();
}

Paginator.prototype.init = function(){

    console.log('inition complete');
}

Paginator.prototype.generateContent = function(pagesArr){

    if(pagesArr.length == 0)
        return false;

    var pagesCnt = $('<ul/>');
    var prevClass = "prev" + pagesArr[0].p_class.indexOf('current') == -1 ? "" : " passive";
    var nextClass = "next" + pagesArr[pagesArr.length-1].p_class.indexOf('current') == -1 ? "" : " passive";

    $('<li/>', {html: "&larr;", "class": prevClass}).appendTo(pagesCnt);
    for(var q=0;q<pagesArr.length;q++){
        $('<li/>', {html: pagesArr[q].content, "class": pagesArr[q].p_class}).appendTo(pagesCnt);
        if(pagesArr[q].p_class.indexOf('current') != -1)
            this.currentPage = pagesArr[q].content;
    }
    $('<li/>', {html: "&rarr;", "class": nextClass}).appendTo(pagesCnt);
}

Pagination.prototype.toString = function(){

    var str = "";
    this.container.find('ul li').each(function(){
        var elt = $(this);
        str+=(elt.text()+":"+elt.attr('class')+" | ");
    });
    return str;
}