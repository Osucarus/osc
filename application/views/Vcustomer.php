<form id='customer' action='#'>

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
<tr><td colspan='3'><button type="submit">Submit</button></td></tr>
</table>

</form>

<script>
	$('#customer').submit(function(evt){
		evt.preventDefault();
		
		isi = inputToJson('.inputan');
		
		$.post('<?php echo site_url()?>/Customer/proses',isi,function(data){
			$('#hasil').html(data)
		})
	})
</script>

<div id='hasil'></div>