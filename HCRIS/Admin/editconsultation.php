<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formdesign.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Edit Medicine</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <?php
            include "db_conn.php"; // Include your database connection file

            // Initialize userData
            $userData = null;

            // Check if the consultationId parameter is set in the URL
            if (isset($_GET['consultationId'])) {
                $consultationId = filter_var($_GET['consultationId'], FILTER_SANITIZE_NUMBER_INT);

                // Fetch medicine details from the database
                $sql = "SELECT * FROM medical_record WHERE consultation_id = ?"; // Adjusted column name
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $consultationId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $userData = $result->fetch_assoc();
                } else {
                    echo "<div class='alert alert-danger'>Record not found.</div>";
                    exit();
                }

                $stmt->close();
            } else {
                echo "<div class='alert alert-warning'>Consultation Id not found in URL!</div>";
                exit();
            }
            ?>
            
            <form class="form" action="updateconsultation.php" method="post">
                <h2>Edit Consultation</h2>
                
                <div class="form-group">
                    <label for="consultationId">Consultation ID:</label>
                    <input type="text" class="form-control" id="consultationId" name="consultationId" value="<?php echo htmlspecialchars($userData['consultation_id']); ?>" readonly required>
                </div>
                <div class="form-group">
                    <label for="healthcare_id">Healthcare ID:</label>
                    <input type="text" class="form-control" id="healthcare_id" name="healthcare_id" value="<?php echo htmlspecialchars($userData['healthcare_id']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="patient_id">Patient ID:</label>
                    <input type="text" class="form-control" id="patient_id" name="patient_id" value="<?php echo htmlspecialchars($userData['patient_id']); ?>" min="1" required>
                </div>
                <div class="form-group">
                    <label for="medicine_id">Medicine ID:</label>
                    <input type="text" class="form-control" id="medicine_id" name="medicine_id" value="<?php echo htmlspecialchars($userData['medicine_id']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="medicine_name">Medicine Name:</label>
                    <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="<?php echo htmlspecialchars($userData['medicine_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo htmlspecialchars($userData['quantity']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="time" class="form-control" id="time" name="time" value="<?php echo htmlspecialchars($userData['time_']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($userData['date_']); ?>" required>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    <button type="button" onclick="window.location.href='adminconsultation.php'" class="btn btn-warning">CANCEL</button>
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
