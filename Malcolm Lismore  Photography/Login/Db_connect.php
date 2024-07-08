<?php 
	
	$server = "localhost";
	$username = "root";
	$password = "";
	$db_name = "mydb_97";

	$con = mysqli_connect($server,$username,$password,$db_name);

	if (!$con) {
		die("Connection Failed !!!");
	}else {
		// echo "Successfully Connected !!!";
	}

 ?>