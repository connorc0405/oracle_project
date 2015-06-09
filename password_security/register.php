<html>
<?php
$username = $_POST['username'];
$password = $_POST['password'];
$cstrong;
$salt = openssl_random_pseudo_bytes(10, $cstrong);
$connection = mysqli_connect("localhost","root","","");

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
	echo "Connected to MySQL Server" . PHP_EOL;
}
if (!mysqli_query($connection, "CREATE TABLE IF NOT EXISTS login_information (username VARCHAR(45), hash VARCHAR(128), salt VARCHAR(10))"))
  {
  echo "Error description: " . mysqli_error($connection);
  }
if (!mysqli_query($connection, "INSERT INTO login_information (username, hash, salt) VALUES ('".$username."', sha2('".$password."".$salt."', 512), '".$salt."');"))
  {
  echo "Error description: " . mysqli_error($connection);
  }
else{
	echo "Account created successfully";
}
mysqli_close($connection);
?>

</html>