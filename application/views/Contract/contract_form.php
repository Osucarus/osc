<?php if(!isset($datek)){
	echo "<title>Insert mode</title>";
} else {
	echo "<title>Update mode</title>";
	var_dump($datek);
} ?>


<form id='contract_form'>
<table>
<tr><td>Site Name</td><td>:</td><td><input class='inputan' type="text" id="name"></td></tr>
<tr><td>Customer ID</td><td>:</td><td><input class='inputanx' list="CustomerList" id="customer"></td></tr>
<tr><td>Origin</td><td>:</td><td><input class='inputan' type="text" id="origin"></td></tr>
<tr><td>Destination</td><td>:</td><td><input class='inputan' type="text" id="destination"></td></tr>
<tr><td>Group ID</td><td>:</td><td><input class='aidi' type="text" id="group"></td></tr>
<tr><td>Product ID</td><td>:</td><td><input class='aidi' type="text" id="product"></td></tr>
<tr><td>Service ID</td><td>:</td><td><input class='aidi' type="text" id="service"></td></tr>
<tr><td>Technical Authorized Officer</td><td>:</td><td><input class='inputan' type="text" id="tao"></td></tr>
<tr><td>Connection Type</td><td>:</td><td><input class='inputan' type="text" id="connection"></td></tr>
<tr><td>Access (In/Out)</td><td>:</td><td><input class='inputan' type="text" id="bw_access"></td></tr>
<tr><td>CIR (In/Out)</td><td>:</td><td><input class='inputan' type="text" id="bw_cir"></td></tr>
<tr><td>Burst (In/Out)</td><td>:</td><td><input class='inputan' type="text" id="bw_burst"></td></tr>
<tr><td>Contract Period</td><td>:</td><td><input class="inputan" type="text" id="period"></td></tr>
</table>
<input hidden id="customer_id" class="inputan">
<input hidden id="group_id" class="inputan">
<input hidden id="product_id" class="inputan">
<input hidden id="service_id" class="inputan">

</form>

<datalist id="CustomerList">
	<option>1-Telkomsel</option>
	<option>2-BP3TI</option>
	<option>4-BGA</option>
</datalist>
