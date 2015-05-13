<!DOCTYPE html>
<html>
<meta charset="UTF-8">
	<head>
		<title>Student Profile</title>
	</head>

	<body>

			<?php
				$link = mysqli_connect("localhost","root","","StudentDatabase");

				$id = $_POST["id"];

				$sql = "Select * from students where student_id=$id";
				$result = mysqli_query($link, $sql);
				$row = mysqli_fetch_assoc($result);


				if($_FILES['image']['name'] == ""){
					$path=$row['img_path'];
				}
				else{
					$file = $_FILES["image"];

					$name = $file['name'];
					$path = "/DevonThyne/StudentImages/".basename($name);

					$target_dir = "C://xampp/htdocs/DevonThyne/StudentImages/";
					$target_file = $target_dir . basename($_FILES["image"]["name"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					if(isset($_POST["submit"])) {
					    $check = getimagesize($_FILES["image"]["tmp_name"]);
					    if($check !== false) {
					        $uploadOk = 1;
					    } else {
					        echo "File is not an image.";
					        $uploadOk = 0;
					    }
					}
					/* Check if file already exists
					if (file_exists($target_file)) {
					    echo "Sorry, file already exists.";
					    $uploadOk = 0;
					}*/
					 // Check file size
					if ($_FILES["image"]["size"] > 500000) {
					    echo "Sorry, your file is too large.";
					    $uploadOk = 0;
					 }
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					    $uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
					    echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
					} else {
					    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
					    } else {
					        echo "Sorry, there was an error uploading your file.";
					    }
					}
				}

				$adds['fname'] = $link->real_escape_string($_POST['fname']);
				$adds['lname'] = $link->real_escape_string($_POST['lname']);
				$adds['gender'] = $link->real_escape_string($_POST['gender']);
				$adds['homeroom'] = $link->real_escape_string($_POST['homeroom']);
				$adds['gradyear'] = $link->real_escape_string($_POST['gradyear']);
				$adds['dob'] = $link->real_escape_string($_POST['dob']);
				$adds['classes'] = $link->real_escape_string($_POST['classes']);
				if($_POST['active_status']==1){
					$adds['active_status'] = TRUE;
				}
				else{
					$adds['active_status'] = FALSE;
				}
				$adds['img_path'] = $link->real_escape_string($path);

				mysqli_query($link,"UPDATE students 
					SET `fname`='". $adds['fname']. "', `lname`='". $adds['lname']. "', 
						`gender`='". $adds['gender']. "', `homeroom`='". $adds['homeroom']. "',
						`gradyear`='". $adds['gradyear']. "', `dob`='". $adds['dob']. "', 
						`classes`='". $adds['classes']. "', `active_status`='". $adds['active_status']. "', 
						`img_path`='". $adds['img_path']. "'
					WHERE student_id=$id") 
				or die(mysqli_error($link));
			?>

		<center>
			<img src="AMSA_logo.jpg" style="width:500px;height:225px">

			<table>
				<tr>
					<td>
						<?php
						$link = mysqli_connect("localhost","root","","StudentDatabase");
						$sql = "Select * from students where student_id=$id";
						$result = mysqli_query($link, $sql);
						$row = mysqli_fetch_assoc($result);
						$img_path = (string)$row['img_path'];
						?>
						<img src="<?php echo $img_path; ?>" alt="Nope" style="width:250px;height:300px">
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
						<p><?php echo $id; ?></p>
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

			<br><br>
			<?php
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
				$classes = $row["classes"];
				$link = mysqli_connect("localhost","root","","StudentDatabase");
				$tempStr = "";
				$count=(int)strlen($classes);

				while($count>-1){
					if(substr($classes, $count-1)===","){
						$tempInt = (int)$tempStr;
						$sql = "Select * from courses where course_id=$tempInt";
						$result = mysqli_query($link, $sql);
						$row2 = mysqli_fetch_assoc($result);

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
						$sql = "Select * from courses where course_id=$tempInt";
						$result = mysqli_query($link, $sql);
						$row2 = mysqli_fetch_assoc($result);

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


			<br><br><br><br>

			<form action="EditStudentProfile.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<input type="submit" value="Make Another Change">
			</form>

			<br><br>

			<form action="StudentLogInfoLookup.php" method="post" enctype="multipart/form-data">
				<input type="submit" value="Look Up Another Student">
			</form>

			<br><br>
			<form action="Homepage.html" method="post" enctype="multipart/form-data">
			<input id="submit" type="submit" value="Home">
			</form>

		</center>

	</body>
</html>