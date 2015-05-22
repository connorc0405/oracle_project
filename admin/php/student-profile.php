<!DOCTYPE html>
<html>
<meta charset="UTF-8">
	<head>
		<title>Student Profile</title>
	</head>

	<body>

			<?php
				$link = mysqli_connect("localhost","root","","StudentDatabase");

				$sql = "Select * from students where student_id=(
					Select max(student_id) From students)";
				$result = mysqli_query($link, $sql);
				$row = mysqli_fetch_assoc($result);
				//create student id
				$id=(int)$row["student_id"]+1;

				//image file path
				$file = $_FILES["image"];
				$name = $file['name'];
				$path = "/DevonThyne/StudentImages/".basename($name);

				$target_dir = "C://xampp/htdocs/Ryan_Dean/oracle_project/admin/php/StudentImages/";
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


				$adds['fname'] = $link->real_escape_string($_POST['fname']);
				$adds['lname'] = $link->real_escape_string($_POST['lname']);
				$adds['gender'] = $link->real_escape_string($_POST['gender']);
				$adds['homeroom'] = $link->real_escape_string($_POST['homeroom']);
				$adds['gradyear'] = $link->real_escape_string($_POST['gradyear']);
				$adds['dob'] = $link->real_escape_string($_POST['dob']);
				$adds['classes'] = $link->real_escape_string($_POST['classes']);
				$adds['img_path'] = $link->real_escape_string($path);

				//insert all data as new row in students table
				mysqli_query($link,"INSERT INTO students (`student_id`, `fname`, 
					`lname`, `gender`, `homeroom`, `gradyear`, `dob`, `classes`, `active_status`,
					`img_path`)
				VALUES ($id, '". $adds['fname']. "', '". $adds['lname']. "', '". $adds['gender']. "', 
					'". $adds['homeroom']. "', '". $adds['gradyear']. "', '". $adds['dob']. "',
					 '". $adds['classes']. "', 'TRUE', '". $adds['img_path']. "')") 
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
						//get image path
						$img_path = (string)$row['img_path'];
						?>
						<img src="<?php echo $img_path; ?>" alt="Nope" style="width:250px;height:300px">
					</td>
				</tr>
			</table>

			<table>
				<tr>
					<td>
						<h1><?php echo $_POST["lname"]; ?>, </h1>
					</td>
					<td>
						<h1><?php echo $_POST["fname"]; ?></h1>
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
						<p><?php echo $_POST["gender"]; ?></p>
					</td>
					<td style="width:140px">
						<p><?php echo $_POST["homeroom"]; ?></p>
					</td>
					<td style="width:140px">
						<p><?php echo $_POST["gradyear"]; ?></p>
					</td>
					<td style="width:140px">
						<p><?php echo $_POST["dob"]; ?></p>
					</td>
				</tr>
			</table>

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
			//create classes table
				$classes = $_POST["classes"];
				$link = mysqli_connect("localhost","root","","StudentDatabase");
				$tempStr = "";
				//counter to travers classes string
				$count=(int)strlen($classes);

				while($count>-1){
					if(substr($classes, $count-1)===","){
						$tempInt = (int)$tempStr;
						$sql = "Select * from courses where course_id=$tempInt";
						$result = mysqli_query($link, $sql);
						$row = mysqli_fetch_assoc($result);

						$course_id = $row["course_id"];
						$class_name = $row["class_name"];
						$teacher = $row["teacher"];
						$room_num = $row["room_num"];
						$period = $row["period"];

						$tempStr = "";

						//make row in classes table
						echo "<tr>
								<td>$course_id</td>
								<td>$class_name</td>
								<td>$teacher</td>
								<td>$room_num</td>
								<td>$period</td>
							</tr>";

						//take class entry out of string
						$classes=substr($classes, 0, $count-1);	
						$count2=$count-1;
						$count=$count2;
					}
					else if($count==0){
						$tempInt = (int)$tempStr;
						$sql = "Select * from courses where course_id=$tempInt";
						$result = mysqli_query($link, $sql);
						$row = mysqli_fetch_assoc($result);

						$course_id = $row["course_id"];
						$class_name = $row["class_name"];
						$teacher = $row["teacher"];
						$room_num = $row["room_num"];
						$period = $row["period"];

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

			<form action="StudentLogInfoWebpage.php" method="post" enctype="multipart/form-data">
				<input type="submit" value="Enter New Student">
			</form>

			<br><br>
			<form action="Homepage.html" method="post" enctype="multipart/form-data">
			<input id="submit" type="submit" value="Home">
			</form>

		</center>

	</body>
</html>