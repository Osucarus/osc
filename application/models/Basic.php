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
	
	function getLatestLyEntry(){
		$kueri = "select \"no\" from layanan order by \"no\" desc limit 1";
		$hasil = $this->db->query($kueri);
		if($hasil->num_rows() > 0) {
			$hasil = $hasil->result();
			return $hasil[0]->no;
		}else{
			return 0;
		}
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
	
	function tableBuilder($db, $replacer = null){
		echo "<table>";
		$i = 0;
		foreach($db as $d) {
			echo "<tr>";
			$d = (array) $d;
			if ($i == 0){
				echo "<tr>";
				foreach($d as $key => $value){
					echo "<td>$key</td>";
				}
				echo "<tr>";
			}
			foreach($d as $val){
				echo "<td>$val</td>";
			}
			$i += 1;
			echo"</tr><br>";
		}
		echo "<table";
	}
	
} ?>