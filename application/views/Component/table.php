<script>
$(document).ready(function(){
	$('#request').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/view"?>";
		$.post(uri, { mode: 1 }, function(data, status){
			$('#ComponentArea').html(data); 
		});
	});
	
	$('#table_com').DataTable();
});
</script>
<?php 
if (isset($mode) && $mode == 1){
	echo "<div id='ComponentArea'>";
	$this->bs->tableBuilder($db);
	echo "<input type='button' value='Request component' id='request'>";
}else{
	echo "<div id='ComponentArea'>";
	//$this->bs->tableBuilder($db, true);
	$this->bs->table_checker('table_com', $db);
	echo "<input type='button' value='Add component' id='addcom'>";
}
echo "</div>";
?>