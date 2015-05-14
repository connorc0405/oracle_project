<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Course Registration</h1>
		</div>
	</div>
</div>

			<br>

			<form action="CourseProfile.php" method="post" enctype="multipart/form-data">
  			<table>
  				<tr>
  					<td>Class Name: <input type="text" name="class_name"><br><br></td>
  				</tr>
  				<tr>
 					<td>Teacher Name: <input type="text" name="teacher"><br><br></td>
  				</tr>
  				<tr>
 					<td>Room Number: <input type="text" name="room_num"><br><br></td>
  				</tr>
 				<tr>
 					<td>Class Period:  <input type="text" name="period"><br><br></td>
  				</tr>
			</table>

			<br><br>

			<input type="submit" value="Submit">
			</form>

			<br><br>

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

			<br><br>

			<form action="Homepage.html" method="post" enctype="multipart/form-data">
				<input id="submit" type="submit" value="Home">
			</form>


		</center>
	</body>
</html>