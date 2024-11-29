<?php

$servername = "localhost";
$uname = "root";  // Corrected variable name
$password = "";

$db_name = "ths_healthcare";

// Establishing the connection
$conn = mysqli_connect($servername, $uname, $password, $db_name);

// Checking the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "";
}
?>

