<?php
// dbcon.php - Database connection

$servername = "localhost"; // Change to your database host
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "ths_healthcare"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
