<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['re_password']) && isset($_POST['user_id']) && isset($_POST['email']) && isset($_POST['login_type'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Retrieve and validate form inputs
    $user_id = validate($_POST['user_id']);
    $username = validate($_POST['username']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $login_type = validate($_POST['login_type']);

    $user_data = 'user_id=' . $user_id . '&username=' . $username . '&name=' . $name . '&email=' . $email . '&login_type=' . $login_type;

    // Form Validation
    if (empty($user_id)) {
        header("Location: user_signup.php?error=User ID is required&$user_data");
        exit();
    } else if (empty($username)) {
        header("Location: user_signup.php?error=Username is required&$user_data");
        exit();
    } else if (empty($pass)) {
        header("Location: user_signup.php?error=Password is required&$user_data");
        exit();
    } else if (empty($re_pass)) {
        header("Location: user_signup.php?error=Re-enter Password is required&$user_data");
        exit();
    } else if (empty($name)) {
        header("Location: user_signup.php?error=Name is required&$user_data");
        exit();
    } else if (empty($email)) {
        header("Location: user_signup.php?error=Email is required&$user_data");
        exit();
    } else if (empty($login_type)) {
        header("Location: user_signup.php?error=Login Type is required&$user_data");
        exit();
    } else if ($pass !== $re_pass) {
        header("Location: user_signup.php?error=The confirmation password does not match&$user_data");
        exit();
    } else {
        // Check if username or email already exists
        $sql = "SELECT * FROM user_register WHERE username='$username' OR email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: user_signup.php?error=Username or email is already taken&$user_data");
            exit();
        } else {
            // // Hash the password before storing it
            // $hashed_pass = md5($pass);

            // Insert the user data into the database
            $sql2 = "INSERT INTO user_register (user_id, username, password, name, email, usertype) VALUES ('$user_id', '$username', '$hashed_pass', '$name', '$email', '$login_type')";
            $result2 = mysqli_query($conn, $sql2);

            if ($result2) {
                header("Location: user_signup.php?success=Your account has been created successfully");
                exit();
            } else {
                // Capture and display the MySQL error if the query fails
                $error_message = mysqli_error($conn);
                header("Location: user_signup.php?error=" . urlencode("Error: " . $error_message) . "&$user_data");
                exit();
            }
        }
    }
} else {
    header("Location: user_signup.php");
    exit();
}
?>
