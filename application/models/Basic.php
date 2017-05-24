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
			if ($val !== ''){
				$postval .= "'$val',";
			}else{
				$postval .= "null,";
			}
        }
        $preval = substr($preval,0,-1);
        $postval = substr($postval,0,-1);
        $resString = "insert into $dbname($preval) values ($postval)";
        return $resString;
    }
    
    function updateBuilder($dbname, $arr, $condition = null){
        $postset = "";
        foreach($arr as $ar => $val){
			if ($val !== ''){
				$postset .= "$ar = '$val',";
			}else{
				$postset .= "$ar = null,";
			}
        }
        $postset = substr($postset,0,-1);
        $res = "update $dbname set $postset";
		if (isset($condition)){
			 $res .= " where $condition";
		}
        return $res;
    }
	// -------------------------------------------------------------------------------------------
	// Table Builder
	// -------------------------------------------------------------------------------------------
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
	// -------------------------------------------------------------------------------------------
	// Plain DataTable Builder (for DataTables.js)
	// -------------------------------------------------------------------------------------------
	function datatable_plain($id, $db, $footer = true){
		echo "<table id='$id' class='table table-striped' style='border: 1px solid black'>";
		$i = 0;
		foreach($db as $d) {
			if ($i == 0){
				// Header
				echo "<thead><tr>";
				foreach($d as $key => $value){
					echo "<th>$key</th>";
				}
				
				echo "</tr></thead>";
				// Footer
				if($footer){
					echo "<tfoot><tr>";
					foreach($d as $key => $value){
						echo "<th>$key</th>";
					}
					
					echo "</tr></tfoot><tbody>";
				}else{
					echo "<tbody>";
				}

			}
			
			// Isi
			$j = 0;
			echo "<tr>";
			foreach($d as $key => $val){
				if ($j == 0){
					$no = $i + 1;
					$actualid = $val;
					echo "<td class='isitabel-$i' id='$key-$i' actualid='$actualid'>$no</td>";
				}else{
					echo "<td class='isitabel-$i' id='$key-$i' aidi='$key'>$val</td>";
				}
				$j += 1;
			}
			echo"</tr>";
			$i += 1;
		}
		echo "</tbody><table>";
	}
	// -------------------------------------------------------------------------------------------
	// DataTable Builder based on query
	// -------------------------------------------------------------------------------------------
	function tableQuery($id, $kue){
		$result = $this->db->query($kue);
		$db = $result->result();
		$this->datatable_plain($id, $db);
	}
	// -------------------------------------------------------------------------------------------
	// DataTable Builder with edit button
	// -------------------------------------------------------------------------------------------
	function datatable_edit($id, $db){
		echo "<table id='$id' class='table table-striped' style='border: 1px solid black'>";
		$i = 0;
		foreach($db as $d) {
			// Header
			if ($i == 0){
				$j = 0;
				echo "<thead><tr>";
				foreach($d as $key => $value){
					if ($j == 1){
						echo "<th>Edit</th><th>$key</th>";
					}else{
						echo "<th>$key</th>";
					}
					$j += 1;
				}
				echo "</tr></thead>";
				echo "<tfoot><tr>";
				$j = 0;
				foreach($d as $key => $value){
					if ($j == 1){
						echo "<th>Edit</th><th>$key</th>";
					}else{
						echo "<th>$key</th>";
					}
					$j += 1;
				}
				echo "</tr></tfoot>";
				
				echo "<tbody>";
			}
			
			// Isi
			$j = 0;
			echo "<tr>";
			foreach($d as $key => $val){
				if ($j == 0){
					$no = $i + 1;
					$actualid = $val;
					echo "<td class='isitabel-$i' id='$key-$i' actualid='$actualid'>$no</td>";
				}else if ($j == 1){
					echo "<td><button class='table_button tombolan' id='tombol-ke-$i' actualid='$actualid'>Edit</button><td class='isitabel-$i' id='$key-$i'>$val</td>";
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
	// -------------------------------------------------------------------------------------------
	// DataTable Builder with checkbox 
	// -------------------------------------------------------------------------------------------
	function datatable_checker($id, $db, $option = array()){
		echo "<table id='$id' class='table table-striped' style='border: 1px solid black'>";
		$i = 0;
		
		$size = count($db);
		echo "<script>";
		echo "function check_change(x){
				if (document.getElementById('check-'+x).checked) {
					$('#row-'+x).addClass('checked');
				}else{
					$('#row-'+x).removeClass('checked');
				};
		};
		";
		
		$default = array( "highlight" => "gray", "vocab_check" => "Check");
		$option = array_merge($default, $option);
		
		$highlight = $option['highlight'];
		$check = $option['vocab_check'];
		
		echo "<script>\n";
		echo "var hidden_json = {};\n";
		echo "function check_change(n){
			if (document.getElementById('check-' + n).checked) {
				$('#row-' + n).addClass('checked');
				hidden_json['check-' + n] = ($('#check-' + n).val());
			}else{
				$('#row-' + n).removeClass('checked');
				delete hidden_json['check-' + n];
			};
		};";
		echo "</script>\n";
		foreach($db as $d) {
			if ($i == 0){
				
				// Header
				$j = 0;
				echo "<thead><tr>";
				foreach($d as $key => $value){
						if ($j == 1){
							echo "<th class='check_label'>$check</th><th>$key</th>";
						}else{
							echo "<th>$key</th>";
						}
						$j += 1;
					}
				echo "</tr></thead>";
				
				// Footer
				$j = 0;
				echo "<tfoot><tr>";
				foreach($d as $key => $value){
						if ($j == 1){
							echo "<th class='check_label'>$check</th><th>$key</th>";
						}else{
							echo "<th>$key</th>";
						}
						$j += 1;
					}
				echo "</tr></tfoot><tbody>";
			}
			
			// Isi
			$j = 0;
			echo "<tr id='row-$i'>";
			foreach($d as $key => $val){
				if ($j == 0){
					$no = $i + 1;
					$actualid = $val;
					echo "<td id='$key-$i'>$no</td>";
				}else if ($j == 1){
					echo "<td><input id='check-$i' type='checkbox' value='$actualid' class='checkbox' onchange='check_change(\"$i\")'></td><td id='$key-$i'>$val</td>";
				}else{
					echo "<td id='$key-$i'>$val</td>";
				}
				$j += 1;
			}
			echo"</tr>";
			$i += 1;
		}
		echo "</tbody><table>";
	}
	// -------------------------------------------------------------------------------------------
	// DataTable Builder with radio button
	// -------------------------------------------------------------------------------------------
	function datatable_radio($id, $db, $option = array()){
		echo "<table id='$id' class='table table-striped' style='border: 1px solid black'>";
		$i = 0;
		
		$default = array( "highlight" => "gray", "vocab_radio" => "Select");
		$option = array_merge($default, $option);
		
		$highlight = $option['highlight'];
		$select = $option['vocab_radio'];
		
		echo "<script>\n";
		echo "var selected_radio = 0;\n";
		echo "function check_change(n){
			$('.highlight').each(function(){
				$(this).removeClass('checked');
			});
			if (document.getElementById('radio-' + n).checked) {
				$('#row-' + n).addClass('checked');
				selected_radio = $('#radio-' + n).attr('value');
			};
		};";
		echo "</script>\n";
		echo "<style>
		table.dataTable .checked {
			background-color: $highlight;
		}
		</style>";
		foreach($db as $d) {
			if ($i == 0){
				
				// Header
				$j = 0;
				echo "<thead><tr>";
				foreach($d as $key => $value){
						if ($j == 1){
							echo "<th>$select</th><th>$key</th>";
						}else{
							echo "<th>$key</th>";
						}
						$j += 1;
					}
				echo "</tr></thead>";
				
				// Footer
				$j = 0;
				echo "<tfoot><tr>";
				foreach($d as $key => $value){
						if ($j == 1){
							echo "<th>$select</th><th>$key</th>";
						}else{
							echo "<th>$key</th>";
						}
						$j += 1;
					}
				echo "</tr></tfoot><tbody>";
			}
			
			// Isi
			$j = 0;
			echo "<tr id='row-$i' class='highlight'>";
			foreach($d as $key => $val){
				if ($j == 0){
					$no = $i + 1;
					$actualid = $val;
					echo "<td id='$key-$i'>$no</td>";
				}else if ($j == 1){
					echo "<td><input id='radio-$i' type='radio' value='$actualid' name='proj_radio' onchange='check_change(\"$i\")'></td><td id='$key-$i'>$val</td>";
				}else{
					echo "<td id='$key-$i'>$val</td>";
				}
				$j += 1;
			}
			echo"</tr>";
			$i += 1;
		}
		echo "</tbody><table>";
	}
	// -------------------------------------------------------------------------------------------
	// DataTable Builder with edit and check
	// -------------------------------------------------------------------------------------------
	function datatable_edit_and_check($id, $db, $option = array()){
		echo "<table id='$id' class='table table-striped' style='border: 1px solid black'>";
		$i = 0;
		
		$default = array( "highlight" => "gray", "vocab_check" => "Check", "vocab_edit" => "Edit" );
		$option = array_merge($default, $option);
		
		$highlight = $option['highlight'];
		$check = $option['vocab_check'];
		$edit = $option['vocab_edit'];
		
		echo "<script>\n";
		echo "var hidden_json = {};\n";
		echo "function check_change(n){
			if (document.getElementById('check-' + n).checked) {
				$('#row-' + n).addClass('checked');
				hidden_json['check-' + n] = ($('#check-' + n).val());
			}else{
				$('#row-' + n).removeClass('checked');
				delete hidden_json['check-' + n];
			};
		};";
		echo "</script>\n";
		foreach($db as $d) {
			if ($i == 0){
				
				// Header
				$j = 0;
				echo "<thead><tr>";
				foreach($d as $key => $value){
						if ($j == 1){
							echo "<th class='check-column'>$check</th><th class='edit-column'>$edit</th><th class='header-no-$j'>$key</th>";
						}else{
							echo "<th class='header-no-$j'>$key</th>";
						}
						$j += 1;
					}
				echo "</tr></thead>";
				
				// Footer
				$j = 0;
				echo "<tfoot><tr>";
				foreach($d as $key => $value){
						if ($j == 1){
							echo "<th>$check</th><th>$edit</th><th>$key</th>";
						}else{
							echo "<th>$key</th>";
						}
						$j += 1;
					}
				echo "</tr></tfoot><tbody>";
			}
			
			// Isi
			$j = 0;
			echo "<tr id='row-$i'>";
			foreach($d as $key => $val){
				if ($j == 0){
					$no = $i + 1;
					$actualid = $val;
					echo "<td id='$key-$i' class='column-no-$j'>$no</td>";
				}else if ($j == 1){
					echo "<td><input id='check-$i' type='checkbox' value='$actualid' class='checkbox' onchange='check_change(\"$i\")'></td><td><input type='button' id='button-$i' value='Edit' realid='$actualid' class='table_button tombolan'></td><td id='$key-$i' class='column-no-$j'>$val</td>";
				}else{
					echo "<td id='$key-$i' class='column-no-$j'>$val</td>";
				}
				$j += 1;
			}
			echo"</tr>";
			$i += 1;
		}
		echo "</tbody><table>";
	}
	
} ?>