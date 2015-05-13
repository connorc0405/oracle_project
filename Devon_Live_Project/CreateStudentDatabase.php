<!DOCTYPE html>
<html>
<meta charset="UTF-8">
	<head>
		<title>Studentdatabase Created</title>
	</head>

	<body>
		<center>
		<img src="AMSA_logo.jpg" style="width:500px;height:225px">
			<br><br>
					<?php

						$conn = new mysqli("localhost","root","");
						if ($conn->connect_error) {
				    		die("Connection failed: " . $conn->connect_error);
						} 

						$sql = "CREATE DATABASE StudentDatabase";
						if ($conn->query($sql) === TRUE) {
						    echo "'Studentdatabase' created successfully";
						} else {
						    echo "Error creating database: " . $conn->error;
						}
						
						$conn->close();

					?>
			
			<br><br><br><br>
			<form action="Homepage.html" method="post" enctype="multipart/form-data">
				<input id="submit" type="submit" value="Home">
			</form>

		</center>
	</body>
</html>