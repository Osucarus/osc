<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Basic','bas');
		$this->load->view('Loader.php');
	}
	
	function form(){
		$this->load->view('Project/project_form');
	}
	
	function insert(){
		
	}
	
	function view(){
		
	}
	
}
?>