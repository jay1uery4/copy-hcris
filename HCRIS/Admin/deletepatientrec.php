<?php
// DATABASE CONNECTION !! 
require 'db_conn.php';

// Check if the ID is passed via the URL
if (isset($_GET['id'])) {
    // Store the patient_id in a variable
    $patient_id = $_GET['id'];

    // Prepare SQL query to delete the record with the passed patient_id
    $sql = "DELETE FROM adminpatient_record WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // Error preparing statement
        die("Error preparing SQL statement: " . $conn->error);
    }

    // Bind the patient_id parameter to the SQL query
    $stmt->bind_param("s", $patient_id); // "s" for string (use "i" for integers)

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the original page or show a success message
        echo "<script>alert('Patient record deleted successfully'); window.location.href='adminpatientrec.php';</script>";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request. No ID provided.";
}

// Close the database connection
$conn->close();
?>
