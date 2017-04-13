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
    
    function updateBuilder($dbname, $arr, $condition = null){
        $postset = "";
        foreach($arr as $ar => $val){
            $postset .= "$ar = '$val',";
        }
        $postset = substr($postset,0,-1);
        $res = "update $dbname set $postset where $condition";
        return $res;
    }
	
	function tableBuilder($db, $edit = false, $replacer = null){
		echo "<table>";
		$i = 0;
		foreach($db as $d) {
			// Header
			if ($i == 0){
				$j = 0;
				echo "<thead><tr>";
				foreach($d as $key => $value){
					if (isset($replacer) && isset($replacer[$key])){
						$key = $replacer[$key];
					}
					if ($j == 1 && $edit){
						echo "<td>Edit</td><td>$key</td>";
					}else{
						echo "<td>$key</td>";
					}
					$j += 1;
				}
				echo "</tr></thead><tbody>";
			}
			
			// Isi
			$j = 0;
			echo "<tr>";
			foreach($d as $key => $val){
				if ($j == 0){
					$no = $i + 1;
					echo "<td class='isitabel-$i' id='$key-$i' actualid='$val'>$no</td>";
				}else if ($j == 1 && $edit){
					echo "<td><button class='tombol' id='tombol-ke-$i'>Edit</button><td class='isitabel-$i' id='$key-$i'>$val</td>";
				}else{
					echo "<td class='isitabel-$i' id='$key-$i'>$val</td>";
				}
				$j += 1;
			}
			echo"</tr>";
			$i += 1;
		}
		echo "</tbody><table>";
	}
	
} ?>