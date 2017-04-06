<script src="jquery-3.2.0.min.js"></script>
<script>
$(document).ready(function (){ 
	// Submit custom attribute function
	$('#submit').click(function(){
		var n = $('#nama').val();
		var k = $('#klass').val();
		var uri = "";
		$.post(uri, {}, function (){})
	});	
});
</script>
<?php //echo site_url() . "<br>"?>
<form>
Your name : <input type="text" id="nama"><br>
Your class : <input type="text" id="klass"><br>
</form>
<br>
<button type="button" id="submit">
Submit</button>

<br>
<div id="display"></div>