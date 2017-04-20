<script>
$(document).ready(function(){
	//======================================================================================
	// Warehouse
	//======================================================================================
	// (Warehouse) Add new item
	$('#add_new').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/form"?>";
		$.post(uri, { mode: 1 }, function(data, status){
			$('body').html(data); 
		});
	});
	
	// (Warehouse) Confirming the requested item
	$('#send_button').click(function(){
		// Later .....
	});
	
	$('.tombolan').each(function(){
		$(this).click(function(evt){
			evt.preventDefault(); // Biar gak ke refresh
			var uri = "<?php echo site_url() . "/Component/form"?>";
			var com_id = $(this).attr('realid');
			$.post(uri, { mode: 2, id: com_id }, function(data, status){
				$('body').html(data); 
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
	
	// (Project) Request a new item. Warehouse need to purchase new item
	$('#request_new').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/form"?>";
		$.post(uri, { mode: 0 }, function(data, status){
			$('body').html(data); 
		});
	});
	//======================================================================================
	// General
	//======================================================================================
	$('#table_com').DataTable();
});
</script>
<?php 
echo "<div id='ComponentArea'>";
switch ($mode) {
	case 0: // Project view (Show installed component)
		echo "<strong>Installed Components</strong><br>";
		echo "<input type='button' value='Request components' id='request_exist'>";
		echo "<input type='button' value='Dismantle checked component' id='dismantle_button'>";
		$this->bs->datatable_checker('table_com', $db, array("vocab_check" => "Dismantle"));
		break;
	case 1: // Warehouse view (Initial)
		echo "<input type='button' value='Add new component' id='add_new'>";
		echo "<input type='button' value='Send component' id='send_button'>";
		echo "<div style='float: right'><input type='button' value='Notif Dismantle' id='confirmation'>";
		echo "<input type='button' value='Notif Request' id='confirmation'></div>";
		$this->bs->datatable_edit_and_check('table_com', $db);
		break;
	case 2: // Project view (After clicked 'Request component')
		echo "<strong>Available Components</strong><br>";
		echo "<input type='button' value='Request these components' id='send_request'>";
		echo "<input type='button' value='Request new component' id='request_new'>";
		$this->bs->datatable_checker('table_com', $db);
		break;
}
echo "</div>";
echo "<div id='display'></div>";
?>