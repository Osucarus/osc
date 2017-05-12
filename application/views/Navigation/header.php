<?php $this->load->view('Loader'); ?>
<style>
.dropdown-header{ display:none }

#konten { height:100% }
</style>
<script>
$(document).ready(function(){
	
});

//===============================================================
// User Interface Control
//===============================================================

function isiKonten(isi){
	$('.dropdown-header').hide(); // Hilangin menu dropdownnya
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

function viewProject2(){
	$.post('<?php echo site_url();?>/Project/view',{mode: 1},function(data){
		isiKonten(data);
	})
}

function viewComponent(){
	$.post('<?php echo site_url();?>/Component/view',{mode: 5},function(data){
		isiKonten(data);
	})
}

function viewComponent2(){
	$.post('<?php echo site_url();?>/Component/view',{mode: 0},function(data){
		isiKonten(data);
	})
}

function addComponent(){
	$.post('<?php echo site_url();?>/Component/form',{mode: 1},function(data){
		isiKonten(data);
	})
}

function piar(){
	$.post('<?php echo site_url();?>/Navigation/piar',{mode: 1},function(data){
		isiKonten(data);
	})
}

function coba(){
	$.post('<?php echo site_url();?>/Navigation/coba',{mode: 1},function(data){
		isiKonten(data);
	})
}
//============================================================
// User Experience
//============================================================

function dropCommerce(){
	$('.dropdown-header').hide();
	$('#dropdown-commerce').toggle();
	
}

function dropImplementation(){
	$('.dropdown-header').hide();
	$('#dropdown-implementation').toggle();
}

function dropWarehouse(){
	$('.dropdown-header').hide();
	$('#dropdown-warehouse').toggle();
}

function tutup_menu(){
	$('.dropdown-header').hide();
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
      <a class="navbar-brand" href="#">AJN OSC</a>
  </div>
  
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" onclick='dropCommerce()' data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Commerce <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-header" id='dropdown-commerce'>
            <li><a href="#" onclick='viewCustomer()'>View Customers</a></li>
            <li><a href="#" onclick='addCustomer()'>Add Customer</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#" onclick='viewContract()'>View Contracts</a></li>
			<li><a href="#" onclick='addContract()'>Add Contract</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#" onclick='viewProject()'>View Projects</a></li>
			<li></li>
          </ul>
        </li>
		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" onclick='dropImplementation()' data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Implementation <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-header" id='dropdown-implementation'>
            <li><a href="#" onClick="viewProject2()">View Projects</a></li>
            <li><a href="#" onClick="viewComponent()">View Components</a></li>
			<li><a href="#" onClick="piar()">Purchase Requisition</a></li>
			<li><a href="#" onClick='coba()'>Coba</a></li>
		  </ul>
        </li>
		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" onclick='dropWarehouse()' data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Warehouse <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-header" id='dropdown-warehouse'>
            <li><a href="#" onClick="viewComponent2()">View Components</a></li>
            <li><a href="#" onClick="addComponent()">Add new Component</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div><h3 id='judul'></h3></div>
<div id='konten' onclick="tutup_menu()"></div>