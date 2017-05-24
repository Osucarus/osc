<script>
$(document).ready(function(){
	switch($('#ComponentArea').attr('value')){
		case "0":
		case "5":
		case "6":
			$('#judul').html("Components table");
			break;
	}
	//======================================================================================
	// Warehouse
	//======================================================================================
	// (Warehouse) Add new item
	$('#add_new').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/form"?>";
		$.post(uri, { mode: 1 }, function(data, status){
			$('#konten').html(data); 
		});
	});
	
	// (Warehouse) Confirming the requested item
	$('#send_button').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/confirm"?>";
		$.post(uri, { centang: hidden_json }, function(data, status){
			$('#konten').html(data); 
		});
	});
	
	$('.table_button').each(function(){
		$(this).click(function(evt){
			evt.preventDefault(); // Biar gak ke refresh
			var uri = "<?php echo site_url() . "/Component/form"?>";
			var com_id = $(this).attr('realid');
			$.post(uri, { mode: 2, id: com_id }, function(data, status){
				$('#konten').html(data); 
			});
		});
	});
	//======================================================================================
	// Project
	//======================================================================================
	// (Project) Request from existting item
	$('#send_request').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/request_component"?>";
		$.post(uri, { centang: hidden_json, proj_id: 101 }, function(data, status){
			$('#ComponentArea').html(data); 
		});
		
	});
	
	//--------------------------------------------------------------------
	// (Project) Request a new item. Warehouse need to purchase new item
	//--------------------------------------------------------------------
	$('#request_new').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/form"?>";
		$.post(uri, { mode: 0 }, function(data, status){
			$('#ComponentArea').html(data); 
		});
	});
	
	//--------------------------------------------------------------------
	// Dismantle, change state to 1
	//--------------------------------------------------------------------
	$('#dismantle_button').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var mode = $('#ComponentArea').attr('value');
		if (mode == 2){
			$('#ComponentArea').attr("value",1);
			$('#update_button').val("Dismantle");
			$('.check_label').each(function(){
				$(this).html("Dismantle");
			});
		}else if(mode == 3 || mode == 4){
			var uri = "<?php echo site_url() . "/Component/installed"?>";
			var pid = $('#pid').val();
			var data_insert = { proj_id: pid, mode: 1 };
			$.post(uri, data_insert, function(data, status){
				$('#display').html(data); 
			});
		}
	});
	
	//--------------------------------------------------------------------
	// Cancel Dismantle, change state to 2
	//--------------------------------------------------------------------
	$('#cancel_dismantle').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var mode = $('#ComponentArea').attr('value');
		if (mode == 1){
			$('#ComponentArea').attr("value",2);
			$('#update_button').val("Cancel Dismantle");
			$('.check_label').each(function(){
				$(this).html("Cancel Dismantle");
			});
		}else if (mode == 3 || mode == 4){
			var uri = "<?php echo site_url() . "/Component/installed"?>";
			var pid = $('#pid').val();
			var data_insert = { proj_id: pid, mode: 2 };
			$.post(uri, data_insert, function(data, status){
				$('#display').html(data); 
			});
		}
	});
	
	//--------------------------------------------------------------------
	// Request component, change state to 3
	//--------------------------------------------------------------------
	$('#request_exist').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/available"?>";
		$.post(uri, {}, function(data, status){
			$('#display').html(data); 
		});
	});
	
	//--------------------------------------------------------------------
	// Cancel Request, change state to 4
	//--------------------------------------------------------------------
	$('#cancel_req').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/requested"?>";
		var pid = $('#pid').val();
		var data_insert = { proj_id: pid, };
		$.post(uri, data_insert, function(data, status){
			$('#display').html(data); 
		});
	});
	
	//--------------------------------------------------------------------
	// Update things based on state 
	// 1: change item state from installed to dismantle
	// 2: change item state from dismantle to installed
	// 3: change item state from avaliable to requested
	// 4: change item state from requested to avaliable
	//--------------------------------------------------------------------
	$('#update_button').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "";
		var suichi = $('#ComponentArea').attr('value');
		switch(suichi){
			case "1": // Dismantle
				var uri = "<?php echo site_url() . "/Component/dismantling"?>";
				break;
			case "2": // Cancel dismantle
				var uri = "<?php echo site_url() . "/Component/cancel_dismantle"?>";
				break;
			case "3": // Request
				var uri = "<?php echo site_url() . "/Component/request_components"?>";
				break;
			case "4": // Cancel request
				var uri = "<?php echo site_url() . "/Component/cancel_request"?>";
				break;
		};
		var pid = $('#pid').val();
		var data_send = { centang: hidden_json, proj_id: pid };
		$.post(uri, data_send, function(data, status){
			$('#display').html(data); 
		});
		hidden_json = {};
	});
	
	$('#notif_req').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/allRequested"?>";
		$.post(uri, {}, function(data, status){
			$('#konten').html(data); 
		});
	});
	
	$('#notif_dis').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/allDismantle"?>";
		$.post(uri, {}, function(data, status){
			$('#konten').html(data); 
		});
	});
	
	$('#show_all').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/view"?>";
		$.post(uri, {mode: 0}, function(data, status){
			$('#konten').html(data); 
		});
	});
	//======================================================================================
	// General
	//======================================================================================
	$('#table_com').DataTable();
	
	$('.column-no-1').each(function(){
		$(this).click(function(evt){ 
			evt.preventDefault();
			var aidi = $(this).attr('id');
			var aidi = aidi.split('-');
			var aidi = aidi[1];
			var aidi = "button-"+aidi;
			var aidi = $('#' + aidi).attr('realid');
			change_location(aidi);
		});
	});
});

