<?php 
Class Basic extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function ifExist($kueri){
		$cek = $this->db->query($kueri);
		if ($cek->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function reverseDate($date){
		$dat = explode('-',$date);
		$hasil = $dat[2]."-".$dat[1]."-".$dat[0];
		return $hasil;
	}
	
	function circuitDate($date){
		$dat = explode('-',$date);
		$hasil = $dat[2].$dat[1].$dat[0];
		return $hasil;
	}
	
	function kueriToJson($kueri){
		$has = $this->db->query($kueri);
		$has = $has->result();
		$has = json_encode($has);
		return $has;
	}
	
	function kueriResult($kueri){
		$has = $this->db->query($kueri);
		$has = $has->result();
		return $has;
	}
	
	function insertBuilder($dbname,$arr){
		$preval = "";
		$postval = "";
		foreach($arr as $ar => $val){
			$preval .= "$ar,";
			$postval .= "'$val',";
		}
		$preval = substr($preval,0,-1);
		$postval = substr($postval,0,-1);
		$resString = "insert into $dbname($preval) values ($postval)";
		return $resString;
	}
	
	function updateBuilder($dbname,$arr,$condition){
		$postset = "";
		foreach($arr as $ar => $val){
			$postset .= "$ar = '$val',";
		}
		$postset = substr($postset,0,-1);
		$res = "upadate $dbname set $postset where $condition";
		return $res;
	}
	
} ?>