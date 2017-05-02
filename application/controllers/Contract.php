<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Basic','bs');
		$this->load->model('Obj_Contract', 'kontrak');
		$this->load->model('Obj_Project', 'proj');
		$this->load->view('Loader.php');
	}
	
	function form(){
		// Mode 1 : Edit mode
		if ($_POST['mode'] == 1){
			$_POST['db'] = $this->kontrak->getById($_POST['id']);
			$_POST['proj'] = $this->proj->getByContract($_POST['id']);
		}
		$this->load->view('Contract/form', $_POST);
	}
	
	function insert(){
		$this->kontrak->insert($_POST);
		$this->view();
	}
	
	function view(){
		$data['db'] = $this->kontrak->getAll();
		$this->load->view('Contract/table', $data);
	}
	
	function update(){
		$this->kontrak->update($_POST);
		$this->view();
	}
	
	function generate(){
		$delkue = "delete from contract";
		$this->db->query($delkue);
		for ($i = 1; $i < 101; $i++){
			$build = array(
				"name" => "Contract $i",
				"customer_id" => rand(8,107),
				"rfs" => "now()",
				"period" => rand(1,10)." years",
			);
			$kue = $this->bs->insertBuilder('contract',$build);
			echo $this->db->query($kue);
		}
	}
}
?>