<html>
<?php
$input_username = $_POST['username'];
$input_password = $_POST['password'];
$cstrong;
$connection = mysqli_connect("localhost","root","","studentdatabase");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$hash_salt_object = mysqli_query($connection, "SELECT hash, salt FROM login_information WHERE username = '".$input_username."';") or die("Error description: ".mysqli_error    ($connection));
$row = mysqli_fetch_assoc($hash_salt_object);
$hash = $row['hash'];
$salt = $row['salt'];
//echo "hash: ".$hash."      salt: ".$salt;
if(hash('sha512', $input_password.$salt, false) === $hash)
{
	echo "Great Success";
	
	header('Location: ../#construction');
  	exit;
}
else{
	echo "Failed login";
}
//echo "input hash:  " . (hash('sha512', $input_password.$salt, false));
//echo "input password + salt:   ".$input_password.$salt;
mysqli_close($connection);
?>

</html>