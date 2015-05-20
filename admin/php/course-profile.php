

			<?php
				$link = mysqli_connect("localhost","root","","StudentDatabase");

				$sql = "Select * from courses where course_id=(
					Select max(course_id) From courses)";
				$result = mysqli_query($link, $sql);
				$row = mysqli_fetch_assoc($result);
				$id=(int)$row["course_id"]+1;     

				$adds['class_name'] = $link->real_escape_string($_POST['class_name']);
				$adds['teacher'] = $link->real_escape_string($_POST['teacher']);
				$adds['room_num'] = $link->real_escape_string($_POST['room_num']);
				$adds['period'] = $link->real_escape_string($_POST['period']);

				mysqli_query($link,"INSERT INTO courses (`course_id`, `class_name`, 
					`teacher`, `room_num`, `period`)
				VALUES ($id, '". $adds['class_name']. "', '". $adds['teacher']. "', 
					'". $adds['room_num']. "', '". $adds['period']. "')") 
				or die(mysqli_error($link));


			?>

		<center>
			<img src="AMSA_logo.jpg" style="width:500px;height:225px">

			<table>
				<tr>
					<td>
						<b>Class Created Successfully</b>
					</td>
				</tr>
				<tr>
					<td>
						<p>Course id: <?php echo $id?></p>
					</td>
				</tr>
				<tr>
					<td>
						<p>Course Name: <?php echo $_POST["class_name"]; ?></p>
					</td>
				</tr>
				<tr>
					<td>
						<p>Course Name: <?php echo $_POST["teacher"]; ?></p>
					</td>
				</tr>
				<tr>
					<td>
						<p>Course Name: <?php echo $_POST["room_num"]; ?></p>
					</td>
				</tr>
				<tr>
					<td>
						<p>Course Name: <?php echo $_POST["period"]; ?></p>
					</td>
				</tr>
			</table>

			<br><br>
			<form action="CourseLogInfoWebpage.php" method="post" enctype="multipart/form-data">
			<input id="submit" type="submit" value="Enter Another Class">
			</form>

			<br><br><br><br>
			<form action="Homepage.html" method="post" enctype="multipart/form-data">
			<input id="submit" type="submit" value="Home">
			</form>