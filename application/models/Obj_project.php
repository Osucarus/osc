<?php
class Obj_project extends CI_Model {
	
	function __construct (){
		parent::__construct();
		$this->load->database();
	}
	
	// Return = an array containing (key = column name, value = column value)
	public function getById($id, $column = '*'){
		$kue = "select $column from project where id =  $id";
		$result = $this->db->query($kue);
		$result = $result->result();
		$result = (array) $result[0];
		return $result;
	}
	
	// Return = array of objects containing customer database
	public function getAll(){
		$kue = "select pj.id as no, (pj.contract_id || '-' || ct.name) as contract, pj.name, pj.start, pj.finish, pj.note, pj.status from project pj, contract ct where pj.contract_id = ct.id order by pj.date_modified desc";
		$result = $this->db->query($kue);
		return $result->result();
	}
	
	// Return = an array containing (key = column name, value = column value)
	public function getByContract($contract_id, $column = '*'){
		$kue = "select $column from project where contract_id = $contract_id";
		//$kue = "select * from project where contract_id = 9";
		$result = $this->db->query($kue);
		$result = $result->result();
		return $result;
	}
	
	public function update($data){
		$dbname = 'Project';
		$arr = $data['data'];
		$id = $data['id'];
		$where = "id = $id";
		$kue = $this->bs->updateBuilder($dbname, $arr, $where);
		$this->db->query($kue);
	}
	
	public function insert($contract_id){
		$dbname = 'project';
		$arr = array("contract_id" => $contract_id, "status" => 0);
		$kue = $this->bs->insertBuilder($dbname,$arr);
		$this->db->query($kue);
	}
	
	public function del($post){
		$id = $post['id'];
		$kue = "delete from project where id = $id";
		$this->db->query($kue);
	}
}