function reverseDate(x){
	has = x.split('-');
	hasil = has[2]+"-"+has[1]+"-"+has[0];
	return hasil;
}

function classValueToJson(className){
    var hasil = "{";
        $(className).each(function(){
            hasil+= "\""+$(this).attr('id')+"\" : \""+$(this).val()+"\",";
        });
        hasil = hasil.slice(',',-1);
        hasil += "}";
        hasil = JSON.parse(hasil);
        return hasil;
	}