<?php
	$servername = "localhost";
	$usernamedb = "root";
	$password = "";
	$dbname = "data";

	$conn = mysqli_connect($servername, $usernamedb, $password, $dbname);

	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
?>