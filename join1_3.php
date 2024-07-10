<?php
include "db_conn.php";

$table1 = "m1";
$table2 = "m3";
$join1 = "a";
$join2 = "a";

//검색기능
if (isset($_POST['search'])) {
    $searchValue = $_POST['searchValue'];
    $searchAttribute = $_POST['searchAttribute'];
    $selectAttributes = array('관광상품번호ID', '축제명', '시작일자', '종료일자', '개최장소ID'. '장소');
    
    if (in_array($searchAttribute, $selectAttributes)) {
        $query = "SELECT * FROM $table1 INNER JOIN $table2 ON $join1 = $join2 WHERE $searchAttribute LIKE '%$searchValue%'";
    } else {
        $query = "SELECT * FROM $table1 INNER JOIN $table2 ON $join1 = $join2 WHERE $searchAttribute = '$searchValue'";
    }
    $result = mysqli_query($conn, $query);
} else {
    $query = "SELECT * FROM $table1 INNER JOIN $table2 ON $join1 = $join2";
    $result = mysqli_query($conn, $query);
}

//삭제기능
if (isset($_POST['delete'])) {
    $deleteValue = $_POST['deleteValue'];
    $deleteAttribute = $_POST['deleteAttribute'];
    $deleteQuery = "DELETE FROM $table1 INNER JOIN $table2 ON $join1 = $join2 WHERE $deleteAttribute = '$deleteValue'";
    mysqli_query($conn, $deleteQuery);
    $query = "SELECT * FROM $table1 INNER JOIN $table2 ON $join1 = $join2";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html language="UTF-8">

	<head>
		<meta charset="UTF-8">
	</head>

	<body>
		
		<h1>축제장소 조회</h1>
		<form method="post">
			<input type="submit" name="showAll" value="전체 테이블 조회">
		</form>
		<!-- 검색모듈 -->
		<h3>검색</h3>
		
		<form method="post">
        <label for="searchAttribute">검색: </label>
        <select name="searchAttribute" id="searchAttribute">
            <option value="축제명">축제명</option>
            <option value="관광상품번호ID">관광상품번호ID</option>
            <option value="시작일자">시작일자</option>
            <option value="종료일자">종료일자</option>
            <option value="개최장소ID">개최장소ID</option>
            <option value="장소">장소</option>
        </select>

        <label for="searchValue">검색 값:</label>
        <input type="text" name="searchValue" id="searchValue">
        <input type="submit" name="search" value="검색">
		</form>
		
		<!-- 삭제모듈 -->
		<h3>삭제</h3>
		<form method="post">
        <label for="deleteAttribute">삭제: </label>
        <select name="deleteAttribute" id="deleteAttribute">
            <option value="축제명">축제명</option>
            <option value="관광상품번호ID">관광상품번호ID</option>
            <option value="시작일자">시작일자</option>
            <option value="종료일자">종료일자</option>
            <option value="개최장소ID">개최장소ID</option>
            <option value="장소">장소</option>
        </select>

        <label for="deleteValue">삭제 값:</label>
        <input type="text" name="deleteValue" id="deleteValue">
        <input type="submit" name="delete" value="삭제">
		</form>
		
		
		<?php
		if (isset($_POST['search']) || isset($_POST['showAll']) || isset($_POST['delete'])) 
		?> <!-- 검색/전체검색/삭제 시 테이블을 출력 -->
		<table border=1>
			<!-- 헤더 -->
			<tr>
				<th>축제명</th>
				<th>관광상품번호ID</th>
				<th>시작일자</th>
				<th>종료일자</th>
				<th>개최장소ID</th>
				<th>조회</th>
			</tr>
			<?php
				//join한 객체들
				while($row = mysqli_fetch_array($result)) {
					$n1 = $row['개최장소ID'];
					$n2 = $row['관광상품번호ID'];
					$n3 = $row['시작일자'];
					$n4 = $row['종료일자'];
					$n5 = $row['축제명'];
					$n6 = $row['조회'];
			?>
				<tr>
						<td><?php echo $n1; ?></td>
						<td><?php echo $n2; ?></td>
						<td><?php echo $n3; ?></td>
						<td><?php echo $n4; ?></td>
						<td><?php echo $n5; ?></td>
						<td><?php echo $n6; ?></td>
				</tr>
			<?php
				} mysqli_close($conn);
			?>
		</table>
	</body>
</html>