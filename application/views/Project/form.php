<script>
$(document).ready(function(){
	$('#judul').html("Project form");
	$('#component').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		$('.modal').show();
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
		
		if($('#delproj').is(":checked")){
			if(confirm("Are you sure want to delete this project?")){
				var uri = "<?php echo site_url() . "/Project/del_project"?>";
				var data_send = {id: $('#pid').val()};
				$.post(uri, data_insert, function(data, status){
					$('#konten').html(data); 
				});
			}
		}else{
			var uri = "<?php echo site_url() . "/Project/edit_project"?>";
			var data_send = classValueToJson('.inputan');
			var pid = $('#pid').val();
			var data_insert = {
				data: data_send,
				id: pid
			};
			$.post(uri, data_insert, function(data, status){
				$('#konten').html(data); 
			});
		}
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
<style>
#div_form {
	background-color: white;
    width: 90%;
	height: auto;
    border: 2px double #0C358D;
	border-radius: 16px;
    margin-left: auto;
    margin-right: auto;
	padding: 25px;
}

#ComponentArea {
	background-color: white;
    width: 100%;
	height: auto;
    border: 2px double #0C358D;
	border-radius: 16px;
    margin-left: auto;
    margin-right: auto;
	padding: 5px;
}

#judul {
    text-align: center;
	margin-bottom: 12px;
}

td {
	padding-top: 5px;
	padding-bottom: 5px;
}
</style>
<div id="div_form">
<form id='project_form'>
<table>
<tr><td>Project ID</td><td>:</td><td><input class='inputanx' type="text" id="pid" disabled></td></tr>
<tr><td>Contract ID</td><td>:</td><td><input class='inputan' id="contract_id" disabled></td></tr>
<tr><td>Name</td><td>:</td><td><input class='inputan' type="text" id="name"></td></tr>
<tr><td>Start</td><td>:</td><td><input class='inputan datepicker' type="date" id="start"></td></tr>
<tr><td>Finish</td><td>:</td><td><input class='inputan datepicker' type="date" id="finish"></td></tr>
<tr><td>Status</td><td>:</td><td><select class='inputan' id="status">
<?php 
$mps = $this->db->query("select * from master_project_status")->result();
foreach($mps as $status){
	$id = $status->id;
	$name = $status->name;
	echo "<option value='$id'>$name</option>";
}
?></select>
</td></tr>
<tr><td>Note</td><td>:</td><td><textarea class='inputan' id='note' rows="6" cols="120%"></textarea></td></tr>
<tr <?php if ($db['pid'] == 0) { echo "hidden";}; ?>><td>Upload file report</td><td>:</td><td><input class='inputanx' type="file" id="file"></td></tr>
<tr height=25 <?php if ($db['pid'] == 0) { echo "hidden";}; ?>><td>Delete project</td><td>:</td><td><input type='checkbox' id='delproj'></td></tr>
<tr><td><input class="tombolan" id="edit_proj" type="button" value="Update"></td><td></td><td><input id="component" type="button" value="Show components" state="0" class="tombolan <?php if ($db['pid'] == 0) { echo " hidden";}; ?>"></td></tr>
</table>
</form>
</div>
<div id="display"></div>