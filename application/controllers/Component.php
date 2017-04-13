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
	
	function installed(){
		$data['db'] = $this->com->getByProjId($_POST['proj_id']);
		$this->load->view('Component/table', $data);
	}
	
	function generate(){
		$delkue = "delete from components";
		$this->db->query($delkue);
		for ($i = 1; $i < 31; $i++){
			$build = array(
				"name" => "Component $i",
				"location_id" => rand(101, 106),
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