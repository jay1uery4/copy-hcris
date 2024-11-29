<?php
session_start();
include 'dbcon.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['patient_id'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit();
}

$user_id = $_SESSION['patient_id']; // Get patient ID from session
$fullname = 'Guest'; // Default value for fullname

// Fetch user details from the database
$stmt = $conn->prepare("SELECT fullname, location FROM patients WHERE patient_id = ?");
if ($stmt) {
    $stmt->bind_param("s", $user_id); // Bind patient_id parameter
    $stmt->execute(); // Execute the query
    $result = $stmt->get_result(); // Get the result

    if ($result->num_rows > 0) {
        // If user exists, fetch details
        $row = $result->fetch_assoc();
        $fullname = htmlspecialchars($row['fullname']); // Sanitize output
    }
    $stmt->close(); // Close the prepared statement
} else {
    // Handle query failure
    die("Database query failed: " . $conn->error);
}

// Optionally, you can close the database connection here if needed
$conn->close();
?>
