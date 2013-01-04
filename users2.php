<?php 
	$host = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ma12forum";
	
	$dsn = "mysql:host=$host;dbname=$dbname"; //Data Source Name = Mysql
	$db = new PDO($dsn, $username, $password); //Connect to DB

	$userPart = $_POST['userPart'];
	$result = "SELECT name FROM users WHERE name LIKE ?";
	
	$stmt = $db->prepare($result);
	$searchvalue = "%".$userPart."%";
			$stmt->execute(array($searchvalue));
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0) {
	foreach ($rows AS $row) {
		echo "<div id='link' onClick='addText(\"".$row['name']."\");'>" . $row['name'] . "</div>";	
	}
	}
?>