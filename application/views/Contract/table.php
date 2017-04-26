<script>
$(document).ready(function(){
	$('.tombol').each(function(){
		$(this).click(function(evt){
			evt.preventDefault(); // Biar gak ke refresh
			var uri = "<?php echo site_url() . "/Contract/form"?>";
			var com_id = $(this).attr('actualid');
			$.post(uri, { mode: 1, id: com_id }, function(data, status){
				$('#konten').html(data);
			});
		});
	});
	$('#contract_table').DataTable();
})
</script>
<div id="contract_content">
<?php $this->bs->datatable_edit("contract_table", $db);?>
</div>