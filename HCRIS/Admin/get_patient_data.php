<?php
require 'db_conn.php';

if ($conn) {
    $patientQuery = "SELECT patient_id, patient_name FROM adminpatient_record";
    $patientResult = $conn->query($patientQuery);

    if ($patientResult) {
        if ($patientResult->num_rows > 0) {
            while ($patientRow = $patientResult->fetch_assoc()) {
                echo "<option value='" . $patientRow['patient_id'] . "' data-name='" . htmlspecialchars($patientRow['patient_name'], ENT_QUOTES, 'UTF-8') . "'>"
                     . $patientRow['patient_id'] . " (" . htmlspecialchars($patientRow['patient_name'], ENT_QUOTES, 'UTF-8') . ")</option>";
            }
        } else {
            echo "<option disabled>No patients available</option>";
        }
    } else {
        echo "<option disabled>Error loading patients: " . $conn->error . "</option>";
    }
} else {
    echo "<option disabled>Connection error</option>";
}
?>
