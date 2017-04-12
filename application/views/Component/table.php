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
<table>
<tr><td>*</td><td>Serial number</td><td>Name</td><td>Nominal</td></tr>
<tr><td><input type="button" value="edit?"></td><td>ASDFGHJ</td><td>Component A</td><td>1</td></tr>
<tr><td><input type="button" value="edit?"></td><td>QWERTYU</td><td>Component B</td><td>3</td></tr>
<tr><td><input type="button" value="edit?"></td><td>ZXCVBNM</td><td>Component C</td><td>1</td></tr>
</table>
<input type="button" value="Request component" id="request">
</div>