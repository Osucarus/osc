<?php
class Obj_component extends CI_Model {
	
	function __construct (){
		parent::__construct();
		$this->load->database();
	}
	
	// Return = an array containing (key = column name, value = column value)
	public function getById($id){
		$kue = "select id as com_id, name, description, nominal, nominal_measure, type_id, serial_number, status, location_id from components where id =  $id";
		$result = $this->db->query($kue);
		$result = $result->result();
		$result = (array) $result[0];
		return $result;
	}
	
	// Return = array of objects containing customer database
	public function getAll(){
		$kue = "select * from components";
		$result = $this->db->query($kue);
		return $result->result();
	}
	
	public function getByProjId($projId){
		$kue = "select * from components where location_id = $projId";
		$result = $this->db->query($kue);
		return $result->result();
	}
	
	public function getUnused(){
		$kue = "select * from components where location_id = 0";
		return $this->db->query($kue)->result();
	}
	
	public function update($data){
		$dbname = 'Components';
		$arr = $data['data'];
		$id = $data['id'];
		$where = "id = $id";
		$kue = $this->bs->updateBuilder($dbname, $arr, $where);
		$this->db->query($kue);
	}
	
	public function del_com($data){
		$id = $data['id'];
		$kue = "delete from components where id = $id";
		$this->db->query($kue);
	}
	
}