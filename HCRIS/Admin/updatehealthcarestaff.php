<?php
require 'db_conn.php';

// Check if the form is submitted with all required data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $health_id = $_POST['health_id'];
    $healthcarestaff_name = $_POST['healthcarestaff_name'];
    $position = $_POST['position_of_staff'];
    $address = $_POST['address'];
    
    // Correct SQL query to update the record
    $sql = "UPDATE admin_healthcare_unit
            SET healthcarestaff_name = '$healthcarestaff_name', 
                position_of_staff = '$position', 
                address = '$address'
            WHERE healthcare_id = '$health_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to the healthcare staff list page with a success message
        echo "<script>alert('Healthcare staff record updated successfully'); window.location.href='healthcare_staff.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
