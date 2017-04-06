<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Basic','bas');
		$this->load->view('dependency.php');
	}
	
	function form(){
		$this->load->view('Contract/contract_form');
	}
	
	function insert(){
		
	}
	
	function view(){
		
	}
	
	function update(){
		$datek = array(
			'name' => 'Wawoni Timur',
			'customer' => '1-Telkomsel',
			'origin' => 'ATLC',
			'destination' => 'Wawoni Timur'
		);
		$data = array(
			'meta' => 'ok',
			'datek' => $datek);
		
		$this->load->view('Contract/contract_form',$data);
	}
	
}
?>