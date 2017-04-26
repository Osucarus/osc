<?php
class Obj_contract extends CI_Model {
	
	function __construct (){
		parent::__construct();
		$this->load->database();
	}
	
	// Return = an array containing (key = column name, value = column value)
	public function getById($id){
		$kue = "select * from contract where id =  $id";
		$result = $this->db->query($kue);
		$result = $result->result();
		$result = (array) $result[0];
		return $result;
	}
	
	// Return = array of objects containing customer database
	public function getAll(){
		$kue = "select * from contract";
		$result = $this->db->query($kue);
		return $result->result();
	}
	
	public function update($post){
		$dbname = 'Contract';
		$arr = $post['data'];
		$id = $post['id'];
		$where = "id = $id";
		$kue = $this->bs->updateBuilder($dbname, $arr, $where);
		$this->db->query($kue);
	}
	
	public function insert($post){
		$dbname = 'Contract';
		$kue = $this->bs->insertBuilder($dbname, $post);
		$this->db->query($kue);
	}
}