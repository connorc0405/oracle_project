<?php
function createTable($connection) {
	if (!mysqli_query($connection, "CREATE TABLE IF NOT EXISTS login_information (username VARCHAR(45), hash VARCHAR(128), salt VARCHAR(10))"))
  	{
  		echo "Error description: " . mysqli_error($connection);
  	}
}
function addUserInformation($connection, $username, $password, $salt){
	if (!mysqli_query($connection, "INSERT INTO login_information (username, hash, salt) VALUES ('".$username."', sha2('".$password."".$salt."', 512), '".$salt."');"))
  	{
  		echo "Error description: " . mysqli_error($connection);
  	}
	else{
		echo "Account created successfully";
	}
}
function getSaltAndHash($connection){
	$hash_salt_object = mysqli_query($connection, "SELECT hash, salt FROM login_information WHERE username = '".$input_username."';") or die("Error description: ".mysqli_error    ($connection));
	$row = mysqli_fetch_assoc($hash_salt_object);
	$hash = $row['hash'];
	$salt = $row['salt'];
	return $salt_and_hash = array($salt, $hash);
}
?>