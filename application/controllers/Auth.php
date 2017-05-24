<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Basic','bs');
		$this->load->view('Loader.php');
	}
	
	function restrict(){
		$this->load->view('Auth/restrict');
	}
	
	function login(){
		$this->load->view('Auth/login', array("mode" => 0));
	}
	
	function signup(){
		$this->load->view('Auth/login', array("mode" => 1));
	}
}
?>