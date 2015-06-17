<!-- 
 @author: Ryan Dean
 @date: April 2015
 @description: This is the first thing that the user sees when logging onto the database website.  It includes links for logging in, creating an account, a help section, contact/feedback form, etc.
-->
<?php
	require_once('../admin/php/Database.php');

	Database::createDatabase("StudentDatabase");
	Database::selectDatabase("StudentDatabase");
	Database::createStudentTable();
	Database::createCourseTable();
?>
<!-- DOCTYPE HTML -->
<body>
	<div class="container" id="intro">
		<div class="row" id="welcome-header">
			<div class="col-xs-12">
				<h1>ASIT</h1>
				<h3>Academic Student Interest Tracker</h3>
			</div>
		</div>
		<div class="row" id="welcome-detail">

			<!-- Brief student information -->
			<div class="col-xs-4">
				<center>
					<span class="glyphicon glyphicon-education point" id="welcome-detail-glyph"></span>
				</center>
				<h3 class="point">For Students</h3>
				<p class="third-text" id="welcome-third">Students can create an ASIT profile in order to share their interests with the school, bettering their searches when it comes time to find colleges that suit the student best.</p>
			</div>

			<!-- Brief parents information -->
			<div class="col-xs-4">
				<center>
					<span class="glyphicon glyphicon-user point" id="welcome-detail-glyph"></span>
				</center>
				<h3 class="point">For Parents</h3>
				<p class="third-text" id="welcome-third">Parents can create an ASIT profile in order to provide information about the student to the school.  The information includes basic interests, abilities, and strengths.</p>
			</div>

			<!-- Brief admin information -->
			<div class="col-xs-4">
				<center>
					<span class="glyphicon glyphicon-apple point" id="welcome-detail-glyph"></span>
				</center>
				<h3 class="point">For Staff</h3>
				<p class="third-text">Admin administer the profiles and manage the database portion of ASIT.  Responsibilities include creating, viewing, removing, and editing infomraiton.</p>
			</div>
		</div>
	</div>

	<!-- Student container -->
	<div class="container" id="students">
		<div class="row">
			<div class="col-xs-12">
				<h1 id="sub-div">For Students</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-3">
				<img id="student-img" src="imgs/student.jpg"></img>
			</div>
			<div class="col-xs-1"></div>
			<div class="col-xs-3">
				<!-- <h3 id="student-desc">With ASIT, students will have the organization that will be helpful to them when searching for colleges and career opportunities.</h3> -->
			</div>
		</div>
	</div>

	<!-- Parent container -->
	<div class="container" id="parents">
		<div class="row">
			<div class="col-xs-12">
				<h1 id="sub-div">For Parents (Imgright)</h1>
			</div>
		</div>
	</div>

	<!-- Admin container -->
	<div class="container" id="admin">
		<div class="row">
			<div class="col-xs-12">
				<h1 id="sub-div">For Admin</h1>
			</div>
		</div>
	</div>
</body>