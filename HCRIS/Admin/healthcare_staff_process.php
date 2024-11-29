<?php

require 'db_conn.php';

// Get data from POST request
$health_id = $_POST['health_id'];
$healthcarestaff_name = $_POST['healthcarestaff_name'];
$position = $_POST['position_of_staff'];
$address = $_POST['address'];

// Check if health_id already exists in the database
$checkSql = "SELECT healthcare_id FROM admin_healthcare_unit WHERE healthcare_id = ?";
$stmt = $conn->prepare($checkSql);

if ($stmt === false) {
    die("Error preparing check statement: " . $conn->error);
}

// Bind parameters and execute
$stmt->bind_param("s", $health_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If the health_id already exists, show an alert and redirect back
    echo '
    <script type="text/javascript">
        alert("Error: The healthcare ID is already in use please provide another id that has not been registered.");
        window.location = "healthcare_staff.php"; // Redirect back to the form page
    </script>
    ';
    exit(); // Stop further execution
} else {
    // If the health_id is unique, proceed with the insert
    $sql = "INSERT INTO admin_healthcare_unit (healthcare_id, healthcarestaff_name, position_of_staff, address) 
            VALUES ('$health_id', '$healthcarestaff_name', '$position', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo '
        <script type="text/javascript">
            alert("Saved Record");
            window.location = "healthcare_staff.php";
        </script>
        ';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
