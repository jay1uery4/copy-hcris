<?php
// DATABASE CONNECTION
require 'db_conn.php';

// Check if the ID is passed via the URL
if (isset($_GET['healthcare_id'])) {
    // Store the healthcare_id in a variable and ensure it's an integer
    $healthcare_id = intval($_GET['healthcare_id']);

    // SQL query to delete the record with the passed healthcare_id
    $sql = "DELETE FROM admin_healthcare_unit WHERE healthcare_id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter
        $stmt->bind_param("i", $healthcare_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the original page or show a success message
            echo "<script>alert('Healthcare record deleted successfully'); window.location.href='healthcare_staff.php';</script>";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid request. No ID provided.";
}

// Close the database connection
$conn->close();
?>
