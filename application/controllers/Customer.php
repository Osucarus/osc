<?php
class Customer extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Obj_customer', 'cs');
		$this->load->model('Basic', 'bs');
		$this->load->view('Loader');
	}
	
	public function index(){
		$data = $this->cs->getAll();
		$this->bs->tableBuilder($data);
	}
	
	public function form(){
		$this->load->view('Customer/form');
	}
	
	public function view(){
		/*$data['mode'] = "view";
		$data['db'] = $this->cs->getById(1);
		$data['db'] = $data['db'][0];
		$data['db'] = (array) $data['db'];*/
		
		$data['db'] = $this->cs->getAll();
		$this->load->view('Customer/table', $data);
	}
	
	public function update(){
	}
	
	public function del(){
	}
	
	public function insert(){
		echo var_dump($_POST);
		$kue = $this->bs->insertBuilder('customer',$_POST);
		echo $this->db->query($kue);
		
		//$this->cs->query()
	}
}