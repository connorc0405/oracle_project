<!DOCTYPE html>
<html>
<meta charset="UTF-8">
	<head>
		<title>Student Profile</title>
	</head>

	<body>

			<?php
				$link = mysqli_connect("localhost","root","","StudentDatabase");


				$id=$_POST['id'];

				//checks if there is an existing student or character is valid
				//displays error if either is not true
				if($id == NULL OR (!(is_numeric($id)))){
					echo "<center><img src='AMSA_logo.jpg' style='width:500px;height:225px'>
					<br><br>You failed to enter a valid student id.<br><br>
					<br><br><br><br>

					<form action='StudentLogInfoLookUp.php' method='post' 
					enctype='multipart/form-data'>
						<input type='submit' value='Look Up Another Student'>
					</form>

					<br><br>
					<form action='Homepage.html' method='post' 
					enctype='multipart/form-data'>
					<input id='submit' type='submit' value='Home'>
					</form></center><!--";
				}

				$sql = "Select * from students where student_id=$id";
				$result = mysqli_query($link, $sql);
				$row = mysqli_fetch_assoc($result);
			?>

		<center>
			<img src="AMSA_logo.jpg" style="width:500px;height:225px">

			<?php
				if($row['student_id'] == NULL){
					echo "<br><br>No student exists.<br><br>
					<br><br><br><br>

					<form action='StudentLogInfoLookUp.php' method='post' 
					enctype='multipart/form-data'>
						<input type='submit' value='Look Up Another Student'>
					</form>

					<br><br>
					<form action='Homepage.html' method='post' 
					enctype='multipart/form-data'>
					<input id='submit' type='submit' value='Home'>
					</form><!--";
				}  
			?>

			<table>
				<tr>
					<td>
						<img src="<?php echo $row["img_path"]; ?>" style="width:250px;height:300px">
					</td>
				</tr>
			</table>


			<table>
				<tr>
					<td>
						<h1><?php echo $row["lname"]; ?>, </h1>
					</td>
					<td>
						<h1><?php echo $row["fname"]; ?></h1>
					</td>
				</tr>
			</table>

			<table border="1" style="border:2px solid black">
				<tr>
					<td style="width:140px">
						<h3>Student Id</h3>
					</td>
					<td style="width:70px">
						<h3>Gender</h3>
					</td>
					<td style="width:140px">
						<h3>Homeroom</h3>
					</td>
					<td style="width:140px">
						<h3>Graduating Year</h3>
					</td>
					<td style="width:140px">
						<h3>Date of Birth</h3>
					</td>
				</tr>
				<tr>
					<td style="width:140px">
						<p><?php echo $row["student_id"]; ?></p>
					</td>
					<td style="width:140px">
						<p><?php echo $row["gender"]; ?></p>
					</td>
					<td style="width:140px">
						<p><?php echo $row["homeroom"]; ?></p>
					</td>
					<td style="width:140px">
						<p><?php echo $row["gradyear"]; ?></p>
					</td>
					<td style="width:140px">
						<p><?php echo $row["dob"]; ?></p>
					</td>
				</tr>
			</table>
			<br><?php
				if($row["active_status"]==1){
					echo "Enrollment status: Student is currently enrolled";
				}
				else{
					echo "Enrollment status: Student is not currently enrolled";
				}
			?>

			<br><br><br>
			<h4>Classes</h4>

			<table border="1" style="border:1px solid black">
			<tr>
				<td>
					<b>Course Id</b>
				</td>
				<td>
					<b>Course Name</b>
				</td>
				<td>
					<b>Teacher</b>
				</td>
				<td>
					<b>Room Number</b>
				</td>
				<td>
					<b>Period</b>
				</td>
			</tr>

			<?php
			//build classes table
				$classes = $row["classes"];
				$link2 = mysqli_connect("localhost","root","","StudentDatabase");
				$tempStr = "";
				$count=(int)strlen($classes);

				while($count>-1){
					if(substr($classes, $count-1)===","){
						$tempInt = (int)$tempStr;
						$sql2 = "Select * from courses where course_id=$tempInt";
						$result2 = mysqli_query($link2, $sql2);
						$row2 = mysqli_fetch_assoc($result2);

						$course_id = $row2["course_id"];
						$class_name = $row2["class_name"];
						$teacher = $row2["teacher"];
						$room_num = $row2["room_num"];
						$period = $row2["period"];

						$tempStr = "";

						echo "<tr>
								<td>$course_id</td>
								<td>$class_name</td>
								<td>$teacher</td>
								<td>$room_num</td>
								<td>$period</td>
							</tr>";

						$classes=substr($classes, 0, $count-1);	
						$count2=$count-1;
						$count=$count2;
					}
					else if($count==0){
						$tempInt = (int)$tempStr;
						$sql2 = "Select * from courses where course_id=$tempInt";
						$result2 = mysqli_query($link2, $sql2);
						$row2 = mysqli_fetch_assoc($result2);

						$course_id = $row2["course_id"];
						$class_name = $row2["class_name"];
						$teacher = $row2["teacher"];
						$room_num = $row2["room_num"];
						$period = $row2["period"];

						$tempStr = "";

						echo "<tr>
								<td>$course_id</td>
								<td>$class_name</td>
								<td>$teacher</td>
								<td>$room_num</td>
								<td>$period</td>
							</tr>";

						$classes=substr($classes, 0, $count-1);	
						$count2=$count-1;
						$count=$count2;
					}
					else{
						$tempStr .= substr($classes, $count-1);
						$classes=substr($classes, 0, $count-1);
						$count2=$count-1;
						$count=$count2;
					}
				}

				?>
			</table>

			<br><br>
			<form action="EditStudentProfile.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
				<input type="submit" value="Edit Student">
			</form>

			<br><br><br><br>

			<form action="StudentLogInfoLookUp.php" method="post" enctype="multipart/form-data">
				<input type="submit" value="Look Up Another Student">
			</form>

			<br><br>
			<form action="Homepage.html" method="post" enctype="multipart/form-data">
			<input id="submit" type="submit" value="Home">
			</form>

		<center>

	</body>
</html>