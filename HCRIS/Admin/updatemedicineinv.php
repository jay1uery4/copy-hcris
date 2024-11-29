<?php
require 'db_conn.php';


// Check if the form is submitted with all required data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $medicine_id = $_POST['medicine_id'];
    $medicine_name = $_POST['medicine_name'];
    $medicine_quantity = $_POST['medicine_quantity'];
    $date_manufactured = $_POST['date_manufactured'];
    $expiration_date = $_POST['expiration_date'];

    // SQL query to update the record
    $sql = "UPDATE admin_medicine_inventory 
            SET medicine_name='$medicine_name', 
                medicine_quantity='$medicine_quantity', 
                date_manufactured='$date_manufactured', 
                expiration_date='$expiration_date' 
            WHERE medicine_id = $medicine_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to the medicine list page with a success message
        echo "<script>alert('Medicine record updated successfully'); window.location.href='adminmedicine.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
