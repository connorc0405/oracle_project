<?php
	$conn = new mysqli("localhost","root","");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "CREATE DATABASE StudentDatabase";

	if ($conn->query($sql) === TRUE) {
		$conn->query('USE StudentDatabase');
		echo "Studentdatabase created successfully";
	} else {
		echo "Error creating database: " . $conn->error;
	}
	$conn->close();
?>

<!-- Maybe make this in the admin-home.html to avoid going to another page. -->