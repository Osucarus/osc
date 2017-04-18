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
		$this->load->view('Component/form');
	}
	
	function request(){
		$this->load->view('Component/request');
	}
	
	function newReq(){
		$kue = $this->bs->insertBuilder('components_req',$_POST);
		$this->db->query($kue);
	}
	
	function installed(){
		$data['db'] = $this->com->getByProjId($_POST['proj_id']);
		$data['mode'] = 1;
		$this->load->view('Component/table', $data);
	}
	
	function view(){
		if (isset($_POST['mode'])){
			$data['db'] = $this->com->getUnused();
			$data['mode'] = 0;
		}else{
			$data['db'] = $this->com->getAll();
			$data['mode'] = 0;
		}
		$this->load->view('Component/table', $data);
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