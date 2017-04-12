<script>

function typeChange(){
	var isi = $("#type").val();
	console.log(isi);
	$("#reqname").prop("value", $('#type option:selected').text());
	if (isi == 0){
		$("#reqname").prop("disabled", false);
	}else{
		$("#reqname").prop("disabled", true);
	};
};

</script>
<form id='component_req'>
<table>
<tr><td>Type</td><td>:</td><td><select class='inputan' id="type" onchange="typeChange()">
	<option value="1">Component Type A</option>
	<option value="2">Component Type B</option>
	<option value="3">Component Type C</option>
	<option value="4">Component Type D</option>
	<option value="0">Other</option>
</select>
</td></tr>
<tr><td>Name</td><td>:</td><td><input class='inputan' id="reqname" disabled></td></tr>
<tr><td>Nominal</td><td>:</td><td><input class='inputan' type="text" id="nominal"></td></tr>
<tr><td>Note</td><td>:</td><td><textarea rows="6" cols="75" id="not" class="inputan">
Write note here ....
</textarea></td></tr>
<tr><td><input type="submit" value="Submit Request"></td></tr>
</table>
</form>