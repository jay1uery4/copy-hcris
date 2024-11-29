<?php
require 'db_conn.php';

// Check if the form is submitted with all required data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form with isset() checks to prevent undefined index errors
    $consultationId = isset($_POST['consultationId']) ? $_POST['consultationId'] : null;
    $healthcare_id = isset($_POST['healthcare_id']) ? $_POST['healthcare_id'] : null;
    $userpatient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : null;
    $patient_name = isset($_POST['patient_name']) ? $_POST['patient_name'] : null;
    $medicine_id = isset($_POST['medicine_id']) ? $_POST['medicine_id'] : null;
    $medicine_name = isset($_POST['medicine_name']) ? $_POST['medicine_name'] : null;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
    $time = isset($_POST['time']) ? $_POST['time'] : null;
    $date = isset($_POST['date']) ? $_POST['date'] : null;

    // SQL query to update the record
    $sql = "UPDATE medical_record
            SET healthcare_id = ?, patient_id = ?, patient_name = ?, medicine_id = ?, medicine_name = ?, quantity = ?, time_ = ?, date_ = ?
            WHERE consultation_id = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        // Debugging output for SQL preparation error
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    $stmt->bind_param("sissssisi", $healthcare_id, $patient_id, $patient_name, $medicine_id, $medicine_name, $quantity, $time, $date, $consultationId);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the consultation list page with a success message
        echo "<script>alert('Consultation record updated successfully'); window.location.href='adminconsultation.php';</script>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
