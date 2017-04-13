<script>
$(document).ready(function(){
	// Row counter
	var i = 0;
	
	// Iterasi untuk setiap tombol
	$('.tombol').each(function(){
		var id = "#tombol-ke-" + i;
		var colclass = ".isitabel-" + i;
		
		// Cantoling fungsi di setiap tombol
		$(id).click(function(evt){
			evt.preventDefault(); // Biar gak ke refresh
			var uri = "<?php echo site_url() . "/project/form"?>";
			var data_db = {
				db: {},
			};
			
			// Iterasi untuk setiap baris untuk mengambil nilai
			$(colclass).each(function(){
				var mentah = $(this).attr('id');
				var dipotong = mentah.split('-');
				var key = dipotong[0];
				if(key == 'pid'){
					data_db['db'][key] = $(this).attr('actualid');
				}else{
					data_db['db'][key] = $(this).html();
				}
			});
			
			$.post(uri, data_db, function(data, status){
				$('#project_table').html(data);
			});
		});
		
		// Row counter nambah setelah bisnis nyantolin fungsi selese
		i++;
	});
});
</script>
<div id="project_table">
<?php $this->bs->tableBuilder($db, true);?>
</div>