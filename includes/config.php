<?php
	ob_start();
	session_start();
	date_default_timezone_set("Asia/Tehran");
	$user = "root";
	$pass = "";
	try {
		$con = new PDO('mysql:host=localhost;dbname=netflix', $user, $pass);
		$con-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	catch (PDOException $e){
		exit("Connection failed: ". $e->getMessage());
	}
?>