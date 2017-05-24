<?php $base = base_url()?>
<link rel="stylesheet" type="text/css" href="<?php echo $base?>asset/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base?>asset/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base?>asset/bootstrap-datepicker.min.css"/>
<script src="<?php echo $base?>asset/jquery-3.2.0.min"></script>
<script src="<?php echo $base?>asset/basic.js"></script>
<script src="<?php echo $base?>asset/datatables"></script>
<script src="<?php echo $base?>asset/bootstrap.min.js"></script>
<script src="<?php echo $base?>asset/bootstrap-datepicker.min.js"></script>
<style>
.navbar-default .navbar-nav>li>a {
    color: white;
}

.navbar-default .navbar-nav>li>a:hover {
    color: yellow;
}

#kepala {
  background: #4765A4; /* For browsers that do not support gradients */
  background: -webkit-linear-gradient(left, #082D7D, #4765A4); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(right, #082D7D, #4765A4); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(right, #082D7D, #4765A4); /* For Firefox 3.6 to 15 */
  background: linear-gradient(to right, #082D7D, #4765A4); /* Standard syntax */
}

.tombolan {
  display: inline-block;
  font-size: 15px;
  padding: 5px 15px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4765A4;
  border: none;
  border-radius: 5px;
  box-shadow: 0 1px #AAA;
}

.tombolan:hover {background-color: #D3B100}

.tombolan:active {
  background-color: #BB9D00;
  transform: translateY(1px);
  box-shadow: 0 0px #AAA;
}

.hidden {
	display: none;
}

.tdinput {
	padding-left: 5px;
}

.inputan, .inputanx, .aidi, .input_com, textarea {
	width: 100%; 
    border: 1px solid #ccc; 
    border-radius: 4px; 
	padding: 5px;
	color: #555;
}

input[type=text]:focus {
	border: 2px solid #BB4E00;
	border-radius: 4px; 
}

.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
	background-color: #4765A4;
	border-color: #0C358D;
}

table.dataTable thead, table.dataTable tfoot {
	background: #4765A4;
	color: #FFF7CE;
	font-size: 14px;
}

</style>
<!--- 
Color palette : http://paletton.com/#uid=33K0x0kvButk4uKp9uq-HqvGtnx
--->