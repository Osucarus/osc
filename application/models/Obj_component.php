<?php
class Obj_component extends CI_Model {
	
	const TABLE_COLUMN = "id as com_id, name, description, nominal, nominal_measure, type_id, serial_number, status, location_id, confirmation";
	
	function __construct (){
		parent::__construct();
		$this->load->database();
	}
	
	// Return = an array containing (key = column name, value = column value)
	public function getById($id, $from = "components", $column = self::TABLE_COLUMN){
		$kue = "select $column from $from where id = $id";
		$result = $this->db->query($kue);
		$result = $result->result();
		$result = (array) $result[0];
		return $result;
	}
	
	public function getSingle($id, $column = self::TABLE_COLUMN){
		$kue = "select $column from view_components where id =  $id";
		$result = $this->db->query($kue);
		$result = $result->result();
		return $result;
	}
	
	// Return = array of objects containing components database
	public function getAll($column = "*"){
		$kue = "select $column from view_components";
		$result = $this->db->query($kue);
		return $result->result();
	}
	
	public function getByProjId($projId, $column = "*"){
		$kue = "select $column from view_components where location_id = $projId";
		$result = $this->db->query($kue);
		return $result->result();
	}
	
	public function getAvailable($column = "*"){
		$kue = "select $column from available_components";
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
			$db = $this->getById($id, "components", "status, confirmation");
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
		$kue = "select * from view_components where location_id = $id and (status = 0 or status = 2) and confirmation = 0";
		return $this->db->query($kue)->result();
	}
	
	public function insert($post){
		$kue = $this->bs->insertBuilder('components', $post);
		$this->db->query($kue);
	}
	
	public function getReqCount(){
		$kue = "select count(*) as jumlah from requested_components";
		return $this->db->query($kue)->result()[0];
	}
	
	public function getDismantleCount(){
		$kue = "select count(*) as jumlah from dismantle_components";
		return $this->db->query($kue)->result()[0];
	}
	
	public function getAllRequested(){
		$kue = "select * from requested_components";
		return $this->db->query($kue)->result();
	}
	
	public function getAllDismantle(){
		$kue = "select * from dismantle_components";
		return $this->db->query($kue)->result();
	}
	
	/*
	=========================================================================================
	Purchase Requisitions Model
	=========================================================================================
	*/
	
	public function insertPurchaseRequest($data){
		$cek = $this->bas->hasRow('Select 1 from purchase_requisition where pq_no = \'$data[pq_no]\'');
		if ($cek){
			$kueri = $this->bas->insertBuilder($data);
			$this->db->query($kueri);
		} else {
			$kueri = $this->bas->updateBuilder('purchase_requisitions',$data,'pq_no = $data[pq_no]');
			$this->db->query($kueri);
		}
	}
	
	public function updatePurchaseRequest($data){
		$kueri = $this->bas->updateBuilder('purchase_requisitions',$data,'pq_no = $data[pq_no]');
		$this->db->query($kueri);
	}
}
?>