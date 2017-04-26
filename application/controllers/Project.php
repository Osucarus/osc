<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Obj_project','proj');
		$this->load->model('Basic','bs');
		$this->load->view('Loader.php');
	}
	
	function form(){
		$this->load->view('Project/form', $_POST);
	}
	
	function edit_project(){
		$this->proj->update($_POST);
		$this->view();
	}
	
	function insert(){
		
	}
	
	function view(){
		$data['db'] = $this->proj->getAll();
		$this->load->view('Project/table', $data);
	}
	
	function view_radio(){
		$data['db'] = $this->proj->getAll();
		$this->load->view('Project/table_radio', $data);
	}
	
	function generate(){
		$delkue = "delete from project";
		$this->db->query($delkue);
		$conkue = "select id from contract";
		$contract = $this->db->query($conkue)->result();
		foreach($contract as $con){
			$build = array( "contract_id" => $con->id, "status" => 0 );
			$kue = $this->bs->insertBuilder('project',$build);
			echo $this->db->query($kue);
		}
	}
	
}
?>