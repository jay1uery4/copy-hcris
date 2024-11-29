<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formdesign.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>EDIT_PATIENT_RECORD</title>
</head>
<body>


            <?php
            include "db_conn.php"; // Include your database connection file

            // Initialize userData
            $userData = null;

            // Check if the patient Rec parameter is set in the URL
            if (isset($_GET['patient_id'])) {
                $patientId = filter_var($_GET['patient_id'], FILTER_SANITIZE_NUMBER_INT);

                // Fetch patient records details from the database
                $sql = "SELECT * FROM adminpatient_record WHERE patient_id= ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $patientId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $userData = $result->fetch_assoc();
                } else {
                    echo "<div class='alert alert-danger'>Patient not found.</div>";
                    exit();
                }

                $stmt->close();
            } else {
                echo "<div class='alert alert-warning'>Patient ID not provided.</div>";
                exit();
            }
            ?>
            
            <form class="form" action="updatemedicineinv.php" method="post">
                <h2>Edit Medicine</h2>
                
                <div class="form-group">
                    <label for="medicine_id">Medicine Id:</label>
                    <input type="number" class="form-control" id="medicine_id" name="medicine_id" value="<?php echo htmlspecialchars($userData['medicine_id']); ?>" readonly required>
                </div>
                <div class="form-group">
                    <label for="medicine_name">Medicine Name:</label>
                    <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="<?php echo htmlspecialchars($userData['medicine_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="medicine_quantity">Medicine Quantity:</label>
                    <input type="number" class="form-control" id="medicine_quantity" name="medicine_quantity" value="<?php echo htmlspecialchars($userData['medicine_quantity']); ?>" min="1" required>
                </div>
                <div class="form-group">
                    <label for="date_manufactured">Date Manufactured:</label>
                    <input type="date" class="form-control" id="date_manufactured" name="date_manufactured" value="<?php echo htmlspecialchars($userData['date_manufactured']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="expiration_date">Expiration Date:</label>
                    <input type="date" class="form-control" id="expiration_date" name="expiration_date" value="<?php echo htmlspecialchars($userData['expiration_date']); ?>" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    <button type="button" onclick="window.location.href='updatemedicineinv.php'" class="btn btn-warning">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
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