function change_location(com_id){
	var uri = "<?php echo site_url() . "/Project/view_radio"?>";
	$.post(uri, {com_id: com_id}, function(data, status){
		$('#konten').html(data); 
	});
}
</script>
<style>
.tombolan {
	margin: 2px;
}

.column-no-1 {
	text-align: center;
	vertical-align: bottom;
}

.column-no-1:hover {
	background-color: #FFF7CE;
}

.gelow {
  background-color: #004A7F;
  -webkit-border-radius: 10px;
  border-radius: 10px;
  border: none;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-block;
  font-family: Arial;
  font-size: 20px;
  padding: 5px 10px;
  text-align: center;
  text-decoration: none;
}
@-webkit-keyframes glowing {
  0% { background-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
  50% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FF0000; }
  100% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FFFFFF; }
}

@-moz-keyframes glowing {
  0% { background-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
  50% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FF0000; }
  100% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FFFFFF; }
}

@-o-keyframes glowing {
  0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
  50% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FF0000; }
  100% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FFFFFF; }
}

@keyframes glowing {
  0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
  50% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FF0000; }
  100% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FFFFFF; }
}

.gelow {
  -webkit-animation: glowing 1000ms infinite;
  -moz-animation: glowing 1000ms infinite;
  -o-animation: glowing 1000ms infinite;
  animation: glowing 1000ms infinite;
}

.button {
  color: white;
  display: inline-block; /* Inline elements with width and height. TL;DR they make the icon buttons stack from left-to-right instead of top-to-bottom */
  position: relative; /* All 'absolute'ly positioned elements are relative to this one */
  padding: 2px 2px; /* Add some padding so it looks nice */
}

/* Make the badge float in the top right corner of the button */
.badge {
  background-color: #fa3e3e;
  border-radius: 6px;
  color: white;
 
  padding: 1px 3px;
  font-size: 13px;
  
  position: absolute; /* Position the badge within the relatively positioned button */
  top: 0;
  right: 0;
}

table {
	font-size: 13px;
}

