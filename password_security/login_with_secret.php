<html>
<?php

//Get input username and password, set up connection
$input_username = $_POST['username'];
$input_password = $_POST['password'];
$cstrong;
$connection = mysqli_connect("192.168.1.177","root","ccumming","sqlinjection");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//Get hash and salt using the given username.
$hash_salt_object = mysqli_query($connection, "SELECT hash, salt FROM login_information WHERE username = '".$input_username."';") or die("Error description: ".mysqli_error    ($connection));
$row = mysqli_fetch_assoc($hash_salt_object);
$hash = $row['hash'];
$salt = $row['salt'];

//Select secret by checking hash of given password + salt against the saved salt variable from the previous statement
$secret_object = mysqli_query($connection, "SELECT secret FROM login_information WHERE username = '".$input_username."' AND hash = SHA2('".$input_password.$salt."', 512);") or die(mysql_error($connection));
$row2 = mysqli_fetch_assoc($secret_object);
$secret = $row2['secret'];

mysqli_close($connection);

echo $input_username."'s secret is: ".$secret;
?>

</html>
