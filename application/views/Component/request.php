<script>

function typeChange(){
	var isi = $("#type").val();
	$("#reqname").prop("value", $('#type option:selected').text());
	if (isi == 0){
		$("#reqname").prop("disabled", false);
	}else{
		$("#reqname").prop("disabled", true);
	};
};

$(document).ready(function(){
	$('#submitreq').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/newReq"?>";
		var data_insert = {};
		$.post(uri, data_insert, function(data, status){
			
		});
	});
	$("#reqname").prop("value", $('#type option:selected').text());
});
</script>
<form id='component_req'>
<input hidden class="req_input" id="project_id">
<table>
<tr><td>Type</td><td>:</td><td><select class='req_inputx' id="type" onchange="typeChange()">
	<option value="1">Component Type A</option>
	<option value="2">Component Type B</option>
	<option value="3">Component Type C</option>
	<option value="4">Component Type D</option>
	<option value="0">Other</option>
</select>
</td></tr>
<tr><td>Name</td><td>:</td><td><input class='req_input' id="reqname" disabled></td></tr>
<tr><td>Note</td><td>:</td><td><textarea rows="6" cols="75" id="note" class="req_input">
Write note here ....
</textarea></td></tr>
<tr><td><input type="submit" value="Submit Request" id="submitreq"></td></tr>
</table>
</form>