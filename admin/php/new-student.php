<div class="container">
<div class="row">
	<div class="col-xs-12" id="home-header">
		<h1>Course Registration</h1>
	</div>
</div>
<div class="row">
		<div class="col-xs-3"></div>
		<div class="col-xs-6 panel panel-default">
			<div class="panel-body">
			<h3>New Student</h3> 
				<form action="php/student-profile.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="fname" class="form-label">First Name</label>
						<input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name">
					</div>

					<div class="form-group">
						<label for="lname" class="form-label">Last Name</label>
						<input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Last Name">
					</div>

					<div class="form-group">
					<!-- **MAKE THIS A RADIO BUTTON ** -->
						<label for="gender" class="form-label">Gender</label>
						<input type="text" class="form-control" name="gender" id="gender" placeholder="Enter Gender">
					</div>

					<div class="form-group">
						<label for="homeroom" class="form-label">Homeroom</label>
						<input type="text" class="form-control" name="homeroom" id="homeroom" placeholder="Enter Homeroom">
					</div>

					<div class="form-group">
						<label for="gradyear" class="form-label">Year of Graduation</label>
						<input type="text" class="form-control" name="gradyear" id="gradyear" placeholder="Enter Year of Graduation">
					</div>

					<div class="form-group">
						<label for="dob" class="form-label">Date of Birth</label>
						<input type="date" class="form-control" id="dob" name="dob" placeholder="Enter Date of Birth">
					</div>

					<div class="form-group">
						<label for="image" class="form-label">Select Image</label>
						<input type="hidden" class="form-control" name="MAX_FILE_SIZE" value="2097152" > 
						<input type="file" class="form-control" accept="image/jpeg" name="image" id="image">
						<p class="help-block">Upload a photo of the student to personalize the student's profile.</p>
					</div>

					<div class="form-group">
						<label for="classes" class="form-label">Select Courses</label>
						<input type="text" class="form-control" name="classes" id="classes" placeholder="Select Courses">
						<p class="help-block">Input list of class id's separated by a comma and NO spaces (ex: 1,2,3)</p>
					</div>

					
					<center>
						<input type="submit" class="btn btn-default" id="course-submit" value="Submit">
					</center>

				</form>
			</div>
		</div>
	</div>
	<div class="row" id="new-course-courses"> 
		<div class="col-xs-3"></div>
		<div class="col-xs-6 panel panel-default">
			<div class="panel-body" >
				<h3>Available Courses</h3>
				<table class="table" id="new-course-tbl">
					<tr>
						<th>ID</th>
						<th>Course Name</th>
						<th>Teacher Name</th>
						<th>Room #</th>
						<th>Period</th>
						<!-- <td style="width:140px">Teacher</td>
						<td style="width:140px">Room Number</td>
						<td style="width:140px">Period</td> -->
					</tr>
				<?php
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
						echo "<tr>
								<td>$course_id</td>
								<td>$class_name</td>
								<td>$teacher</td>
								<td>$room_num</td>
								<td>$period</td>
							</tr>";
						$count=$count-1;
					}

				?>
				</table>
			</div>
		</div>
	</div>
</div>
			<form action="Homepage.html" method="post" enctype="multipart/form-data">
				<input id="submit" type="submit" value="Home">
			</form>
