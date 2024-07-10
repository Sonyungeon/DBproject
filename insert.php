<?php
include 'db_conn.php';
if(isset($_POST['submit'])){
	if(($users_file = fopen("./Ydata/m1.csv", "r")) !== FALSE)
	{
		$row = 1;
		while(($data= fgetcsv($users_file, 30000, ','))){	
			$관광상품번호ID = $data[0];
			$축제명 = $data[1];
			$시작일자 = $data[2];
			$종료일자 = $data[3];
			$축제내용 = $data[4];
			$데이터기준일자 = $data[5];
			$query = "INSERT INTO m1 (관광상품번호ID, 축제명, 시작일자, 종료일자, 축제내용, 데이터기준일자) 
			VALUES('".$관광상품번호ID."', '".$축제명."', '".$시작일자."', '".$종료일자."', '".$축제내용."', '".$데이터기준일자."')";
			mysqli_query($conn, $query);
		}
	}
	fclose($users_file);
}
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	
		<a href= "display.php">Data Display</a>
	</body>
</html>
</html>