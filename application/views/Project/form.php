<script>
$(document).ready(function(){
	$('#component').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var state = $('#component').attr('state');
		if (state == 0){
			$('#component').prop('value','Hide Components');
			$('#component').attr('state',1);
			var uri = "<?php echo site_url() . "/Component/installed"?>";
			var pid = $('#pid').val();
			var data_insert = { proj_id: pid, mode: 1 };
			$.post(uri, data_insert, function(data, status){
				$('#display').html(data); 
			});
		}else{
			$('#component').prop('value','Show Components');
			$('#component').attr('state',0);
			$('#display').html(''); 
		}
	});
	
	$('#edit_proj').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Project/edit_project"?>";
		var data_send = classValueToJson('.inputan');
		var pid = $('#pid').val();
		var data_insert = {
			data: data_send,
			id: pid
		};
		$.post(uri, data_insert, function(data, status){
			$('body').html(data); 
		});
	});
	
	<?php
	$edit = isset($db);
	if ($edit){
		foreach ($db as $key => $value) {
			echo "$('#$key').val('$value');";
		}
	}
	?>
	
});
</script>
<form id='project_form'>
<table>
<tr><td>Project ID</td><td>:</td><td><input class='inputanx' type="text" id="pid" disabled></td></tr>
<tr><td>Contract ID</td><td>:</td><td><input class='inputan' id="contract_id" disabled></td></tr>
<tr><td>Name</td><td>:</td><td><input class='inputan' type="text" id="name"></td></tr>
<tr><td>Start</td><td>:</td><td><input class='inputan' type="text" id="start" disabled></td></tr>
<tr><td>Finish</td><td>:</td><td><input class='inputan' type="text" id="finish" disabled></td></tr>
<tr><td>Status</td><td>:</td><td><select class='inputan' id="status">
<option value="0">Not started</option>
<option value="1">On going</option>
<option value="2">Finished</option></td></tr>
<tr><td>Note</td><td>:</td><td><textarea class='inputan' id='note' rows="6" cols="75"></textarea></td></tr>
<tr><td>Upload file report</td><td>:</td><td><input class='inputanx' type="file" id="file"></td></tr>
<tr><td><input id="edit_proj" type="button" value="Update"></td><td></td><td><input id="component" type="button" value="Show components" state="0"></td></tr>
</table>
</form>
<div id="display"></div>