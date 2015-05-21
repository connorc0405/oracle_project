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
			<h3>New Course</h3> 
				<form action="php/course-profile.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="class_name" class="form-label">Course Name</label>
						<input type="text" class="form-control" name="class_name" id="class_name" placeholder="Enter Course Name">
					</div>

					<div class="form-group">
						<label for="teacher" class="form-label">Teacher Name</label>
						<input type="text" class="form-control" name="teacher" id="teacher" placeholder="Enter Teacher Name">
					</div>

					<div class="form-group">
						<label for="room_num" class="form-label">Room Number</label>
						<input type="text" class="form-control" name="room_num" id="room_num" placeholder="Enter Room Number">
					</div>

					<div class="form-group">
						<label for="period" class="form-label">Class Period</label>
						<input type="text" class="form-control" name="period" id="period" placeholder="Enter Class Period">
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