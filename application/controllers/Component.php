<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Component extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Obj_component', 'com');
		$this->load->model('Basic','bs');
		$this->load->view('Loader.php');
	}
	//====================================================================================
	// Request / Edit component form
	//====================================================================================
	function form(){
		if ($_POST['mode'] == 2){
			$_POST['db'] = $this->com->getById($_POST['id']);
		}
		$this->load->view('Component/form', $_POST);
	}
	
	//====================================================================================
	// Operations
	//====================================================================================
	function dismantling(){
		foreach($_POST['centang'] as $k => $id){
			$data['data'] = array( "status" => "4", "confirmation" => "0");
			$data['id'] = $id;
			$this->com->updateDismantle($data, 3);
		}
		$_POST['mode'] = 1;
		$this->installed();
	}
	
	function cancel_dismantle(){
		foreach($_POST['centang'] as $k => $id){
			$data['data'] = array( "status" => "3", "confirmation" => "1");
			$data['id'] = $id;
			$this->com->updateDismantle($data, 4);
		}
		$_POST['mode'] = 2;
		$this->installed();
	}
	
	// Request component
	function request_components(){
		foreach($_POST['centang'] as $k => $id){
			$data['data'] = array( "location_id" => $_POST['proj_id'], "confirmation" => "0");
			$data['id'] = $id;
			$this->com->update($data);
		}
		$_POST['mode'] = 1;
		$this->installed();
	}
	
	function cancel_request(){
		$this->com->updateCancelReq($_POST);
		$this->requested();
	}
	//====================================================================================
	// View Area (All functions here call 'Component/table')
	//====================================================================================
	function view(){
		$data['db'] = $this->com->getAll();
		$data['mode'] = $_POST['mode'];
		$this->load->view('Component/table', $data);
	}
	
	// Show installed (Mode = 1: Dismantle, 2: Cancel dismantle)
	function installed(){
		$data['db'] = $this->com->getByProjId($_POST['proj_id']);
		$data['mode'] = $_POST['mode'];
		$this->load->view('Component/table', $data);
	}
	
	// Show all available component (location_id == 0 AND status == 0)
	// Mode = 3: Request from avaliable component
	function available(){
		$data['db'] = $this->com->getAvailable();
		$data['mode'] = 3;
		$this->load->view('Component/table', $data);
	}
	
	// Show all requested component (location_id != 0, status == 0 OR 2, confirmation == 0)
	// Mode = 4: Cancel request
	function requested(){
		$data['db'] = $this->com->getAllRequestedByProjId($_POST['proj_id']);
		$data['mode'] = 4;
		$this->load->view('Component/table', $data);
	}
	
	// ===================================================================================
	// Create / Update / Delete
	// ===================================================================================
	
	function add_component(){
		$this->com->insert($_POST);
		$_POST['mode'] = 0;
		$this->view();
	}
	
	function edit_component(){
		$this->com->update($_POST);
		$_POST['mode'] = 0;
		$this->view();
	}
	
	function del_component(){
		$this->com->del_com($_POST);
		$_POST['mode'] = 0;
		$this->view();
	}
	
	//===================================================================================
	// (DEBUG) Data dummy generator (WARNING: ACCESSING THIS WILL REPLACE ALL DATA)
	//===================================================================================
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
				"status" => rand(0,4),
				"confirmation" => rand(0,1)
			);
			$kue = $this->bs->insertBuilder('components',$build);
			echo $this->db->query($kue);
		}
	}
	
	//===================================================================================
	// (DEBUG) Change entire data
	//===================================================================================
	function debug(){
		$dbname = 'Components';
		$arr = array("status" => "0");
		$kue = $this->bs->updateBuilder($dbname, $arr);
		echo $kue;
	}
}
?>