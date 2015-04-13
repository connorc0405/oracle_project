<?php 
include_once('Database.php');
Database::connect();
Database::selectDatabase("ryan_database");

if(isset($_GET['drop'])){
	mysql_query("DELETE FROM ryan_student WHERE id = " . ('<script type="text/javascript">drop();</script>') . " LIMIT 1");
}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport">
	<title>Student Profiles</title>
	<!-- JavaScript SCRIPTS -->
	<script src="../js/angular/angular.min.js"></script>   <!-- ANGULAR -->
	<script src="../js/angular-route/angular-route.min.js"></script>   <!-- ANGULAR ROUTE -->
	<script src="../js/jquery-2.1.1.min.js"></script>      <!-- JQUERY -->
	<script src="../dist/js/bootstrap.min.js"></script>   <!-- BOOTSTRAP -->
	<script src="../dist/js/ui-bootstrap-0.12.0.min.js"></script>  <!-- BOOTSTRAP UI -->
	<script src="../js/script.js"></script>
	<!-- CSS STYLES -->
	<link href="../dist/css/bootstrap.min.css" rel="stylesheet">   <!-- BOOTSTRAP -->
	<link href="../css/style.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-fixed-top navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<a class="navbar-brand" href="../#" id="navbarBrand">Student Profiles</a>
					<li id="navbarWelcome"><a href="../#welcome">Welcome</a></li>
					<li id="navbarSample"><a href="../#sample-profile">Sample Profile</a></li>
					<li id="navbarNew"><a href="../#new-profile">New Profile</a></li>
					<li id="navbarView" class="active"><a href="view-profiles.php">Manage Profiles</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="contianer"> 
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-6">
				<h1>View Student Profiles</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
				<table class="table table-hover" id="profiles-table">
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Grade</th>
						<th>Year of Graduation</th>
						<th>Date of Birth</th>
						<th>Classes</th>
						<th>About</th>
						<th>Image</th>
					</tr>
					<?php 
						if(Database::getNumRows() == 0){
							?>
							<tr>
								<td>No data in the database</td>
							</tr>
						<?php
						}
					
					$query = mysql_query("SELECT * FROM ryan_student");
					while($row = mysql_fetch_assoc($query)){
						?>
						<tr>
							<td><?php echo($row['id']); ?></td>
							<td><?php echo($row['first_name']); ?></td>
							<td><?php echo($row['last_name']); ?></td>
							<td><?php echo($row['grade']); ?></td>
							<td><?php echo($row['year_graduation']); ?></td>
							<td><?php echo($row['date_birth']); ?></td>
							<td><?php echo($row['classes']); ?></td>
							<td><?php echo($row['about']); ?></td> 
							<!-- <td>
								<img src="<?php echo($row['image']); ?>"></img>
							</td> -->
						</tr>
						<?php 
					}
					?>
				</table>
			</div>
			<div class="col-xs-1"></div>
		</div>
		<div class="row">
			<div class="col-xs-7"></div>
			<div class="col-xs-5">
				<a type="submit" class="btn btn-default col-xs-2" id="tableBtn" onclick="drop()">Drop Row</a>
				<a type="submit" class="btn btn-default col-xs-2" id="tableBtn" href="../#new-profile">Add Row</a>
			</div>
			<div class="col-xs-1"></div>
		</div>
	</div>
</body>
</html>