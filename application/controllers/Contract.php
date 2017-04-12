<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Basic','bs');
		$this->load->view('Loader.php');
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
	
	function generate(){
		$delkue = "delete from contract";
		$this->db->query($delkue);
		for ($i = 1; $i < 101; $i++){
			$build = array(
				"name" => "Customer $i",
				"customer_id" => rand(5,104),
				"rfs" => "now()",
				"period" => rand(1,10)." years",
			);
			$kue = $this->bs->insertBuilder('contract',$build);
			echo $this->db->query($kue);
		}
	}
}
?>