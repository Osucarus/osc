<script>
<?php 
$edit = isset($db);
if ($edit){
	$uri = "/mutakhirkan_customer";
	$judul = "Edit Customer";
}else{
	$uri = "/suntik_customer";
	$judul = "Add New Customer";
}
?>
$(document).ready(function (){ 
	$('#judul').html("<?php echo $judul; ?>");
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
<style>
#konten {
	background-color: white;
    width: 80%;
	height: auto;
    border: 2px double #0C358D;
	border-radius: 16px;
    margin-left: auto;
    margin-right: auto;
	padding: 25px;
}

#judul {
    text-align: center;
	margin-bottom: 12px;
}

td {
	padding-top: 5px;
	padding-bottom: 5px;
}
</style>
<form>
<table>
<tr><td>Nama</td><td class='tdinput' width="100%"><input class='inputan' type="text" id="name"></td></tr>
<tr><td>Alamat</td><td class='tdinput'><input class='inputan' type="text" id="address"></td></tr>
<tr><td>NPWP</td><td class='tdinput'><input class='inputan' type="text" id="npwp"></td></tr>
<tr><td>NOB</td><td class='tdinput'><input class='inputan' type="text" id="nob"></td></tr>
<tr><td>Telepon</td><td class='tdinput'><input class='inputan' type="text" id="phone"></td></tr>
<tr><td>Fax</td><td class='tdinput'><input class='inputan' type="text" id="fax"></td></tr>
<tr><td>No. HP</td><td class='tdinput'><input class='inputan' type="text" id="mobile"></td></tr>
<tr><td>Email</td><td class='tdinput'><input class='inputan' type="text" id="email"></td></tr>
<tr><td>Petugas</td><td class='tdinput'><input class='inputan' type="text" id="officer"></td></tr>
<tr><td>Jabatan</td><td class='tdinput'><input class='inputan' type="text" id="designation"></td></tr>
<tr><td colspan='3'><button class='tombolan' type="submit" id="submit">Submit</button></td></tr>
</table>
</form>
<div id="display"></div>

