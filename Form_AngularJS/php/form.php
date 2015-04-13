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
// if(!empty($_FILES["imgPath"]["img"])){
// 	$file_name = $_FILES["imgPath"]["img"];
// 	$temp_name = $_FILES["imgPath"]["tmp_name"];
// 	$imgtype = $_FILES["imgPath"]["type"];
// 	$ext = getImageExtension($imgtype);
// 	$imagename = date("d-m-Y")."-".time().$ext;
// 	$target_path = "../imgs/".$imagename;

// 	if(move_uploaded_file($temp_name, $target_path)){
// 		$query_upload = "INSERT INTO ryan_student ".
// 		"(id, first_name, last_name, grade, year_graduation, date_birth, classes, about, image) ".
// 	"VALUES ". 
// 		"(" . $id . "," . 
// 		"'" . $firstName . "'," .
// 		"'" . $lastName . "'," .
// 		"'" . $grade . "'," .
// 		"'" . $yog . "'," .
// 		"'" . $dob . "',".
// 		"'" . $classes . "'," .
// 		"'" . $about . "'," .
// 		"'" . $img . "')";
// 		Database::addRow($query_upload);
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
            <li id="navbarNew" class="active"><a href="../#new-profile">New Profile</a></li>
            <li id="navbarView"><a href="view-profiles.php">Manage Profiles</a></li>
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
				<img id="portrait" src="../<?php echo($img); ?>"></img>
			</div>
			<div class="col-xs-1"></div>
		</div>
	</div>
</body>
</html>