table.dataTable thead, table.dataTable tfoot {
	font-size: 12px;
}
</style>
<?php 
echo "<div id='ComponentArea' value='$mode'>";
switch ($mode) {
	case 0: // Warehouse view (Initial)
		echo "<input type='button' class='tombolan' value='Add new component' id='add_new'>";
		echo "<input type='button' class='tombolan' value='Confirm components' id='send_button'>";
		$jumlah = $notif_dis->jumlah;
		if ($jumlah == 0){
			$hidden = " hidden";
		}else{
			$hidden = "";
		}
		echo "<div style='float: right'>
		<div class='button'><input type='button' class='tombolan' value='Dismantle' id='notif_dis'>
		<span class='badge gelow$hidden'>$jumlah</span></div>";
		$jumlah = $notif_req->jumlah;
		if ($jumlah == 0){
			$hidden = " hidden";
		}else{
			$hidden = "";
		}
		echo "<div class='button'><input type='button' class='tombolan' value='Request' id='notif_req'>
		<span class='badge gelow$hidden'>$jumlah</span></div></div>";
		$this->bs->datatable_edit_and_check('table_com', $db);
		break;
	case 1: // Project view (Dismantle state)
		echo "<strong>Installed Components</strong><br>";
		echo "<input type='button' class='tombolan' value='Dismantle component' id='dismantle_button'>";
		echo "<input type='button' class='tombolan' value='Cancel Dismantle' id='cancel_dismantle'>";
		echo "<input type='button' class='tombolan' value='Request components' id='request_exist'>";
		echo "<input type='button' class='tombolan' value='Cancel Requests' id='cancel_req'>";
		$this->bs->datatable_checker('table_com', $db, array("vocab_check" => "Dismantle"));
		echo "<input type='button' class='tombolan' value='Dismantle' id='update_button'>";
		break;
	case 2: // Project view (Cancel dismantle state)
		echo "<strong>Installed Components</strong><br>";
		echo "<input type='button' class='tombolan' value='Dismantle component' id='dismantle_button'>";
		echo "<input type='button' class='tombolan' value='Cancel Dismantle' id='cancel_dismantle'>";
		echo "<input type='button' class='tombolan' value='Request components' id='request_exist'>";
		echo "<input type='button' class='tombolan' value='Cancel Requests' id='cancel_req'>";
		$this->bs->datatable_checker('table_com', $db, array("vocab_check" => "Cancel Dismantle"));
		echo "<input type='button' class='tombolan' value='Cancel dismantle' id='update_button'>";
		break;
	case 3: // Project view (Request new components state)
		echo "<strong id='table_label'>Request Components</strong><br>";
		echo "<input type='button' class='tombolan' value='Dismantle component' id='dismantle_button'>";
		echo "<input type='button' class='tombolan' value='Cancel Dismantle' id='cancel_dismantle'>";
		echo "<input type='button' class='tombolan' value='Request components' id='request_exist'>";
		echo "<input type='button' class='tombolan' value='Cancel Requests' id='cancel_req'>";
		$this->bs->datatable_checker('table_com', $db, array("vocab_check" => "Request"));
		echo "<input type='button' class='tombolan' value='Request components' id='update_button'>";
		echo "<input type='button' class='tombolan' value='Request new component' id='request_new'>";
		break;
	case 4: // Project view (Cancel request state)
		echo "<strong id='table_label'>Cancel requests</strong><br>";
		echo "<input type='button' class='tombolan' value='Dismantle component' id='dismantle_button'>";
		echo "<input type='button' class='tombolan' value='Cancel Dismantle' id='cancel_dismantle'>";
		echo "<input type='button' class='tombolan' value='Request components' id='request_exist'>";
		echo "<input type='button' class='tombolan' value='Cancel Requests' id='cancel_req'>";
		$this->bs->datatable_checker('table_com', $db, array("vocab_check" => "Cancel Request"));
		echo "<input type='button' class='tombolan' value='Cancel Request' id='update_button'>";
		break;
	case 5: // Project View (read-only)
		$this->bs->datatable_plain('table_com', $db);
		break;
	case 6: // View Notif (belom kelar)
		echo "<input type='button' class='tombolan' value='Confirm components' id='send_button'>";
		echo "<input type='button' class='tombolan' value='Show all components' id='show_all' style='float: right'>";
		$this->bs->datatable_edit_and_check('table_com', $db);
		break;
}
echo "</div>";
echo "<div id='display'></div>";
?>