function reverseDate(x){
	has = x.split('-');
	hasil = has[2]+"-"+has[1]+"-"+has[0];
	return hasil;
}

function reformatDate(x){
	has = x.split('/');
	hasil = has[2]+"-"+has[0]+"-"+has[1];
	console.log(hasil);
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

function classValueToJson2(className,customAttr){
    var hasil = "{";
        $(className).each(function(){
            hasil+= "\""+$(this).attr(customAttr)+"\" : \""+$(this).val()+"\",";
        });
        hasil = hasil.slice(',',-1);
        hasil += "}";
        hasil = JSON.parse(hasil);
        return hasil;
}

function radioFill(className,value){
	$('.'+className).each(function(){
		var has = $(this).val();
		if (has == value){
			this.setAttribute('checked','');
		}
	});
}

function radioPick(x){
	var kelas = $(x).attr('class');
	$('.'+kelas).each(function(){
		this.removeAttribute('checked');
	})
	x.setAttribute('checked','');
}

function radioSubmit(className){
	var has;
	$('.'+className).each(function(){
		if (this.hasAttribute('checked')) {
			has = this.getAttribute('value');
		}
	})
	$('#hasil').html(has);
	return has;
}

function jsonMerge(json1,json2){
	for(var kunci in json2){
		json1[kunci] = json2[kunci];
	}
	return json1;
}

function debug2(){
	console.log('debug 2');
}

function debug(){
	console.log("This line is executed");
}