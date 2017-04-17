<?php
class Customer extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Obj_customer', 'cs');
		$this->load->model('Basic', 'bs');
		$this->load->view('Loader');
	}
	
	public function index(){
	}
	
	public function form(){
		$this->load->view('Customer/form', $_POST);
	}
	
	public function view(){
		$data['db'] = $this->cs->getAll();
		$this->load->view('Customer/table', $data);
	}
	
	public function update(){
		$where = "id = " . $_POST['id'];
		$kue = $this->bs->updateBuilder('customer',$_POST['db'],$where);
		$this->db->query($kue);
	}
	
	public function del(){
	}
	
	public function insert(){
		$kue = $this->bs->insertBuilder('customer',$_POST);
		$this->db->query($kue);
	}
	
	public function generate(){
		$delkue = "delete from customer";
		$this->db->query($delkue);
		for ($i = 1; $i < 101; $i++){
			$build = array(
				"name" => "Customer $i",
				"address" => "Address $i",
				"npwp" => "npwp $i",
				"nob" => "nob $i",
				"phone" => "phone $i",
				"fax" => "fax $i",
				"mobile" => "mobile $i",
				"email" => "email $i",
				"officer" => "officer $i",
				"designation" => "npwp $i",
			);
			$kue = $this->bs->insertBuilder('customer',$build);
			$this->db->query($kue);
		}
	}
}