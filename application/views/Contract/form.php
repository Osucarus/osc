<?php if($mode == 0){
	echo "<title>Create contract</title>";
	$judul = "Create new contract";
} else {
	echo "<title>Update contract</title>";
	$judul = "Update contract";
}?>
<script>
$(document).ready(function(){
	$('#judul').html("<?php echo $judul;?>");
	$('#exe_contract').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var suichi = $('#contract_form').attr('mode');
		switch(suichi){
			case "0": // Insert mode
				addContract();
				break;
			case "1": // Update mode
				updateContract();
				break;
		}
	});
	
	$('#contract_proj').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		
		// Create a project
		if($(this).attr('proj_id') == ""){
			var uri = "<?php echo site_url() . "/Project/create"?>";
			$.post(uri, {contract_id: $('#id').val()}, function(data, status){
				$('#konten').html(data); 
				alert('project issued');
			});
			
		// View projects
		}else{
			var uri = "<?php echo site_url() . "/Project/view"?>";
			$.post(uri, {mode: 0, contract_id: $('#id').val()}, function(data, status){
				$('#konten').html(data); 
			});
		}
	});
	
	$('#del_contract').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var yn = confirm('Are you sure want delete this contract?');
		if(yn){
			var uri = "<?php echo site_url() . "/Contract/delete"?>";
			$.post(uri, {cont_id: $('#id').val()}, function(data, status){
				$('#konten').html(data); 
			});
		};
	});
	
	function updateContract(){
		var uri = "<?php echo site_url() . "/Contract/update"?>";
		var data_send = classValueToJson('.inputan');
		data_send.period = data_send.period + ' years';
		data_send.customer_id = /(\d+)-.*/.exec(data_send.customer_id2)[1];
		delete data_send['customer_id2'];
		var kontrak_id = $('#id').val();
		var data_insert = {
			data: data_send,
			id: kontrak_id
		};
		$.post(uri, data_insert, function(data, status){
			$('#konten').html(data); 
		});
	}
	
	function addContract(){
		var uri = "<?php echo site_url() . "/Contract/insert"?>";
		var data_send = classValueToJson('.inputan');
		data_send.period = data_send.period;
		data_send.customer_id = /(\d+)-.*/.exec(data_send.customer_id2)[1];
		delete data_send['customer_id2'];
		$.post(uri, data_send, function(data, status){
			$('#konten').html(data); 
		});
	}
	
	<?php
	$edit = isset($db);
	if ($edit){
		foreach ($db as $key => $value) {
			echo "$('#$key').val('$value');";
		}
	}
	?>
	
	if ($('#contract_form').attr('mode') == 1){
		var new_val = $('#period').val();
		new_val = /(\d+)\s+.*/i.exec(new_val)[1];
		$('#period').val(new_val);
	}
	
	//$('#rfs').datepicker();
})
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

<form id='contract_form' mode='<?php echo $mode?>'>
<table>
<tr><td>Customer ID</td><td class='tdinput'><input class='inputan' list="CustomerList" id="customer_id2" placeholder="Select customer"></td></tr>
<tr><td>Site Name</td><td class='tdinput'><input class='inputan' type="text" id="name"></td></tr>
<tr><td>Origin</td><td class='tdinput'><input class='inputan' type="text" id="origin"></td></tr>
<tr><td>Destination</td><td class='tdinput'><input class='inputan' type="text" id="destination"></td></tr>
<tr><td>Group ID</td><td class='tdinput'><input class='aidi' type="text" id="group" disabled></td></tr>
<tr><td>Product ID</td><td class='tdinput'><input class='aidi' type="text" id="product" disabled></td></tr>
<tr><td>Service ID</td><td class='tdinput'><input class='aidi' type="text" id="service" disabled></td></tr>
<tr><td>Technical Authorized Officer</td><td class='tdinput'><input class='inputan' type="text" id="tao"></td></tr>
<tr><td>Connection Type</td><td class='tdinput'><input class='inputan' type="text" id="connection"></td></tr>
<tr><td>Access (In/Out)</td><td class='tdinput'><input class='inputan' type="text" id="bw_access"></td></tr>
<tr><td>CIR (In/Out)</td><td class='tdinput'><input class='inputan' type="text" id="bw_cir"></td></tr>
<tr><td>Burst (In/Out)</td><td class='tdinput'><input class='inputan' type="text" id="bw_burst"></td></tr>
<tr><td>RFS</td><td class='tdinput'><input class='inputan' type="date" id="rfs"></td></tr>
<tr><td>Contract Period</td><td class='tdinput'><input class="inputan" type="text" id="period" placeholder="Write in month(s)"></td></tr>
<tr><td>Remarks</td><td class='tdinput'><textarea class="inputan" id="remarks" rows="6" cols="100%"></textarea></td></tr>
</table>
<input hidden id="id" class="inputanx">
<input hidden id="customer_id" class="inputan">
<input hidden id="group_id" class="inputan">
<input hidden id="product_id" class="inputan">
<input hidden id="service_id" class="inputan">
<br>

<!-- ############## Create / Update button ############ -->
<input class="tombolan" type="button" value='<?php 
if($mode == 0){
	echo "Create new contract";
} else {
	echo "Update contract";
}?>' id="exe_contract">

<!-- ########### Delete contract ########### -->

<input class="tombolan<?php if ($mode == 0){ echo " hidden"; }?>" type="button" value='Delete contract' id="del_contract">

<!-- ########### View / Issue project button ########### -->
<input class="tombolan<?php if ($mode == 0){ echo " hidden"; }?>" id="contract_proj" type="button" value='<?php 
if ($mode == 1){
	if (count($proj) == 1){
		echo "View Projects";
	}else{
		echo "Issue a Project";
	}
}
?>' proj_id='<?php if(isset($proj) && count($proj) == 1) { echo $proj[0]->id; };?>'>

<!-- End of button -->
</form>

<datalist id="CustomerList">
<?php
foreach($custom as $c){
	$text = $c->data_customer;
	echo "<option>$text</option>";
}
?>
</datalist>