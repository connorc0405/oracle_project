<?php
	/* Gets the form input from html/login.html */
	$input_username = $_POST['username'];
	$input_password = $_POST['password'];
	$cstrong;

	/* Sets the connection to the mySQL database, and tests the connection throwing an error if needed */
	$connection = mysqli_connect("localhost","root","","studentdatabase");
	
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	/* Security to retrieve and decode the hash and salt. */
	$hash_salt_object = mysqli_query($connection, "SELECT hash, salt FROM login_information WHERE username = '".$input_username."';") or die("Error description: ".mysqli_error($connection));
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
		header('Location: ../html/404.html');
	  	exit;
	}
	//echo "input hash:  " . (hash('sha512', $input_password.$salt, false));
	//echo "input password + salt:   ".$input_password.$salt;
	mysqli_close($connection);
?>