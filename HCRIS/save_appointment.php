<?php
// save_appointment.php - Handles form submission and saves appointment data into the database

session_start();
include 'dbcon.php'; // Include your database connection

$response = ["success" => false, "message" => "Something went wrong."];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the form
    $fullname = trim($_POST['fullname']);
    $schedule = trim($_POST['schedule']);
    $purpose = trim($_POST['purpose']);
    $reason = trim($_POST['reason']);
    $illness = trim($_POST['illness']);
    $disease = trim($_POST['disease']);

    // Validate the data
    if (empty($fullname) || empty($schedule) || empty($purpose) || empty($reason) || empty($illness)) {
        $response['message'] = "All fields are required!";
        echo json_encode($response);
        exit();
    }

    // Prepare SQL query to insert appointment data into the database
    $stmt = $conn->prepare("INSERT INTO patients_appointment (fullname, schedule, purpose, reason, t_o_i, disease) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        // Bind parameters and execute query
        $stmt->bind_param("ssssss", $fullname, $schedule, $purpose, $reason, $illness, $disease);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Appointment booked successfully!";
        } else {
            $response['message'] = "Failed to book appointment.";
        }
        $stmt->close();
    } else {
        $response['message'] = "Database query failed: " . $conn->error;
    }

    // Close the database connection
    $conn->close();

    // Send JSON response
    echo json_encode($response);
}
?>
