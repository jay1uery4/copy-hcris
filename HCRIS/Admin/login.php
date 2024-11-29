<?php
session_start();
include "db_conn.php"; // Make sure this file has a working database connection

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: Index.php?error=Username is required");
        exit();
    } else if (empty($pass)) {
        header("Location: Index.php?error=Password is required");
        exit();
    } else {
        // Hashing the password
        $pass = md5($pass);

        // Query to check if admin credentials are correct
        $sql = "SELECT * FROM admin_register WHERE username ='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['admin_name'] = $row['admin_name'];
                $_SESSION['admin_id'] = $row['admin_id'];

                // Insert a new login session record
                $admin_id = $row['admin_id'];
                $admin_name = $row['admin_name'];
                $login_sql = "INSERT INTO admin_loginsessions (admin_name, admin_id, login_time, action_type) 
                              VALUES ('$admin_name', '$admin_id', NOW(), 'login')";

                if (!mysqli_query($conn, $login_sql)) {
                    echo "Error inserting login record: " . mysqli_error($conn);
                }

                header("Location: adminhomepage.php");
                exit();
            } else {
                header("Location: Index.php?error=Incorrect Username or password");
                exit();
            }
        } else {
            header("Location: Index.php?error=Incorrect Username or password");
            exit();
        }
    }

} else {
    header("Location: Index.php");
    exit();
}
?>
