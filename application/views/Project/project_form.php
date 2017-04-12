<script>
$(document).ready(function(){
	$('#component').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/installed"?>";
		var data_insert = {}; // Nanti diisi data dummy / sebenarnya
		$.post(uri, data_insert, function(data, status){
			$('#display').html(data); 
		});
	});
});
</script>
<form id='project_form'>
<table>
<tr><td>Project ID</td><td>:</td><td><input class='inputan' type="text" id="pid" disabled></td></tr>
<tr><td>Contract ID</td><td>:</td><td><input class='inputan' id="cid" disabled></td></tr>
<tr><td>Name</td><td>:</td><td><input class='inputan' type="text" id="name"></td></tr>
<tr><td>Start</td><td>:</td><td><input class='inputan' type="text" id="start"></td></tr>
<tr><td>Finish</td><td>:</td><td><input class='inputan' type="text" id="finish"></td></tr>
<tr><td>Status</td><td>:</td><td><select class='inputan' id="status">
<option value="0">Not started</option>
<option value="1">On going</option>
<option value="0">Finished</option></td></tr>
<tr><td>Upload file report</td><td>:</td><td><input class='inputan' type="file" id="file"></td></tr>
<tr><td><input id="update" type="submit" value="Update"></td><td></td><td><input id="component" type="button" value="Show components"></td></tr>
</table>
</form>
<div id="display"></div>