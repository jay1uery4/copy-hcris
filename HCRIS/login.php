<?php
session_start(); // Start session to manage user data

// Database connection
$host = "localhost";
$dbname = "ths_healthcare";
$username = "root"; // Your database username
$password = ""; // Your database password

$response = ["success" => false, "message" => "", "fullname" => "", "loggedIn" => false];

header('Content-Type: application/json'); // Set response type

try {
    // Establish database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle GET request to fetch user information
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        if (isset($_SESSION['patient_id'])) {
            // User is logged in, return session data
            $response['loggedIn'] = true;
            $response['patient_id'] = $_SESSION['patient_id'];
            $response['fullname'] = $_SESSION['fullname'];
            $response['username'] = $_SESSION['username'];
        } else {
            // User is not logged in
            $response['message'] = "User not logged in.";
        }
    }

    // Handle POST request for login
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve and validate POST data
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($username) || empty($password)) {
            $response['message'] = "Username and password are required.";
            echo json_encode($response);
            exit;
        }

        // Prepare query to fetch user
        $sql = "SELECT `patient_id`, `fullname`, `username`, `password` FROM `patients` WHERE `username` = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                session_regenerate_id(true); // Secure session management
                $_SESSION['patient_id'] = $user['patient_id'];
                $_SESSION['fullname'] = $user['fullname'];  // Full name stored in session
                $_SESSION['username'] = $user['username']; // Store username in session
            
                $response['success'] = true;
                $response['message'] = "Login successful!";
                $response['fullname'] = $user['fullname']; // Pass full name in the response
                $response['loggedIn'] = true;
            } else {
                $response['message'] = "Incorrect password.";
            }
        } else {
            // Username not found
            $response['message'] = "Username not found.";
        }
    }
} catch (PDOException $e) {
    // Handle database connection errors
    $response['message'] = "Database error: " . $e->getMessage();
}

// Send the response as JSON
echo json_encode($response);
?>
