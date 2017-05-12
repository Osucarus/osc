<script>
$(document).ready(function(){
	$('#judul').html("Project table");
	$('#button_change').click(function(evt){
		evt.preventDefault();
		var uri = "<?php echo site_url() . "/Component/edit_component"?>";
		var data = {location_id: selected_radio};
		var com_id = $(this).attr('com_id');
		var data_send  = {
			data: data,
			id: com_id
		};
		$.post(uri, data_send, function(data, status){
			$('#konten').html(data);
		});
	});
	
	$('#com_info').DataTable({ "paging" : false, "searching": false, "info": false });
	$('#table_proj_radio').DataTable({ "paging" : false, "info": false });
});
</script>
<strong>Change Location for this component</strong><br>
<?php
	$this->bs->datatable_plain('com_info', $com_info, false);
?>
<br><input type='button' value='Change location' id='button_change' com_id='<?php echo $com_id ?>'><br>
<strong>Project table</strong>
<?php 
	$this->bs->datatable_radio('table_proj_radio', $db);
?>