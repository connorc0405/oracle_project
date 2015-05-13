<!DOCTYPE html>
<html>
<meta charset="UTF-8">
	<head>
		<title>Student Table Created</title>
	</head>

	<body>
		<center>
		<img src="AMSA_logo.jpg" style="width:500px;height:225px">
			<br>
		<br><br>
			
			<?php
						$link = mysqli_connect("localhost","root","","StudentDatabase");

						if(table_exists('students', 'StudentDatabase')) {
							echo "Table already exists";
						}
						else{
							mysqli_query($link,"CREATE TABLE students (student_id INT(6) PRIMARY KEY, 
								fname VARCHAR(30) NOT NULL, lname VARCHAR(30) NOT NULL, 
								gender VARCHAR(6) NOT NULL, homeroom VARCHAR(30) NOT NULL, 
								gradyear INT(4) NOT NULL, dob DATE NOT NULL, classes VARCHAR(30),
								active_status BIT NOT NULL, img_path VARCHAR(256))")
								or die(mysqli_error($link));

							echo "Table Edit Successful";
						}

						function table_exists($table, $database) { 
						    mysql_connect('localhost', 'root', '') or die(mysql_error()); 
						    mysql_select_db($database) or die(mysql_error()); 
						    if (mysql_query("SELECT 1 FROM `".$table."` LIMIT 0")) { 
						        return true; 
						    } 
						    else { 
						        return false; 
						    } 
						}						
			?>

			<br><br><br><br>

			<form action="Homepage.html" method="post" enctype="multipart/form-data">
				<input id="submit" type="submit" value="Home">
			</form>

		</center>
	</body>
</html>