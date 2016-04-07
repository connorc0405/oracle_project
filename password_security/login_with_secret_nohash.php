<html>
<?php
//Get input username and password, set up connection
$input_username = $_POST['username'];
$input_password = $_POST['password'];
$cstrong;
$connection = mysqli_connect("10.0.4.206","root","ccumming","sqlinjection");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$secret_object = mysqli_query($connection, "SELECT secret FROM login_information WHERE username = '".$input_username."' AND password = '".$input_password."';") or die(mysql_error($connection));
$row = mysqli_fetch_assoc($secret_object);
$secret = $row['secret'];
mysqli_close($connection);
echo $input_username."'s secret is: ".$secret;
echo "hi";
?>

</html>
