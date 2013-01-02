<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ma12forum";
	
	$dsn = "mysql:host=$host;dbname=$dbname"; //Data Source Name = Mysql
	$db = new PDO($dsn, $username, $password); //Connect to DB
?>