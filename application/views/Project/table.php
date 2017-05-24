<script>
$(document).ready(function(){
	$('#judul').html("Project table");
	
	$('.table_button').each(function(){
		$(this).click(function(evt){
			evt.preventDefault(); // Biar gak ke refresh
			var uri = "<?php echo site_url() . "/Project/form"?>";
			var proj_id = $(this).attr('actualid');
			$.post(uri, { id: proj_id }, function(data, status){
				$('#konten').html(data);
			});
		});
	});
	
	$('#table_project').DataTable();
});
</script>
<div id="project_table">
<?php 
if ($mode == 1){
	$this->bs->datatable_edit("table_project", $db);
}else{
	$this->bs->datatable_plain("table_project", $db);
}
?>
</div>