<html>
<?php
$username = $_POST['username'];
$password = $_POST['password'];
$secret = $_POST['secret'];
$cstrong;
$salt = openssl_random_pseudo_bytes(10, $cstrong);
$connection = mysqli_connect("127.0.0.1","root","ccumming","sqlinjection");
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
	echo "Connected to MySQL Server" . PHP_EOL;
}
if (!mysqli_query($connection, "CREATE TABLE IF NOT EXISTS login_information (username VARCHAR(45), password VARCHAR(45), secret VARCHAR (45))"))
  {
  echo "Error description: " . mysqli_error($connection);
  }
if (!mysqli_query($connection, "INSERT INTO login_information (username, password, secret) VALUES ('".$username."', '".$password."', '".$secret."');"))
  {
  echo "Error description: " . mysqli_error($connection);
  }
else{
	echo "Account created successfully";
}
mysqli_close($connection);
?>

</html>
