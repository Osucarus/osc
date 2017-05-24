<?php $this->load->view('Loader');?>

<script>

var coba = new XMLHttpRequest();

coba.open("GET",'https://202.43.73.157/api/table.xml?content=sensortree',true);

coba.onreadystatechange = function (){
	if(coba.readyState == 4 & coba.status == 200){
		var has = coba.responseXML;
		console.log(has);
	}
}
coba.send(null);
console.log(coba);
</script>