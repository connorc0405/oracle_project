<?php 
include_once('Database.php');
Database::connect();
Database::selectDatabase("ryan_database");

/* Data entered in the form by the user is stored in several variables */
$numRows = mysql_query("SELECT * FROM ryan_student");
echo("Number of Rows: " . mysql_num_rows($numRows));
$id = (mysql_num_rows($numRows) + 1);
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$grade = $_POST["grade"];
$yog = $_POST["yearGraduation"];
$dob = $_POST["dob"];
$classes = $_POST["Classes"];
$about = $_POST["about"];
$img = "";

// function getImageExtension($imagetype){
// 	if(empty($imagetype)){
// 		return false;
// 	}
// 	switch($imagetype){
// 		case 'image/bmp': return '.bmp';
// 		case 'image/gif': return '.gif';
// 		case 'image/jpeg': return '.jpg';
// 		case 'image/png': return '.png';
// 		default: return false;
// 	}
// }
// // $target_path = "";
// if(!empty($_FILES["imgPath"]["img"])){
// 	$file_name = $_FILES["imgPath"]["img"];
// 	$temp_name = $_FILES["imgPath"]["tmp_name"];
// 	$imgtype = $_FILES["imgPath"]["type"];
// 	$ext = getImageExtension($imgtype);
// 	$imagename = date("d-m-Y")."-".time().$ext;
// 	$target_path = "../imgs/".$imagename;

// 	if(move_uploaded_file($temp_name, $target_path)){
// 		$query_upload = "INSERT INTO ryan_image ".
// 		"(images_path, submission_date) ".
// 	"VALUES ". 
// 		"(" . $target_path . "," . 
// 		"'" . date("Y-m-d") . "')";
// 		mysql_query($query_upload) or die();
// 	}
// }

/* The SQL query to add the variables into the ryan_student table */
$sqlInsert =
	"INSERT INTO ryan_student ".
		"(id, first_name, last_name, grade, year_graduation, date_birth, classes, about, image) ".
	"VALUES ". 
		"(" . $id . "," . 
		"'" . $firstName . "'," .
		"'" . $lastName . "'," .
		"'" . $grade . "'," .
		"'" . $yog . "'," .
		"'" . $dob . "',".
		"'" . $classes . "'," .
		"'" . $about . "'," .
		"'" . $img . "')";
Database::addRow($sqlInsert);
mysql_close();
?>
<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<nav class="navbar navbar-fixed-top navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <a class="navbar-brand" href="../#welcome" id="navbarBrand">School Profiles</a>
          <li id="navbarWelcome" class="active"><a href="../#welcome">Welcome</a></li>

          <li class="dropdown" id="navbarSample">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button">Sample Profiles<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="../#sample-student">Student Profile</a></li>
              <li><a href="../#construction">Teacher Profile</a></li>
              <li><a href="../#construction">Administrator Profile</a></li>
            </ul>
          </li>

          <li class="dropdown" id="navbarNew">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button">New Profile<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="../#new-student">Student Profile</a></li>
              <li><a href="../#construction">Teacher Profile</a></li>
              <li><a href="../#construction">Administrator Profile</a></li>
            </ul>
          </li>

          <li id="navbarManage"><a href="../#manage-profiles">Manage Profiles</a></li>
        </ul>
      </div>
    </div>
  </nav>
<div class="container" id="sample-profile">
	<div class="row">
		<div class="col-xs-6">
		<h1 id="new-head"><?php echo($firstName); ?></h1>
			<h4>Name: <?php echo($firstName . " " . $lastName); ?></h4>
			<h4>Grade: <?php echo($grade); ?></h4> 
			<h4>Year of Graduation: <?php echo($yog); ?></h4>
			<h4>Date of Birth: <?php echo($dob); ?></h4>
			<h4>Classes:</h4>
			<ul id="classList">
				<li><?php echo($classes); ?></li>
			</ul>
			<h4>About Me:</h4>
			<ul id="classList">
				<p><?php echo($about); ?></p>
			</ul>
		</div>
		<div class="col-xs-1"></div>
		<div class="col-xs-4">
			<img src="../imgs/logo.jpg"></img>
			<!-- <img id="portrait" src="<?php echo($target_path); ?>"></img> -->
		</div>
		<div class="col-xs-1"></div>
	</div>
</div>