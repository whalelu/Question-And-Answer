<?php

$servername = "localhost";
$username = "root";
$password = "ljy12345";
$dbname = "questionsandanswers";

// create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// inspect connection
if (!$conn) 
{
	die("Connection failed: " . mysqli_connect_error());
}

?>