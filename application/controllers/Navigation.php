<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends CI_Controller {

	function __construct(){
		parent::__construct();
		//$this->load->view('Loader');
	}
	
	function index(){
		$this->load->view('Navigation/header');
	}
	
	function piar(){
		$this->load->view('purchase_request');
	}
	
	function coba(){
		echo "<script>
		
			var jeson1 = {nama : 'Ardhi' , alamat : 'Jakarta'};
			var jeson2 = {kantor : 'AJN' , hape : '085334240488'}
		
		
		function mergeClick(){
			console.log(asu(jeson1,jeson2));
		}
		</script>
		
		<button onclick='mergeClick()'>Aegis Merge</button>";
	}

}
?>