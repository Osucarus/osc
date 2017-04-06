<?php
class Ctest extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function cihello(){
		echo "This is hello."; 
	}
	
	public function index() { 
		echo "This is default function."; 
    } 
	
	public function arg($arg = "default"){
		echo "displaying argument : " . $arg;
	}
	
	public function use_view($arg = "default"){
		$data['arg'] = $arg;
		$this->load->view('cview', $data);
	}
	
	public function use_view2(){
		echo current_url;
		$this->load->view('cview2');
	}
	
	public function button(){
		echo "Pressed";
	}
	
	public function page1(){
		phpinfo();
	}
}