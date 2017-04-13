<script>
$(document).ready(function(){
	$('#request').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url() . "/Component/request"?>";
		var data_insert = {}; // Nanti diisi data dummy / sebenarnya
		$.post(uri, data_insert, function(data, status){
			$('#installed').html(data); 
		});
	});
});
</script>
<div id="installed">
<?php $this->bs->tableBuilder($db);?>
<input type="button" value="Request component" id="request">
</div>