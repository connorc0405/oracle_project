<?php 
$servername = "localhost";
$username = "";
$password = "";
$dbconn = mysql_connect($servername, $username, $password);
if(! $dbconn){
	die("died" . mysql_error());
}

echo("Connected");
?>