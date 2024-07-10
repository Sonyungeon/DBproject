<?php
include "db_conn.php";
//검색기능
if (isset($_POST['search'])) {
    $searchValue = $_POST['searchValue'];
    $searchAttribute = $_POST['searchAttribute'];
    $selectAttributes = array('Application_Date', 'Recuitment_Date', 'Registration_Date');
    
    if (in_array($searchAttribute, $selectAttributes)) {
        $query = "SELECT * FROM m2 WHERE $searchAttribute LIKE '%$searchValue%'";
    } else {
        $query = "SELECT * FROM m2 WHERE $searchAttribute = '$searchValue'";
    }
    $result = mysqli_query($conn, $query);
} else {
    $query = "SELECT * FROM m2";
    $result = mysqli_query($conn, $query);
}

//삭제기능
if (isset($_POST['delete'])) {
    $deleteValue = $_POST['deleteValue'];
    $deleteAttribute = $_POST['deleteAttribute'];
    $deleteQuery = "DELETE FROM m2 WHERE $deleteAttribute = '$deleteValue'";
    mysqli_query($conn, $deleteQuery);
    $query = "SELECT * FROM m2";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html language="UTF-8">
	<?php
		include "db_conn.php";
	?>
	<head>
		<meta charset="UTF-8">
	</head>

	<body>
		
		
		
		<form method="post">
			<input type="submit" name="showAll" value="전체 테이블 조회">
		</form>
		<!-- 검색모듈 -->
		<h3>검색</h3>
		
		<form method="post">
        <label for="searchAttribute">검색: </label>
        <select name="searchAttribute" id="searchAttribute">
            <option value="기관ID">기관ID</option>
            <option value="전화번호">전화번호</option>
            <option value="주관기관">주관기관</option>
            <option value="도로명">도로명주소</option>
            <option value="우편번호">우편번호</option>
            <option value="주최기관">주최기관</option>
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
            <option value="기관ID">기관ID</option>
            <option value="전화번호">전화번호</option>
            <option value="주관기관">주관기관</option>
            <option value="도로명">도로명주소</option>
            <option value="우편번호">우편번호</option>
            <option value="주최기관">주최기관</option>
        </select>

        <label for="deleteValue">삭제 값:</label>
        <input type="text" name="deleteValue" id="deleteValue">
        <input type="submit" name="delete" value="삭제">
		</form>
		
		
		<h2>주관기관 테이블 조회</h2>
		<?php
		if (isset($_POST['search']) || isset($_POST['showAll']) || isset($_POST['delete'])) 
		?> <!-- 검색/전체검색/삭제 시 테이블을 출력 -->
		<table border=1>
			<!-- 헤더 -->
			<tr>
				<th>기관ID</th>
				<th>전화번호</th>
				<th>주관기관</th>
				<th>도로명주소</th>
				<th>우편번호</th>
				<th>주최기관</th>
			</tr>
			<?php
				//출력할 m2 객체들
				while($row = mysqli_fetch_array($result)) {
					$n1 = $row['기관ID'];
					$n2 = $row['전화번호'];
					$n3 = $row['주관기관'];
					$n4 = $row['도로명'];
					$n5 = $row['우편번호'];
					$n6 = $row['주최기관'];
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
				}
			?>
		</table>
	</body>
</html>