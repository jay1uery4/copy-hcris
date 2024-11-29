<?php
// DATABASE CONNECTION !!
include "db_conn.php";

// Get data from POST request
$medicine_id = $_POST['medicine_id'];
$medicine_name = $_POST['medicine_name'];
$medicine_quantity = $_POST['medicine_quantity'];
$date_manufactured = $_POST['date_manufactured'];
$expiration_date = $_POST['expiration_date'];

// Validate data
if (empty($medicine_id) || empty($medicine_name) || empty($medicine_quantity) || empty($date_manufactured) || empty($expiration_date)) {
    die("All fields are required.");
}

// Prepare the SQL query to check if the medicine ID already exists
$selectSql = "SELECT * FROM admin_medicine_inventory WHERE medicine_id = ?";
$stmt = $conn->prepare($selectSql);

if ($stmt === false) {
    die("Error preparing select statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("s", $medicine_id);

// Execute the statement
$stmt->execute();

// Store the result
$result = $stmt->get_result();

// Check if the medicine ID already exists
if ($result->num_rows > 0) {
    // Medicine ID exists, so prompt the user and stop execution
    echo '
    <script type="text/javascript">
        alert("Error: The medicine ID is already in use please provide another id that has been not registered.");
        window.location = "adminmedicine.php"; // Redirect to the page where the form is located
    </script>
    ';
    exit(); // Stop further execution if ID is already in use
} else {
    // Medicine does not exist, so insert new record
    $insertSql = "INSERT INTO admin_medicine_inventory (medicine_id, medicine_name, medicine_quantity, date_manufactured, expiration_date) 
                  VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSql);

    if ($stmt === false) {
        die("Error preparing insert statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssiss", $medicine_id, $medicine_name, $medicine_quantity, $date_manufactured, $expiration_date);
}

// Execute the statement
if ($stmt->execute()) {
    echo "Record processed successfully.";
    header("Location: adminmedicine.php"); // Redirect to the relevant page after successful insertion
    exit(); // Use exit after header redirection
} else {
    echo "Error executing statement: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
