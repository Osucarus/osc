<script>
$('#judul').html("Component type");
$(document).ready(function(){
	$('.table_button').each(function(){
		$(this).attr('mode', '0');
		$(this).click(function(){
			if ($(this).attr('mode') == 0){
				var row = /button-(\d+)/.exec($(this).attr('id'))[1];
				var isi = $('#name-' + row).html();
				var aidi = "input-" + row;
				var aidi2 = "cancel-"+row;
				$('#name-' + row).html("<input type='text' style='width: 90%; margin-right: 2px' id='" + aidi +"' value='" + isi +"'><input type='button' value='X' class='tombolan' id='" + aidi2 + "'>");
				$(this).attr('mode', '1');
				$(this).attr('value', 'Save');
				var input = $(this);
				$('#' + aidi2).click(function(){
					var aidi3 = "#input-" + row;
					var isi2 = $(aidi3).val();
					$('#name-' + row).html(isi);
					input.attr('mode', '0');
					input.attr('value', 'Edit');
				});
			}else{
				var row = /button-(\d+)/.exec($(this).attr('id'))[1];
				var aidi = "#input-" + row;
				var isi = $(aidi).val();
				$('#name-' + row).html(isi);
				$.post("<?php echo site_url() . "/Component/change_master_type"?>", {name: isi, id: row}, function(data, status){})
				$(this).attr('mode', '0');
				$(this).attr('value', 'Edit');
			}
		})
	})
	
	$('#button_new').click(function(){
		var uri = "<?php echo site_url() . "/Component/add_master_type"?>";
		$.post(uri, {name: $('#input_new').val()}, function(data, status){
			isiKonten(data);
		})
	})
})
$('#table_master').DataTable({ "paging" : false, "info": false, "bFilter": false });
</script>
<style>
#konten {
	background-color: white;
    width: 60%;
	height: auto;
    border: 2px double #0C358D;
	border-radius: 16px;
    margin-left: auto;
    margin-right: auto;
	padding: 25px;
}

#new_type {
	width: 100%;
	border: 2px double #0C358D;
	border-radius: 16px;
	padding: 12px;
	margin-top: 10px;
}

#new_type>span {
	margin: 2px;
}

#input_new {
	width: 82%;
}

#judul {
    text-align: center;
	margin-bottom: 12px;
}

.header-no-0, .check-column {
	width: 6%;
}

.edit-column {
	width: 11%;
}
</style>
<?php
$this->bs->datatable_edit_and_check('table_master', $db);
?>
<div id="new_type"><span><input id="input_new" type="text"></span><span><input id="button_new" type="button" class="tombolan" value="Add new type"></span></div>