<!DOCTYPE html>
<html>
<meta charset="UTF-8">
	<head>
		<title>New Student Login</title>
	</head>

	<body>
		<center>
			<img src="AMSA_logo.jpg" style="width:500px;height:225px">
			<br>
			<h2 id="heading">Student Registration</h2>
			<br>

			<form action="StudentProfile.php" method="post" enctype="multipart/form-data">
  			<table id="StudentInfo">
  				<tr>
  					<td>First name: <input type="text" name="fname"><br><br></td>
  				</tr>
  				<tr>
 					<td>Last name: <input type="text" name="lname"><br><br></td>
  				</tr>
  				<tr>
 					<td>Gender: <input type="text" id="gender" name="gender"><br><br></td>
  				</tr>
 				<tr>
 					<td>Homeroom:  <input type="text" id="homeroom" name="homeroom"><br><br></td>
  				</tr>
 				<tr>
 					<td>Graduating year:  <input type="text" id="gradyear" name="gradyear"><br><br></td>
  				</tr>
 				<tr>
 					<td>Date of birth: <input type="date" id="dob" name="dob"><br><br></td>
  				</tr>
			
			</table>

			<br>

			<b>Current Courses Avalible:</b>
			
			<style type="text/css">
				tr.top td { border-top: thin solid black; }
				tr.bottom td { border-bottom: thin solid black; }
				tr.row td:first-child { border-left: thin solid black; }
				tr.row td:last-child { border-right: thin solid black; }
			</style>

			<table>
				<tr class="top bottom row">
					<td style="width:140px">Course Id</td>
					<td style="width:140px">Class Name</td>
					<td style="width:140px">Teacher</td>
					<td style="width:140px">Room Number</td>
					<td style="width:140px">Period</td>
				</tr>

			<?php
			//build table of existing courses availible
				$link = mysqli_connect("localhost","root","","StudentDatabase");
				$sql = "Select * from courses where course_id=(
					Select max(course_id) From courses)";
				$result = mysqli_query($link, $sql);
				$row = mysqli_fetch_assoc($result);
				$count=(int)$row["course_id"];
				while($count>0){
					$sql = "Select course_id, class_name, teacher, room_num, period from courses where
					course_id=$count";
					$result = mysqli_query($link, $sql);
					$row = mysqli_fetch_assoc($result);
					$course_id=$row["course_id"];
					$class_name=$row["class_name"];
					$teacher=$row["teacher"];
					$room_num=$row["room_num"];
					$period=$row["period"];
					echo "<tr><td>$course_id</td><td>$class_name</td><td>$teacher</td><td>$room_num</td>
					<td>$period</td></tr>";
					$count=$count-1;
				}

			?>
			</table>


			<br>
			<h4>Choose Classes:</h4>
			
			<p>Input list of class id's separated by a comma and NO spaces (ex: 1,2,3)</p>
			<input type="text" name="classes"> 

			<br><br><br><br>

			Select image to upload:
				<input type="hidden" name="MAX_FILE_SIZE" value="2097152" > 
    		<input type="file" accept="image/jpeg" name="image" id="image">

			<br><br><br><br>
			<input id="submit" type="submit" value="Submit" name="submit">
			</form>

			<br><br>

			<form action="Homepage.html" method="post" enctype="multipart/form-data">
				<input id="submit" type="submit" value="Home">
			</form>

		</center>
	</body>
</html>