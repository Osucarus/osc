<?php
class Customer extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->view('dependency.php');
		$this->load->model('Basic','bas');
	}
	
	public function index(){
		$this->load->model('Mcustomer', 'cs');
		echo "success";
	}
	
	public function insert(){
		
	}
	
	public function update(){
		$this->load->view('Customer/form_customer');
	}
	
	public function submit(){
		
	}
	
	public function array_key(){
		$coba = array(	'oke1' => 'nilai1' , 
						'oke2' => 'nilai2',
						'oke3' => 'nilai5');
		$hasil = $this->bas->updateBuilder("coba",$coba,"oke2 = 'kuampret' and oke1 = 'ganteng'");
		var_dump($hasil);
	}
	
	public function jajal(){
		$total_rows = 156;
		$per_page = 25;
		$result = 156 % 25;
		var_dump($result+1);
		
	}
}