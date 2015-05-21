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
<!DOCTYPE html>



<!-- ***IF NO NAME, JS TO INJECT TEXT/LET USER KNOW -->
<html>
<head>
	<title>Course Created</title>
	
	<link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../nexus-nav/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="../../nexus-nav/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="../../nexus-nav/css/component.css" />
	<link rel="shortcut icon" href="../../nexus-nav/favicon.ico">
	<link rel="shortcut icon" href="../../../favicon.ico">
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
					<a id="dropdownShow" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Select One<span class="caret"></span></a>
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

	<div class="container">
		<div class="row">
			<div class="col-xs-12" id="home-header">
				<h1>Class Created Successfully</h1>
			</div>
			<form action="Homepage.html" method="post" enctype="multipart/form-data">
			<input id="submit" type="submit" value="Home">
			</form>
		</div>
		<div class="row">
			<div class="col-xs-3"></div>
			<div class="col-xs-6 panel panel-default">
				<div class="panel-body">
					<h3><?php echo $_POST["class_name"]; ?></h3>
					<p id="panel">Course Name: <span id="panel-gray"><?php echo $_POST["class_name"]; ?></span></p>
					<p id="panel">Teacher: <span id="panel-gray"><?php echo $_POST["teacher"]; ?></span></p>
					<p id="panel">Room Number: <span id="panel-gray"><?php echo $_POST["room_num"]; ?></span></p>
					<p id="panel">Period: <span id="panel-gray"><?php echo $_POST["period"]; ?></span></p>

					<center>
					<form action="../#new-course" method="post" enctype="multipart/form-data">
						<input class="btn btn-default" id="course-submit" type="submit" value="Enter Another Class">
					</form>
					</center>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
		