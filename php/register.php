<html>
<?php
$username = $_POST['username'];
$password = $_POST['password'];
$cstrong;
$salt = openssl_random_pseudo_bytes(10, $cstrong);
$connection = mysqli_connect("localhost","root","","StudentDatabase");


$sql = "Select * from login_information where id=(
          Select max(id) From login_information)";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);


$id = (int)$row["id"]+1;
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 
else {
	echo "Connected to MySQL Server" . PHP_EOL;
}
if (!mysqli_query($connection, "CREATE TABLE IF NOT EXISTS login_information (id INT(4) PRIMARY KEY, username VARCHAR(45), hash VARCHAR(128), salt VARCHAR(10))")) {
  echo "Error description: " . mysqli_error($connection);
  }
if (!mysqli_query($connection, "INSERT INTO login_information (id, username, hash, salt) VALUES ('".$id."', '" .$username."', sha2('".$password."".$salt."', 512), '".$salt."');")) {
  echo "Error description: " . mysqli_error($connection);
  }
else{
	echo "Account created successfully";

  // Database::setPendingRow($id, $username, $hash, $salt);
	header('Location: ../admin/#new-student');
  	exit;
}
mysqli_close($connection);
?>

</html>