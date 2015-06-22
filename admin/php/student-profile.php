<?php
	$link = mysqli_connect("localhost","root","","StudentDatabase");
	include_once('Database.php');
	Database::connect();
	$row = Database::getStudents();
	$id=(int)$row["student_id"]+1;

	//image file path
	$file = $_FILES["image"];
	$name = $file['name'];
	$path = "/Ryan_Dean/oracle_project/admin/php/StudentImages/".basename($name);

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
			$adds['fname'] = Database::getContent($_POST['fname']);
			$adds['lname'] = Database::getContent($_POST['lname']);
			$adds['gender'] = Database::getContent($_POST['gender']);
			$adds['homeroom'] = Database::getContent($_POST['homeroom']);
			$adds['gradyear'] = Database::getContent($_POST['gradyear']);
			$adds['dob'] = Database::getContent($_POST['dob']);
			$adds['classes'] = Database::getContent($_POST['classes']);
			$adds['img_path'] = $link->real_escape_string($path);

			if (!Database::createStudentTable())
  			{
  				echo "Error description: " . mysqli_error($link);
  			}
			Database::addStudent($id, $adds['fname'], $adds['lname'], $adds['gender'], $adds['homeroom'], $adds['gradyear'], $adds['dob'], $adds['classes'], $adds['img_path']);
			?>
<?php
		$link = mysqli_connect("localhost","root","","StudentDatabase");
		$sql = "Select * from students where student_id=$id";
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_assoc($result);
		$img_path = (string)$row['img_path'];
	?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_POST["lname"]; ?>,<?php echo $_POST["fname"]; ?></title>
	
	<link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../bootflat/bootflat/css/bootflat.css">
	<link rel="stylesheet" type="text/css" href="../../bootflat/css/site.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	
	<script src="../../js/jquery-2.1.1.min.js"></script>
	<script src="../../dist/js/bootstrap.min.js"></script>
	<script src="../../bootflat/bootflat/js/icheck.min.js"></script>
	<script src="../../bootflat/bootflat/js/jquery.fs.selecter.min.js"></script>
	<script src="../../bootflat/bootflat/js/jquery.fs.stepper.min.js"></script>
	<script src="../../js/angular/angular.min.js"></script> 
	<script src="../../js/angular-route/angular-route.min.js"></script>
	<script type="text/javascript" src="../js/script.js"></script>

</head>
<body>


<nav class="navbar navbar-default navbar-fixed-top navbar-custom" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand">ASIT</a>
			</div>

			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<!-- Links go here.  Make a JS function to change the current class.  Some sort of toggle. -->
					<li class="hover"><a class="nav-link current" href="student-profile.php">Profile</a></li>
					<!-- <li class="hover"><p class="navbar-text"> 
					<img src="<?php echo $img_path; ?>" id="navbar-profile-img" class="img-circle">
					<?php echo $_POST["fname"]; ?> <?php echo $_POST["lname"]; ?></p></li>-->

					
				</ul>
			</div>
		</div>
	</nav>
	

	<div class="container profile-container" id="student-profile-container-top">
		<div class="row">
			
			<div class="col-xs-2">
				<img src="<?php echo $img_path; ?>" alt="Nope" id="student-profile-pic">
			</div>
			<div class="col-xs-1"></div>
			<div class="col-xs-6">
				<h4><?php echo $_POST["fname"]; ?> <?php echo $_POST["lname"]; ?> </h4>
			</div>
			<!-- <div class="col-xs-1"></div> -->
		</div>
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3" id="student-profile-school">
				<p id="panel"><span id="panel-gray">AMSA Charter School</span></p>
			</div>
		</div>

		<!-- MAKE A SCROLLSPY FOR THE TABS -->
		<!-- <div id="scrollspyDiv" data-spy="scroll" data-target="scrollspyExample"> -->
			<ul class="nav nav-tabs">
				<li role="presentation" class="active"><a href="#about">About</a></li>
				<li role="presentation" class="active"><a href="#interests">Interests</a></li>
				<li role="presentation" class="active"><a href="#classes">Classes</a></li>
			</ul>
		<!-- </div> -->
		<hr/>

		<div id="about">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-2">
					<h5>About</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-2">
					<p id="panel">Name: <span id="panel-gray"><?php echo ($_POST["fname"] . " " . $_POST["lname"]); ?></span></p>
					<p id="panel">Gender: <span id="panel-gray"><?php echo $_POST["gender"]; ?></span></p>
					<p id="panel">Homeroom: <span id="panel-gray"><?php echo $_POST["homeroom"]; ?></span></p>
					<p id="panel">Year of Graduation: <span id="panel-gray"><?php echo $_POST["gradyear"]; ?></span></p>
					<p id="panel">Date of Birth: <span id="panel-gray"><?php echo $_POST["dob"]; ?></span></p>
				</div>
			</div>
		</div>

		<div id="interests">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-2">
					<h5>Interests</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-2">

				</div>
			</div>
		</div>

		<div id="classes">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-2">
					<h5>Classes</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2">
					<table class="table" id="classes">
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Teacher</th>
							<th>Room #</th>
							<th>Period</th>
						</tr>
						<?php
							//create classes table
							$classes = $_POST["classes"];
							$link = mysqli_connect("localhost","root","","StudentDatabase");
							$tempStr = "";
							//counter to travers classes string
							$count=(int)strlen($classes);

							if($count == 0){
								echo"<tr>
									<td>".($_POST["fname"] . " " . $_POST["lname"]) . " has no classes.
								</tr>";
							}
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
				</div>
			</div>
		</div>
	</div>
</body>
</html>