<?php
class Obj_customer extends CI_Model {
	
	function __construct (){
		parent::__construct();
		$this->load->database();
		$this->load->model('Basic','bas');
	}
	
	// Return = an array containing (key = column name, value = column value)
	public function getById($id){
		$kue = "select * from customer where id =  $id";
		$result = $this->db->query($kue);
		$result = $result->result();
		$result = (array) $result[0];
		return $result;
	}
	
	// Return = array of objects containing customer database
	public function getAll(){
		$kue = "select * from customer order by date_modified desc";
		$result = $this->db->query($kue);
		return $result->result();
	}
	
	/*public function get_customer_all(){
		$kueri = "select name as nama, address as alamat from Customers";
		$hasil = $this->bas->tableBuilder2('tabel_customer',$kueri);
		return hasil;
	}*/
	
}