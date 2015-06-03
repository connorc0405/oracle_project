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

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_POST["lname"]; ?>,<?php echo $_POST["fname"]; ?></title>
	
	<link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="shortcut icon" href="../../../favicon.ico">
	<link rel="stylesheet" type="text/css" href="../../nexus-nav/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="../../nexus-nav/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="../../nexus-nav/css/component.css" />
	<link rel="shortcut icon" href="../nexus-nav/favicon.ico">
	<script src="../../js/jquery-2.1.1.min.js"></script>
	<script src="../../dist/js/bootstrap.min.js"></script>
	<script src="../../js/angular/angular.min.js"></script> 
	<script src="../../js/angular-route/angular-route.min.js"></script>
	<script type="text/javascript" src="../js/script.js"></script>
	<script src="../../nexus-nav/js/modernizr.custom.js"></script>
</head>
<body>
	<div class="nav-container">
		<ul id="gn-menu" class="gn-menu-main">
			<li class="gn-trigger">
				<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
				<nav class="gn-menu-wrapper">
					<div class="gn-scroller">
						<ul class="gn-menu">
							<li class="gn-search-item">
								<input placeholder="Search" type="search" class="gn-search">
								<a class="gn-icon gn-icon-search"><span>Search</span></a>
							</li>
							<li><a href="#student-profile">Your Profile</a></li>
							<li><a class="gn-icon gn-icon-cog">Settings</a></li>
						</ul>
					</div>
				</nav>
				<!-- Add case where there is a menu for those logged in and a menu for those who are not.  Make a class .active for the active tab on the menu -->
				<!-- <li><a href="#">Student Profiles</a></li> -->
				<li class="dropdown">
					<a id="dropdownShow" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li id="studentTab"><a href="#construction">Student Profiles</a></li>
						<li id="parentTab"><a href="#construction">Parent Profiles</a></li>
						<li id="adminTab"><a href="admin/index.html">Admin Profiles</a></li>
					</ul>
				</li>
				<li id="right"><a href="#construction">Sign Up</a></li>
				<li id="right"><a href="#construction">Log In</a></li>
			</li>
		</ul>
	</div>
	<?php
		$link = mysqli_connect("localhost","root","","StudentDatabase");
		$sql = "Select * from students where student_id=$id";
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_assoc($result);
		//get image path
		$img_path = (string)$row['img_path'];
	?>

	<div class="container" id="student-profile-container-top">
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
	<script src="../../nexus-nav/js/classie.js"></script>
	<script src="../../nexus-nav/js/gnmenu.js"></script>
	<script>
		new gnMenu( document.getElementById( 'gn-menu' ) );
	</script>
</body>
</html>



			<br><br><br><br>

			<form action="StudentLogInfoWebpage.php" method="post" enctype="multipart/form-data">
				<input type="submit" value="Enter New Student">
			</form>

			<br><br>
			<form action="Homepage.html" method="post" enctype="multipart/form-data">
			<input id="submit" type="submit" value="Home">
			</form>

		</center>