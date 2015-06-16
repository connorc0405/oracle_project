<?php
  /*
   * Gets the username and password from the form on html/register.html 
  */
  $username = $_POST['username'];
  $password = $_POST['password'];
  $cstrong;
  $salt = openssl_random_pseudo_bytes(10, $cstrong);
  $connection = mysqli_connect("localhost","root","","StudentDatabase");

  /*
   * Gets the last entry in the login_information table
  */
  $sql = "SELECT *
          FROM login_information
          WHERE id=(
                    SELECT MAX(id)
                    FROM login_information)";

  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  /* Increments a number to set as the Unique ID (UID) */
  $id = (int)$row["id"]+1;

  /* If error connecting to database, throw error */
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  } 
  else {
  	echo "Connected to MySQL Server" . PHP_EOL;
  }

  /* If the table does not exist in the studentdatabase, create a login_information table for
      everyone's account information */
  if (!mysqli_query($connection, "CREATE TABLE IF NOT EXISTS login_information (id INT(4) PRIMARY KEY, username VARCHAR(45), hash VARCHAR(128), salt VARCHAR(10))")) {
    echo "Error description: " . mysqli_error($connection);
  }

  /* If there is an error throw one, else insert the row into the login_information table */
  if (!mysqli_query($connection, "INSERT INTO login_information (id, username, hash, salt) VALUES ('".$id."', '" .$username."', sha2('".$password."".$salt."', 512), '".$salt."');")) {
    echo "Error description: " . mysqli_error($connection);
  }
  else {
  	echo "Account created successfully";
  	header('Location: ../admin/#new-student');
    exit;
  }
  mysqli_close($connection);
?>