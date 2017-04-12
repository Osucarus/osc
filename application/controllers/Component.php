<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Component extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Basic','bas');
		$this->load->view('Loader.php');
	}
	
	function form(){
		$this->load->view('Component/form');
	}
	
	function request(){
		$this->load->view('Component/request');
	}
	
	function installed(){
		
		$this->load->view('Component/table');
	}
	
}
?>