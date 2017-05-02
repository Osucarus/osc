<?php
class Obj_component extends CI_Model {
	
	const TABLE_COLUMN = "id as com_id, name, description, nominal, nominal_measure, type_id, serial_number, status, location_id, confirmation";
	
	function __construct (){
		parent::__construct();
		$this->load->database();
	}
	
	// Return = an array containing (key = column name, value = column value)
	public function getById($id, $column = self::TABLE_COLUMN){
		$kue = "select $column from components where id =  $id";
		$result = $this->db->query($kue);
		$result = $result->result();
		$result = (array) $result[0];
		return $result;
	}
	
	public function getSingle($id, $column = self::TABLE_COLUMN){
		$kue = "select $column from components where id =  $id";
		$result = $this->db->query($kue);
		$result = $result->result();
		return $result;
	}
	
	// Return = array of objects containing components database
	public function getAll($column = "*"){
		$kue = "select $column from components";
		$result = $this->db->query($kue);
		return $result->result();
	}
	
	public function getByProjId($projId, $column = "*"){
		$kue = "select $column from components where location_id = $projId";
		$result = $this->db->query($kue);
		return $result->result();
	}
	
	public function getAvailable($column = "*"){
		$kue = "select $column from components where location_id = 0 and status = 0 and confirmation = 1";
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
	
	public function updateDismantle($data, $status){
		$dbname = 'Components';
		$arr = $data['data'];
		$id = $data['id'];
		$where = "id = $id and status = $status";
		$kue = $this->bs->updateBuilder($dbname, $arr, $where);
		$this->db->query($kue);
	}
	
	public function updateCancelReq($post){
		foreach ($post['centang'] as $k => $id){
			$db = $this->getById($id, "status");
			if ($db['status'] == 2){
				$this->del_com(array("id" => $id));
			}else{
				$data = array(
				"data" => array("location_id" => "0", "confirmation" => "1"),
				"id" => $id
				);
				$this->update($data);
			};
		};
	}
	
	public function updateConfirm($post){
		foreach ($post['centang'] as $k => $id){
			$db = $this->getById($id, "status, confirmation");
			if ($db['status'] == 0 && $db['confirmation'] == 0){
				$data = array(
				"data" => array("status" => "3", "confirmation" => "1"),
				"id" => $id
				);
				$this->update($data);
			}else if($db['status'] == 4 && $db['confirmation'] == 0){
				$data = array(
				"data" => array("status" => "0", "confirmation" => "1"),
				"id" => $id
				);
				$this->update($data);
			};
		};
	}
	
	public function del_com($data){
		$id = $data['id'];
		$kue = "delete from components where id = $id";
		$this->db->query($kue);
	}
	
	public function getAllRequestedByProjId($id){
		$kue = "select * from components where location_id = $id and (status = 0 or status = 2) and confirmation = 0";
		return $this->db->query($kue)->result();
	}
	
	public function insert($post){
		$kue = $this->bs->insertBuilder('components', $post);
		$this->db->query($kue);
	}
}