<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends CI_Controller {

	function __construct(){
		parent::__construct();
		//$this->load->view('Loader');
		session_start();
	}
	
	function index(){
		$this->load->view('Navigation/header');
	}
	
	function piar(){
		$this->load->view('purchase_request');
	}
	
	function coba(){
		$this->load->view('coba');
	}
}
?>