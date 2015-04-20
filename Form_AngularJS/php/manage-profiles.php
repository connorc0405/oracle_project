<?php 
include_once('Database.php');
Database::connect();
Database::selectDatabase("ryan_database");

if(isset($_GET['drop'])){
	mysql_query("DELETE FROM ryan_student WHERE id = " . ('<script type="text/javascript">drop();</script>') . " LIMIT 1");
}
?>
<div class="modal fade" id="student-modal" tabindex="-1" role="dialog" aria-labelledby="student-modal-label" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aira-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="student-modal-label">{{first_name}} {{last_name}}</h4>
			</div>
			<div class="modal-body">
				<!-- <div class="container" id="sample-profile"> -->
					<div class="row">
						<div class="col-xs-6">
							<h4>ID Number: {{id_num}}</h4>
							<h4>Name: {{first_Name}} {{last_name}}</h4>
							<h4>Grade: {{grade}}</h4> 
							<h4>Year of Graduation: {{year_graduation}}</h4>
							<h4>Date of Birth: {{dob}}</h4>
							<h4>Classes:</h4>
							<ul id="classList">
								<li>{{class_list}}</li>
							</ul>
							<h4>About Me:</h4>
							<ul id="classList">
								<p>{{about}}</p>
							</ul>		
						</div>
						<div class="col-xs-1"></div>
						<div class="col-xs-4">
							<img src="imgs/logo.jpg"></img>
							<img id="portrait" src="imgs/Ryan_Dean2.JPG">
						</div>
						<!-- <div class="col-xs-1"></div> -->
					</div>
				<!-- </div> -->
			</div>
		</div>
	</div>
</div>
<div class="contianer"> 
	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-6">
			<h1>Manage Profiles</h1>
		</div>
	</div>
	<div class="row" id="student-table-row">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
			<div class="panel panel-default">
				<div class="panel-heading">Student Profiles</div>
				<div class="panel-body">
					<a type="submit" class="btn btn-default col-xs-2" id="tableBtn" onclick="drop()">Drop Row</a>
					<a type="submit" class="btn btn-default col-xs-2" id="tableBtn" href="#new-student">Add Row</a>
				</div>
				<table class="table table-hover" id="student-table">
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
					<tr ng-click="getStudentData(<?php echo($row['id']); ?>);" data-toggle="modal" data-target="#student-modal">
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
		</div>
		<div class="col-xs-1"></div>
	</div>
</div>