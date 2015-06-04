<div class="container">
	<div class="row">
		<div class="col-xs-12" id="home-header">
			<h1>View Database Tables</h1>
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
					include_once('Database.php');
					Database::connect();
					$link = mysqli_connect("localhost","root","","StudentDatabase");

					$row = Database::getCourses();
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