<!--
Note about modes :
Mode 0 : Request a new component. The real component doesn't exist. Warehouse need to buy a new one. (Accessed by Project)
Mode 1 : Add new component. The real component exist. (Accessed by Warehouse)
Mode 2 : Edit component. To edit the information or delete a component. (Accessed by Warehouse)
-->
<script>
$(document).ready(function(){
	switch($('#exe_button').attr('mode')){
		case "0":
			$('#judul2').html("<strong>Request component form</strong>");
			break;
		case "1":
			$('#judul').html("Add New Component");
			break;
		case "2":
			$('#judul').html("Edit Component");
			break;
	}
	
	$('#exe_button').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var suichi = $('#exe_button').attr('mode');
		switch(suichi){
			case "0":
				submit_req();
				break;
			case "1":
				add_new_com();
				break;
			case "2":
				edit_com();
				break;
		}
	});	
	
	function submit_req(){
		var uri = "<?php echo site_url() . "/Component/add_component"?>";
		var data_send = classValueToJson('.input_com');
		data_send['location_id'] = $('#pid').val();
		data_send['confirmation'] = 0; // Unconfirmed
		data_send['status'] = 2; // Requested
		$.post(uri, data_send, function(data, status){
			//$('#debug_div').html(data);
			var uri2 = "<?php echo site_url() . "/Component/installed"?>";
			var pid = data_send['location_id'];
			var data_insert = { proj_id: pid, mode: 1 };
			$.post(uri2, data_insert, function(data, status){
				$('#display').html(data); 
			});
		});
	}
	
	function add_new_com(){
		var uri = "<?php echo site_url() . "/Component/add_component"?>";
		var data_send = classValueToJson('.input_com');
		data_send['location_id'] = 0;
		data_send['confirmation'] = 1;
		$.post(uri, data_send, function(data, status){
			$('#konten').html(data);
		});
	}
	
	function edit_com(){
		var uri = "<?php echo site_url() . "/Component/edit_component"?>";
		var data = classValueToJson('.input_com');
		var com_id = $('#com_id').val();
		var data_send  = {
			data: data,
			id: com_id
		};
		$.post(uri, data_send, function(data, status){
			$('#konten').html(data);
		});
	}
	
	$('#debug_button').click(function(evt){
		$('#location_id').prop('disabled', false);
		$('#debug_row').prop('hidden', false);
	});
	
	<?php 
	if ($mode == 2){
		foreach($db as $column => $value){
			echo "$('#$column').val('$value');\n";
		};
	};
	?>
	
})

function del_com(){
	if(confirm("Are you sure want to delete this component?")){
		var uri = "<?php echo site_url() . "/Component/del_component"?>";
		var com_id = $('#com_id').val();
		$.post(uri, { id: com_id }, function(data, status){
			$('#konten').html(data);
		});
	}
};
</script>
<style>
#konten {
	background-color: white;
    width: 80%;
	height: auto;
    border: 2px double #0C358D;
	border-radius: 16px;
    margin-left: auto;
    margin-right: auto;
	padding: 25px;
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
<div style="text-align: center; font-size: 16px" id="judul2"></div>
<form id='component_form'>
<input type='text' id='com_id' class='hidden'>
<table>
<tr><td>Type</td><td class='tdinput'><select class='input_com' id="type_id">
	<?php 
	$comtype = $this->db->query("select * from master_comtype order by id")->result();
	foreach($comtype as $type){
		$id = $type->id;
		$name = $type->name;
		echo "<option value='$id'>$name</option>\n";
	}
	?>
</select>
</td></tr>
<?php 
// (Project) When sumbiting request, setting status is unable. Status will always be 'requested'
if ($mode != 0){
	echo "<tr><td>Status</td><td class='tdinput'><select class='input_com' id='status'>";
	$ms = $this->db->query("select * from master_status")->result();
	foreach($ms as $status){
		$id = $status->id;
		$name = $status->name;
		echo "<option value='$id'>$name</option>\n";
	}
	echo "</select>
	</td></tr>";
}
?>
<tr><td>Role</td><td class='tdinput'><select class='input_com' id="role">
	<?php 
	$role = $this->db->query("select * from master_role order by id")->result();
	foreach($role as $type){
		$id = $type->id;
		$name = $type->name;
		echo "<option value='$id'>$name</option>\n";
	}
	?>
</select>
</td></tr>
<?php
// Edit mode will be able to see location id but can't change it
if ($mode == 2){
	echo "<tr><td>Location</td><td class='tdinput'><input class='input_com' type='text' id='location_id' disabled></td></tr>";
	echo "<tr id='debug_row' hidden><td>Confirmation</td><td><input class='input_com' type='text' id='confirmation'></td></tr>";
};
?>
<tr><td>PO Number</td><td class='tdinput'><input class='input_com' type='text' id='po_number'></td></tr>
<tr><td>Serial Number</td><td class='tdinput'><input class='input_com' type='text' id='serial_number'></td></tr>
<tr><td>Name</td><td class='tdinput'><input class='input_com' id="name"></td></tr>
<tr><td>Nominal</td><td class='tdinput'><input class='input_com' id="nominal"></td></tr>
<tr><td>Measure</td><td class='tdinput'><input class='input_com' id="nominal_measure"></td></tr>
<tr><td>Description</td><td class='tdinput'><textarea rows="6" cols="106%" id="description" class='input_com'>
</textarea></td></tr>
<tr><td><input type='button' class='tombolan' id='exe_button' value='
<?php 
switch ($mode) {
    case 0: // Request new component
        echo "Request component";
        break;
    case 1: // Add new component
        echo "Add component";
        break;
    case 2: // Edit component
        echo "Update component";
};
?>' mode='<?php echo "$mode"?>'>
</td><td class='tdinput'><input type='button' class='tombolan<?php if ($mode != 2) {echo " hidden";}?>' onclick="del_com()" id='delcom' value='Delete component'></td></tr>
<tr><td class='tdinput'><input type='button' value='debug mode' id='debug_button' hidden></td></tr>
</table>
</form>
<div id='debug_div'></div>