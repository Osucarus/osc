<?php $this->load->view('Loader'); ?>

<script>
$(document).ready(function(){
	
});

//===============================================================
// User Interface Control
//===============================================================

function isiKonten(isi){
	$('.dropdown-menu').hide(); // Hilangin menu dropdownnya
	$('#konten').html(isi);		// Isi kontennya
}

function viewCustomer(){
	$.post('<?php echo site_url();?>/view_customer',{},function(data){
		isiKonten(data);
	})
}

function addCustomer(){
	$.post('<?php echo site_url();?>/add_customer',{},function(data){
		isiKonten(data);
	})
}

function viewContract(){
	$.post('<?php echo site_url();?>/Contract/view',{},function(data){
		isiKonten(data);
	})
}

function addContract(){
	$.post('<?php echo site_url();?>/Contract/form',{mode: 0},function(data){
		isiKonten(data);
	})
}

function viewProject(){
	$.post('<?php echo site_url();?>/Project/view',{mode: 0},function(data){
		isiKonten(data);
	})
}

//============================================================
// User Experience
//============================================================

function dropCommerce(){
	$('.dropdown-menu').hide();
	$('#dropdown-commerce').toggle();
	
}

function dropImplementation(){
	$('.dropdown-menu').hide();
	$('#dropdown-implementation').toggle();
}

</script>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
  </div>
  
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" onclick='dropCommerce()' data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Commerce <span class="caret"></span></a>
          <ul class="dropdown-menu" id='dropdown-commerce'>
            <li><a href="#" onclick='viewCustomer()'>View Customer</a></li>
            <li><a href="#" onclick='addCustomer()'>Add Customer</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#" onclick='viewContract()'>View Contract</a></li>
			<li><a href="#" onclick='addContract()'>Add Contract</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#" onclick='viewProject()'>View Project</a></li>
			<li></li>
          </ul>
        </li>
		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" onclick='dropImplementation()' data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contract <span class="caret"></span></a>
          <ul class="dropdown-menu" id='dropdown-implementation'>
            <li><a href="#">Add New Contract</a></li>
            <li><a href="#">View Contract</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div id='konten'></div>