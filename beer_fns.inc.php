<?php
	function db_connect(){
		$conn = new mysqli('localhost', '', '', '');
		if($conn){
			return $conn;
		} else {
			return false;
		}
	}
?>