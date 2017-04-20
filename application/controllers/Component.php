<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Component extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Obj_component', 'com');
		$this->load->model('Basic','bs');
		$this->load->view('Loader.php');
	}
	
	function form(){
		if ($_POST['mode'] == 2){
			$_POST['db'] = $this->com->getById($_POST['id']);
		}
		$this->load->view('Component/form', $_POST);
	}
	
	function installed(){
		$data['db'] = $this->com->getByProjId($_POST['proj_id']);
		$data['mode'] = 0;
		$this->load->view('Component/table', $data);
	}
	
	function view(){
		$data['db'] = $this->com->getAll();
		$data['mode'] = 0;
		$this->load->view('Component/table', $data);
	}
	
	function request_component(){
		foreach($_POST['centang'] as $k => $id){
			$data['data'] = array( "location_id" => $_POST['proj_id'], "confirmation" => "0");
			$data['id'] = $id;
			$this->com->update($data);
		}
	}
	
	function edit_component(){
		$this->com->update($_POST);
		$this->view();
	}
	
	function add_component(){
		$kue = $this->bs->insertBuilder('components', $_POST);
		$this->db->query($kue);
		$this->view();
	}
	
	function del_component(){
		$this->com->del_com($_POST);
		$this->view();
	}
	
	function generate(){
		$delkue = "delete from components";
		$this->db->query($delkue);
		for ($i = 1; $i < 31; $i++){
			$loc = rand(0, 1);
			if ($loc == 1){
				$loc = rand(101,106);
			};
			$build = array(
				"name" => "Component $i",
				"location_id" => $loc,
				"type_id" => rand(1,3),
				"nominal" => 1,
				"nominal_measure" => "unit",
			);
			$kue = $this->bs->insertBuilder('components',$build);
			echo $this->db->query($kue);
		}
	}
	
}
?>