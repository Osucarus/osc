<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Obj_project','proj');
		$this->load->model('Obj_component','com');
		$this->load->model('Basic','bs');
		$this->load->view('Loader.php');
	}
	
	function form(){
		$this->load->view('Project/form', $_POST);
	}
	
	function edit_project(){
		$this->proj->update($_POST);
		$_POST['mode'] = 1;
		$this->view();
	}
	
	function create(){
		$this->proj->insert($_POST['contract_id']);
		$_POST['mode'] = 0;
		$this->view();
	}
	
	function view(){
		$_POST['db'] = $this->proj->getAll();
		$this->load->view('Project/table', $_POST);
	}
	
	function view_radio(){
		$data['db'] = $this->proj->getAll();
		$data['com_id'] = $_POST['com_id'];
		$data['com_info'] = $this->com->getSingle($data['com_id'], "*");
		$this->load->view('Project/table_radio', $data);
	}
	
	function del_project(){
		$this->proj->del($_POST);
		$_POST['mode'] = 1;
		$this->view();
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