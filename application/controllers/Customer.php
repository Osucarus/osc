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
		echo $this->db->query($kue);
	}
}