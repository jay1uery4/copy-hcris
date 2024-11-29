<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap JavaScript bundle for modal and other components -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- BUILT IN STYLE OF THE TABLE -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom CSS file for additional styles -->
    <link rel="stylesheet" href="../Css/patientrecordstyles.css">

    <title>ADMIN_PATIENT_RECORD</title>
</head>
<body>
    <!-- Sidebar for navigation links -->
    <aside>
        <div id="sidenav" class="col-2">
            <ul class="nav nav-pills flex-column mb-auto">
                <!-- Navigation Links -->
                <li class="nav-item">
                    <a href="adminhomepage.php" class="nav-link">
                        <i class="fa-solid fa-hospital me-2"></i>
                        <span class="d-none d-sm-inline text-white">DASHBOARD</span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="adminconsultation.php" class="nav-link">
                        <i class="fa-solid fa-stethoscope me-2"></i>
                        <span class="d-none d-sm-inline text-white">Consultation</span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="adminmedicine.php" class="nav-link">
                        <i class="fa-solid fa-pills me-2"></i>
                        <span class="d-none d-sm-inline text-white">Medicine Inventory</span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="healthcare_staff.php" class="nav-link">
                        <i class="fa-solid fa-user-nurse me-2"></i>
                        <span class="d-none d-sm-inline text-white">Healthcare Staff</span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="adminpatientrec.php" class="nav-link">
                        <i class="fa-solid fa-user me-2"></i>
                        <span class="d-none d-sm-inline text-white">Patient Record</span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-chart-line me-2"></i>
                        <span class="d-none d-sm-inline text-white">Report</span>
                    </a>
                 <hr>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-history me-2"></i>
                        <span class="d-none d-sm-inline text-white">Activity Log</span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a id="signOutBtn" class="nav-link">
                        <i class="fa-solid fa-sign-out-alt me-2"></i>
                        <span class="d-none d-sm-inline text-white">Log Out</span>
                    </a>
                </li>

            </ul>
        </div>
    </aside>

    <!-- Header Navigation Bar -->
    <header>
        <nav class="navbar navbar-expand-sm">
            <div class="logo-text-container">
                <img src="../Photos/logo.png" alt="Healthcare Logo" class="logo">
                <p class="logo-text text-white h3">Panghiawan Barangay Healthcare</p>
            </div>
        </nav>
    </header>

    <!-- The Modal -->
    <div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPatientModalLabel">Add Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form element added -->
                    <form id="patientForm" action="adminpatientrec_process.php" method="POST">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Patient Name:</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>

                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthdate:</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="age" class="form-label">Age:</label>
                            <input type="number" class="form-control" id="age" name="age"required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>

                        <div class="mb-3">
                            <label for="social_stat" class="form-label">Social Status:</label>
                            <input type="text" class="form-control mb-2" id="social_stat" name="social_stat"required>
                            <select id="patient-socialStatus" class="form-control" name="socialStatus" required>
                                <option value="">Select Social Status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="widowed">Widowed</option>
                                <option value="divorced">Divorced</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender:</label>
                            <select id="gender" class="form-control" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username"required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <div class="password-wrapper">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                                <span id="togglePassword" class="toggle-icon">👁️</span>
                            </div>
                        </div>
                            
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- Form Submit button -->
                    <button type="submit" form="patientForm" class="btn btn-primary">SAVE</button>
                    <button type="reset" form="patientForm" class="btn btn-info">RESET</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="container col-10 bg-light">
            <h3>Add Patient Record</h3>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPatientModal">
                Add Patient
            </button> <!-- Responsive Table List -->
            <!-- Responsive Table List -->
    
            <?php
            require '../Admin/db_conn.php';
            // Check connection
            if (!$conn) {
                echo "Connection failed!";
                exit();
            }

            // Query to select data from the table
            $sql = "SELECT * FROM patients";
            $result = $conn->query($sql);
            ?>

            <?php
            // Check if there are results and display them
            if ($result->num_rows > 0) {
                echo "<table id='patientTable' class='display table table-striped table-hover table-bordered mx-auto' style='width: 80%;'>
                        <thead class='bg-success'>
                            <tr>
                                <th>Select</th>
                                <th>Patient ID</th>
                                <th>Full Name</th>
                                <th>Birthdate</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Social Status</th>
                                <th>Gender</th>
                                <th>Username</th>
                                <th>OTP's</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";
            
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td><input type='checkbox' class='row-checkbox'></td>
                            <td>" . $row['patient_id'] . "</td>
                            <td>" . $row['fullname'] . "</td>
                            <td>" . $row['birthday'] . "</td>
                            <td>" . $row['age'] . "</td>
                            <td>" . $row['address'] . "</td>
                            <td>" . $row['Social_stat'] . "</td>
                            <td>" . $row['gender'] . "</td>
                            <td>" . $row['username'] . "</td>
                            <td>" . $row['otps'] . "</td>
                            <td class='btn-container'>
                                <div class='d-flex justify-content-between'>
                                    <button class='btn btn-success btn-sm me-2' onclick=\"window.location.href='editpatientrec.php?id=" . $row['patient_id'] . "'\">
                                        Edit
                                    </button>
                                    <button class='btn btn-danger btn-sm' onclick=\"window.location.href='deletepatientrec.php?id=" . $row['patient_id'] . "'\">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<div class='alert alert-warning'>No records found.</div>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </main>

    <!-- SCRIPT OF THE TABLE BELOW -->
    <script>
        $(document).ready(function() {
            $('#patientTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "pageLength": 10,
                "lengthMenu": [5, 10, 25, 50]
            });
        });
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
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', () => {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;

        // Change the button text/icon
        togglePassword.textContent = type === 'password' ? '👁️' : '🙈';
    });
    </script>

</body>
</html>
