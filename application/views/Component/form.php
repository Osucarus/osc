<!--
Note about modes :
Mode 0 : Request a new component. The real component doesn't exist. Warehouse need to buy a new one. (Accessed by Project)
Mode 1 : Add new component. The real component exist. (Accessed by Warehouse)
Mode 2 : Edit component. To edit the information or delete a component. (Accessed by Warehouse)
-->
<script>
$(document).ready(function(){
	$('#submit_req').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/add_component"?>";
		var data_send = classValueToJson('.inputan');
		data_send['location_id'] = 101; // Nanti diganti
		data_send['confirmation'] = 0; // Unconfirmed
		data_send['status'] = 2; // Requested
		$.post(uri, data_send, function(data, status){
			$('body').html(data);
		});
	});
	
	$('#add_new_com').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/add_component"?>";
		var data_send = classValueToJson('.inputan');
		data_send['location_id'] = 0;
		data_send['confirmation'] = 1;
		$.post(uri, data_send, function(data, status){
			$('body').html(data);
		});
	});
	
	$('#edit_com').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/edit_component"?>";
		var data = classValueToJson('.inputan');
		var com_id = $('#com_id').val();
		var data_send  = {
			data: data,
			id: com_id
		};
		$.post(uri, data_send, function(data, status){
			$('body').html(data);
		});
	});
	
	$('#del_com').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/del_component"?>";
		var com_id = $('#com_id').val();
		$.post(uri, { id: com_id }, function(data, status){
			$('body').html(data);
		});
	});
	
	<?php 
	if ($mode == 2){
		foreach($db as $column => $value){
			echo "$('#$column').val('$value');\n";
		};
	};
	?>
	
});
</script>
<form id='component_form'>
<input type='text' id='com_id' hidden>
<table>
<tr><td>Type</td><td>:</td><td><select class='inputan' id="type_id">
	<?php 
	$comtype = array("Component A", "Component B", "Component C", "Component D"); // Nanti diganti pake Master data
	foreach($comtype as $index => $type){
		echo "<option value='$index'>$type</option>\n";
	}
	?>
	<option value="o">Other</option>
</select>
</td></tr>
<?php 
// (Project) When sumbiting request, setting status is unable. Status will always be 'requested'
if ($mode != 0){
	echo "<tr><td>Status</td><td>:</td><td><select class='inputan' id='status'>";
	$status = array('Avaliable', 'Broken', 'Requested', 'Installed', 'Dismantle'); // Nanti diganti pake Master data
	foreach($status as $index => $type){
		echo "<option value='$index'>$type</option>\n";
	}
	echo "</select>
	</td></tr>";
}

// Edit mode will be able to see location id but can't change it
if ($mode == 2){
	echo "<tr><td>Location</td><td>:</td><td><input class='inputan' type='text' id='location_id' disabled></td></tr>";
};
?>
<tr><td>Serial Number</td><td>:</td><td><input class='inputan' type='text' id='serial_number'></td></tr>
<tr><td>Name</td><td>:</td><td><input class='inputan' id="name"></td></tr>
<tr><td>Nominal</td><td>:</td><td><input class='inputan' id="nominal"></td></tr>
<tr><td>Measure</td><td>:</td><td><input class='inputan' id="nominal_measure"></td></tr>
<tr><td>Description</td><td>:</td><td><textarea rows="6" cols="75" id="description" class='inputan'>
</textarea></td></tr>
<?php 
echo "<tr>";
switch ($mode) {
    case 0: // Request new component
        echo "<td><input type='button' id='sumbit_req' value='Request component'></td>";
        break;
    case 1: // Add new component
        echo "<td><input type='button' id='add_new_com' value='Add component'></td>";
        break;
    case 2: // Edit component
        echo "<td><input type='button' id='edit_com' value='Update component'></td>";
		echo "<td></td>";
		echo "<td><input type='button' id='del_com' value='Delete component'></td>";
        break;
};
echo "</tr>";
?>
</table>
</form>