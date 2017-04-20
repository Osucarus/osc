<script>
$(document).ready(function(){
	$('#table_proj_radio').DataTable({ "paging" : false });
});
</script>
<?php 
$this->bs->datatable_radio('table_proj_radio', $db);
?>