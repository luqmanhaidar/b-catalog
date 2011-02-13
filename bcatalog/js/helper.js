function Helper(){}
Helper.in_array = function(needle, haystack, strict) {

	var found = false, key, strict = !!strict;

	for (key in haystack) {
        console.log(key);
		if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
			found = true;
			break;
		}
	}

	return found;
}


/**
 * возвращает HTML содержимое каждого из элементов полученного набора в виде массива
 * использовано для получения списков jq autocomplete widjet
 * @param {jQuery} donorElts коллекция элементов, содержимое котрых необходимо получить
 */
Helper.getInnerHTMLToArr = function(donorElts){

    if(typeof donorElts == 'undefined')
        return false;

    var innerHTMLArr = new Array();

    donorElts.each(function(index, elt){
        innerHTMLArr.push(elt.innerHTML);
    });

    return innerHTMLArr;
}

Helper.empty = function empty( mixed_var ) {

	return ( mixed_var === "" || mixed_var === 0   || mixed_var === "0" || mixed_var === null  || mixed_var === false );
}
