function Helper(){}
Helper.in_array = function(needle, haystack, strict) {

	var found = false, key, strict = !!strict;

	for (key in haystack) {
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

Helper.array_unique = function (arr) {
    var tmp_arr = new Array();
    for (i = 0; i < arr.length; i++) {
        if (!Helper.in_array(arr[i],tmp_arr) ) {
            tmp_arr.push(arr[i]);
        }
    }
    return tmp_arr;
}

Helper.array_merge = function(){
    
    var finalArr = new Array();

    for(var q=0;q < arguments.length;q++){

        for(var w=0; w < arguments[q].length; w++)
            finalArr.push(arguments[q][w]);
    }
    
    return Helper.array_unique(finalArr);
}

Helper.array_append = function(recepient, donor){

    for(var q=0; q<donor.length; q++)
        recepient.push(donor[q]);

    return recepient;
}

