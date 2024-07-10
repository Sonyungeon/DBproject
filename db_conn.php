<?php

	//db_conn.php ==> Connecting DB
	$host = 'localhost';
	$user = 'root';
	$password = '1234';
	$dbname = 'miryang_ft';
	
	$conn = mysqli_connect($host, $user, $password, $dbname); //DB와 php를 잇는 오브젝트
	
	if(!$conn){
		die('Coneection Failed: '.mysqli_connect_error());
	}
?>