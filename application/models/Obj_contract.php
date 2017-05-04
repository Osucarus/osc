<?php
class Obj_contract extends CI_Model {
	
	function __construct (){
		parent::__construct();
		$this->load->database();
	}
	
	// Return = an array containing (key = column name, value = column value)
	public function getById($id){
		$kue = "select ct.*,(ct.customer_id || '-' || cs.name) as customer_id2 from contract ct, customer cs where ct.customer_id = cs.id and ct.id = $id;";
		$result = $this->db->query($kue);
		$result = $result->result();
		$result = (array) $result[0];
		return $result;
	}
	
	// Return = array of objects containing customer database
	public function getAll(){
		$kue = "select * from contract order by date_modified desc";
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
	
	public function del($post){
		$id = $post['contract_id'];
		$kue = "delete from contract where id = $id";
		$this->db->query($kue);
	}
}