<?php
if ($mode == 0){ // Sign in
	$hidden = " hidden";
	$signbutton = "Sign in";
	$account = "Create a new account";
}else{ // Sign up
	$hidden = "";
	$signbutton = "Sign up";
	$account = "Login with existing account";
}
?>
<script>
$(document).ready(function(){
	$('#changemode').click(function(evt){
		evt.preventDefault();
		var mode = $('#userform').attr('mode');
		switch(mode){
			case "0":
				var uri = "<?php echo site_url() . "/Auth/signup";?>";
				$.post(uri, {}, function(data){
					isiKonten(data);
				});
				break;
			case "1":
				var uri = "<?php echo site_url() . "/Auth/login";?>";
				$.post(uri, {}, function(data){
					isiKonten(data);
				});
				break;
		}
	})
	
	$('#signbutton').click(function(evt){
		evt.preventDefault();
		var mode = $('#userform').attr('mode');
	})
});
$('#judul').html("<?php echo $signbutton;?>");
</script>
<style>
#konten {
	background-color: white;
    width: 400px;
	height: auto;
    border: 2px double #0C358D;
	border-radius: 16px;
    margin-left: auto;
    margin-right: auto;
	padding: 2%;
}

#judul {
    text-align: center;
	margin-bottom: 24px;
}

td {
	padding-top: 5px;
	padding-bottom: 5px;
}

input[type=text], input[type=password] { width: 130% }

</style>
<form id="userform" mode="<?php echo $mode;?>">
<table>
<tr><td>Username</td><td class='tdinput'><input type="text" id="name"></td></tr>
<tr><td>Password</td><td class='tdinput'><input type="password" id="password"></td></tr>
<tr class="<?php echo $hidden;?>"><td>Type</td><td class='tdinput'><select id="auth">
	<option value="1">Commerce</option>
	<option value="2">Implementation</option>
	<option value="3">Warehouse</option>
</select></td></tr>
</table>
<br>
<input id="signbutton" type="button" value="<?php echo $signbutton?>" class="tombolan"> or <input type="button" value="<?php echo $account;?>" class="Tombolan" id="changemode">
</form>