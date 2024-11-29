<?php 
session_start();
include "../Admin/db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['name']) && isset($_POST['re_password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);
    $name = validate($_POST['name']); 

    $user_data = 'uname='. $uname. '&name='. $name;

    // Validation checks
    if (empty($uname)) {
        header("Location: signup.php?error=Username is required&$user_data");
        exit();
    } else if (empty($pass)) {
        header("Location: signup.php?error=Password is required&$user_data");
        exit();
    } else if (empty($re_pass)) {
        header("Location: signup.php?error=Re-enter Password is required&$user_data");
        exit();
    } else if (empty($name)) {
        header("Location: signup.php?error=Name is required&$user_data");
        exit();
    } else if ($pass !== $re_pass) {
        header("Location: signup.php?error=The confirmation password does not match&$user_data");
        exit();
    } else {
        // Hash the password using password_hash() for security
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // Check if the username is already taken
        $sql = "SELECT * FROM userpatient_register WHERE patient_username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $uname);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            header("Location: user-signup.php?error=The username is already taken, try another&$user_data");
            exit();
        } else {
            // Insert new user into the userpatient_register table
            $sql2 = "INSERT INTO userpatient_register (patient_username, patient_password, patient_name) VALUES (?, ?, ?)";
            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, "sss", $uname, $hashed_pass, $name);

            if (mysqli_stmt_execute($stmt2)) {
                header("Location: user-signup.php?success=Your account has been created successfully");
                exit();
            } else {
                header("Location: user-signup.php?error=Unknown error occurred&$user_data");
                exit();
            }
        }
    }
} else {
    header("Location: user-signup.php");
    exit();
}
