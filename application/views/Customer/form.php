<script>
<?php 
$edit = isset($db);
if ($edit){
	$uri = "/mutakhirkan_customer";
}else{
	$uri = "/suntik_customer";
}
?>
$(document).ready(function (){ 
	$('#submit').click(function(evt){
		evt.preventDefault(); // Biar gak ke refresh
		var uri = "<?php echo site_url().$uri?>";
		<?php
		if ($edit){
			echo "var data_insert = {};";
			echo "data_insert['db'] = classValueToJson('.inputan');";
			echo "data_insert['id'] = " . $db['id'] . ";";
		}else{
			echo "var data_insert = classValueToJson('.inputan');";
		}
		?>
		$.post(uri, data_insert, function(data, status){
			$('#konten').load('<?php echo site_url()?>/view_customer');
		});
	});	
		
	
	<?php
	if ($edit){
		foreach ($db as $key => $value) {
			echo "$('#$key').val('$value');";
		}
	}
	?>
	
	// Debugger biar gak mager ngisi
	if (false){
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		$('.inputan').each(function(){
			var text = "";
			for( var i=0; i < 5; i++ )
				text += possible.charAt(Math.floor(Math.random() * possible.length));
			$(this).val(text);
		});
	}
});
</script>
<form>
<table>
<tr><td>Nama</td><td>:</td><td><input class='inputan' type="text" id="name"></td></tr>
<tr><td>Alamat</td><td>:</td><td><input class='inputan' type="text" id="address"></td></tr>
<tr><td>NPWP</td><td>:</td><td><input class='inputan' type="text" id="npwp"></td></tr>
<tr><td>NOB</td><td>:</td><td><input class='inputan' type="text" id="nob"></td></tr>
<tr><td>Telepon</td><td>:</td><td><input class='inputan' type="text" id="phone"></td></tr>
<tr><td>Fax</td><td>:</td><td><input class='inputan' type="text" id="fax"></td></tr>
<tr><td>No. HP</td><td>:</td><td><input class='inputan' type="text" id="mobile"></td></tr>
<tr><td>Email</td><td>:</td><td><input class='inputan' type="text" id="email"></td></tr>
<tr><td>Petugas</td><td>:</td><td><input class='inputan' type="text" id="officer"></td></tr>
<tr><td>Jabatan</td><td>:</td><td><input class='inputan' type="text" id="designation"></td></tr>
<tr><td colspan='3'><button type="submit" id="submit">Submit</button></td></tr>
</table>
</form>
<div id="display"></div>

