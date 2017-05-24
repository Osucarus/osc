<style>
.kanan{
	width: 80%;
	text-align: right;
}

.tabelku td{
	padding: 5px 10px 5px 10px;
	text-align: center;
}

.tabelku th{
	text-align: center;
}

#scope_list li{
	padding: 5px 0px;
}

.angket {
	padding: 0px 10px 0px 10px;
}

#ulvendor>li {
	margin: 2px;
}

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
</style>

<script>
$(document).ready(function(){
	$("#judul").html("");
})
var counter = 2;
function tambahUraian(){
	isi = "<tr><td>"+counter+"</td><td><textarea class='pq_desc' cols='50' onchange='onGanti(this)'></textarea></td><td><input size='3' onchange='onGanti(this)'/></td><td><input size='3' /><td><input type='text' onchange='onGanti(this)'/></td></td>";
	$('#tabel_desc').append(isi);
	counter++;
}

function tambahSekop(){
	isi = '<li><input class=\'pq_scope\' onchange=\'onGanti(this)\'/></li>';
	$('#scope_list').append(isi);
}

function onGanti(x){
	x.setAttribute('value',x.value);
}

function jajal(){
	var isi = $('#scope_list').html();
	console.log(isi);
}
</script>

<button onclick='jajal()' hidden>&nbsp;</button>
<div style="text-align: center; font-size: 17px"><strong>Purchase Requisition</strong></div>
<div class='angket'>
<div>
<label for='pq_no'>No.</label><br>
<input id='pq_no' class='inputan'/>
</div>

<div>
<label for='pq_date'>Date / Tanggal</label><br>
<input id='pq_date' type='date' class='inputan'/>
</div>

<div>
<label for='pq_date_req'>Required Date / Tanggal Dibutuhkan</label><br>
<input id='pq_date_req' class='inputan'/>
</div>

<div>
<label for='pq_destination'>Destination / Tempat Tujuan</label><br>
<input id='pq_destination' class='inputan'/>
</div>

<div>
<label for='pq_job_no'>Job no.</label><br>
<input id='pq_job_no' class='inputan'/>
</div>

<div>
<label for='pq_job_desc'>Job Description / Deskripsi Kerja</label><br>
<textarea id='pq_job_desc' cols='100' rows='5' class='inputan'></textarea>
</div>

<div>
<label for='pq_acc_no'>Acc No.</label><br>
<input id='pq_acc_no' class='inputan'/>
</div>

<div>
<label>Suggested Vendor (if any) / Pemasuk yang diusulkan (jika ada)</label><br>
<ul id="ulvendor">
	<li><input id='pq_vendor-1' class='vendor'/></li>
	<li><input id='pq_vendor-2' class='vendor'/></li>
	<li><input id='pq_vendor-3' class='vendor'/></li>
</ul>
</div>

<div>
	<div style='float: left; margin: 0px 10px 0px 0px'>
		<label>Reliable to customer / Dibebankan pada pelanggan</label><br>
		<input type='radio' id='relcust1' name='relcust' value='true' class='relcust' checked/>Yes / Ya<br>
		<input type='radio' id='relcust2' name='relcust' value='false' class='relcust' /> No / Tidak<br>
	</div>
	
	<div>
		<label>Certificate Required / Sertifikat Diperlukan</label><br>
		<input type='radio' id='certreq1' name='certreq' value='true' class='certreq' checked/>Yes / Ya<br>
		<input type='radio' id='certreq2' name='certreq' value='false' class='certreq' /> No / Tidak<br>
	</div>	
</div>

<div>
	<div style='float: left; margin: 0px 10px 0px 0px'>
		<label>Inspection Required / Inspeksi Diperlukan<br>(If YES attach inspection plan / jika YA sertakan IP)</label><br>
		<input type='radio' id='insreq1' name='insreq' value='true' class='insreq' checked/>Yes / Ya<br>
		<input type='radio' id='insreq2' name='insreq' value='false' class='insreq' /> No / Tidak<br>
	</div>
	
	<div>
		<br>
		<label>Vendor Data Required / Data barang diperlukan</label><br>
		<input type='radio' id='venreq1' name='venreq' value='true' class='venreq' checked/>Yes / Ya<br>
		<input type='radio' id='venreq2' name='venreq' value='false' class='venreq' /> No / Tidak<br>
	</div>	
</div>

<div>
<label>Description / Uraian</label>
<span></span>
<table id='tabel_uraian' class='tabelku'>
	<thead>
		<tr><th>No.</th><th>Description<br>Uraian</th><th>QTY<br>JML</th><th>UNIT<br>SAT</th><th>BUDGET<br>ANGGARAN</th></tr>
	</thead>
	
	<tbody id='tabel_desc' class='inputan daftar'>
		<tr><td>1</td><td style='width:25%'><textarea class='pq_desc' cols='50' onchange='onGanti(this)'></textarea></td><td><input size='3' onchange='onGanti(this)'/></td><td><input size='3' onchange='onGanti(this)'/></td><td><input type='text' onchange='onGanti(this)'/></td></tr>
	</tbody>
</table>
<button onclick='tambahUraian()' class='tombolan'>Add Description<br>Tambah Uraian</button>
</div>

<div>
<label for='pq_purpose_bg'>Tujuan & Alasan Kebutuhan/Propose Background:</label><br>
<textarea id='pq_purpose_bg' class='inputan' rows='5' cols='50'></textarea>
</div>

<div>
<label>Lingkup Pekerjaan / Scope of Work:</label><br>
<ul id='scope_list' class='inputan_daftar'>
	<li><input class='pq_scope' onchange='onGanti(this)'/></li>
</ul>
<button onclick='tambahSekop()' class='tombolan'>Add scope<br>Tambah Scope</button>
</div>

<div>
<label>Spesifikasi Teknis dan Gambar / Type of Specification</label><br>
<textarea id='pq_type_spec' class='inputan'></textarea>
</div>

<div>
<label>Jumlah kebutuhan dan Distribusi/Quantity needed and Distribution</label><br>
<textarea id='pq_qtty' class='inputan'></textarea>
</div>

<div>
<label>Waktu pengerjaan / Processing Time:</label><br>
<textarea id='pq_proc_time' class='inputan'></textarea>
</div>

<div>
<label>Perkiraan Harga dan Alokasi Anggaran / Estimated Cost and Budget Allocation:</label><br>
<label>Perkiraan Harga</label><br>
<input id='pq_est_budget' class='inputan'/><br>
<label>Alokasi Anggaran:</label><br>
<input id='pq_aloc_budget' class='inputan'/>
</div>

<button class='tombolan' style="margin: 2px">Submit</button>
</div>