<?php
// Database connection
$host = "localhost";
$dbname = "ths_healthcare";
$username = "root";  // Use your database username
$password = "";  // Use your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get data from POST request
        $fullname = $_POST['fullname'];
        $birthday = $_POST['birthday'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $socialStatus = $_POST['socialStatus'];
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $password = $_POST['password'];  // Password field
        $otps = "";  // You can handle OTP here if needed, for now, setting it as an empty string or NULL
        
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Insert data into the database
        $sql = "INSERT INTO patients (fullname, birthday, age, address, Social_stat, gender, username, password, otps) 
                VALUES (:fullname, :birthday, :age, :address, :socialStatus, :gender, :username, :password, :otps)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':socialStatus', $socialStatus);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);  // Store the hashed password
        $stmt->bindParam(':otps', $otps);  // Handling OTP if needed
        
        // Execute the query
        if ($stmt->execute()) {
            echo "Thank you for registering with HCRIS! We are thrilled to have you on board! 😊";
        } else {
            echo "Error saving data.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
