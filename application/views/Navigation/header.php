<?php $this->load->view('Loader'); ?>

<script>
$(document).ready(function(){
	
});

function viewCustomer(){
	$.post('<?php echo site_url();?>/Customer/view',{oke : 'ok'},function(data){
		$('#konten').html(data);
	})
}

function dropCustomer(){
	$('.dropdown-menu').hide();
	$('#dropdown-customer').toggle();
	
}

function dropContract(){
	$('.dropdown-menu').hide();
	$('#dropdown-contract').toggle();
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
          <a href="#" class="dropdown-toggle" onclick='dropCustomer()' data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Customer <span class="caret"></span></a>
          <ul class="dropdown-menu" id='dropdown-customer'>
            <li><a href="#">Add New Customer</a></li>
            <li><a href="#">View Customer</a></li>
          </ul>
        </li>
		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" onclick='dropContract()' data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contract <span class="caret"></span></a>
          <ul class="dropdown-menu" id='dropdown-contract'>
            <li><a href="#">Add New Contract</a></li>
            <li><a href="#">View Contract</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div id='konten'></div>