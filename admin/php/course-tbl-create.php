<!DOCTYPE html>

	<head>
		<title>Courses Table Created</title>
	</head>

	<body>
		<center>
		<img src="AMSA_logo.jpg" style="width:500px;height:225px">
			<br>
		<br><br>
			
			<?php
						$link = mysqli_connect("localhost","root","","StudentDatabase");

						if(table_exists('courses', 'StudentDatabase')) {
							echo "Table already exists";
						}
						else{
							mysqli_query($link,"CREATE TABLE courses (course_id INT(6) PRIMARY KEY, 
								class_name VARCHAR(30) NOT NULL, teacher VARCHAR(30) NOT NULL, 
								room_num INT(6) NOT NULL, period INT(6) NOT NULL)")
							or die(mysqli_error($link));

							echo "Courses Table Created Successfully";
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