<?php
class Obj_project extends CI_Model {
	
	function __construct (){
		parent::__construct();
		$this->load->database();
	}
	
	// Return = an array containing (key = column name, value = column value)
	public function getById($id){
		$kue = "select * from project where id =  $id";
		$result = $this->db->query($kue);
		$result = $result->result();
		$result = (array) $result[0];
		return $result;
	}
	
	// Return = array of objects containing customer database
	public function getAll(){
		$kue = "select id as pid, contract_id, name, start, finish, status from project";
		$result = $this->db->query($kue);
		return $result->result();
	}
	
	public function update($data){
		$dbname = 'Project';
		$arr = $data['data'];
		$id = $data['id'];
		$where = "id = $id";
		$kue = $this->bs->updateBuilder($dbname, $arr, $where);
		return $kue;
	}
	
}