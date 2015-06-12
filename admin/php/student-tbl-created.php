<!DOCTYPE html>
<html>
<meta charset="UTF-8">
	<head>
		<title>Student Table Created</title>
	</head>

	<body>
		<center>
		<!-- <img src="AMSA_logo.jpg" style="width:500px;height:225px"> -->
			<br>
		<br><br>
			
			<?php
						include_once('Database.php');
						Database::connect();
						Database::selectDatabase('studentdatabase');

						if(Database::table_exists('students')) {
							echo "Table already exists";
						}
						else{
							Database::createStudentTable();
						}					
			?>

			<br><br><br><br>

			<form action="Homepage.html" method="post" enctype="multipart/form-data">
				<input id="submit" type="submit" value="Home">
			</form>

		</center>
	</body>
</html>