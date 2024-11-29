// get_medicine_select.php
<?php
require 'db_conn.php'; // Ensure this file contains the database connection setup

if ($conn) {
    // Query to get available medicines along with quantity
    $medicineQuery = "SELECT medicine_id, medicine_name, medicine_quantity FROM admin_medicine_inventory WHERE medicine_quantity > 0";
    $medicineResult = $conn->query($medicineQuery);

    // Check for results and output each as an option
    if ($medicineResult) {
        if ($medicineResult->num_rows > 0) {
            while ($medicineRow = $medicineResult->fetch_assoc()) {
                echo "<option value='" . $medicineRow['medicine_id'] . "' data-name='" . $medicineRow['medicine_name'] . "'>" 
                     . $medicineRow['medicine_name'] . " (medicine ID: " . $medicineRow['medicine_id'] . ", AvailableQuantity: " . $medicineRow['medicine_quantity'] . ")</option>";
            }
        } else {
            echo "<option disabled>No medicines available</option>";
        }
    } else {
        // Detailed error message to identify the exact issue with the query
        echo "<option disabled>Error loading medicines: " . $conn->error . "</option>";
    }
} else {
    echo "<option disabled>Connection error</option>";
}
?>
