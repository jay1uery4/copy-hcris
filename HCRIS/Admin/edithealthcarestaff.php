<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formdesign.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>EDIT_HEALTHCARE_STAFF</title>
</head>
<body>

<?php
include "db_conn.php"; // Include your database connection file

if (isset($_GET['id'])) {
    $healthcare_id = $_GET['id']; // Capture the healthcare ID from URL
} else {
    echo "Health ID not provided.";
    exit();
}

// Fetch healthcare staff details from the database
$sql = "SELECT * FROM admin_healthcare_unit WHERE healthcare_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $healthcare_id); // Bind the healthcare ID to the SQL query
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc(); // Fetch the healthcare staff data
} else {
    echo "<div class='alert alert-danger'>Health ID not found.</div>";
    exit();
}

$stmt->close();
?>

<form class="form" action="updatehealthcarestaff.php" method="post">
    <h2>Edit Healthcare Staff</h2>
    <div class="form-group">
        <label for="health_id">Health ID:</label>
        <input type="text" class="form-control" id="health_id" name="health_id" value="<?php echo htmlspecialchars($userData['healthcare_id']); ?>" min="1" required readonly>
    </div>
    <div class="form-group">
        <label for="healthcarestaff_name">Healthcare Staff Name:</label>
        <input type="text" class="form-control" id="healthcarestaff_name" name="healthcarestaff_name" value="<?php echo htmlspecialchars($userData['healthcarestaff_name']); ?>" required>
    </div>
    <div class="form-group">
        <label for="position_of_staff">Position of Staff:</label>
        <input type="text" class="form-control" id="position_of_staff" name="position_of_staff" value="<?php echo htmlspecialchars($userData['position_of_staff']); ?>" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($userData['address']); ?>" required>
    </div>

    <div class="text-center">
        <button type="submit" onclick="window.location.href='updatehealthcarestaff.php'" class="btn btn-primary">UPDATE</button>
        <button type="button" onclick="window.location.href='healthcare_staff.php'" class="btn btn-warning">CANCEL</button>
    </div>
</form>

<?php
// Close the database connection
$conn->close();
?>

</body>
</html>
<script>
            document.addEventListener('DOMContentLoaded', function () {
        // Ensure the DOM is fully loaded before running the script
        const logoutButton = document.querySelector('#signOutBtn');
        if (logoutButton) {
            logoutButton.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent the default link action
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to sign out?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, sign out!',
                    cancelButtonText: 'No, stay logged in'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'logout.php'; // Adjust the URL to your logout script
                    }
                });
            });
        } else {
            console.error("Logout button (signOutBtn) not found!");
        }
    });

</script>