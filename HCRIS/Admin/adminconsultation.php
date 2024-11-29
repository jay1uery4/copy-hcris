    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADMIN_CONSULTATION</title>

        <!-- Bootstrap CSS for styling -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome for icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
        
        <!-- Select2 CSS for searchable dropdowns -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



        <!-- DataTables CSS for table styling -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="../Javascript/get_patient.js"></script>
        <script src="../Javascript/get_id.js"></script>

        <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/adminconsultationstyles.css">
    </head>
    <body class="body">

        <!-- Header Navigation Bar -->
        <header>
            <nav class="navbar navbar-expand-sm">
                <div class="logo-text-container">
                    <img src="../Photos/logo.png" alt="Healthcare Logo" class="logo">
                    <p class="logo-text text-white h3">Panghiawan Barangay Healthcare</p>
                </div>
            </nav>
        </header>

        <aside>
        <div id="sidenav" class="col-2">
                <li class="nav-item">
                    <a href="adminhomepage.php" class="nav-link">
                        <i class="fa-solid fa-hospital me-2"></i>
                        <span class="d-none d-sm-inline text-white">DASHBOARD</span>
                    </a>
                </li>
                <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <!-- Each list item represents a link to a different page -->
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

            <!-- Add Consultation Modal (unchanged content) -->
            <div class="modal fade" id="addConsultationModal" tabindex="-1" aria-labelledby="addConsultationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addConsultationModalLabel">Add Consultation Here</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Consultation Form with input fields for consultation details -->
                            <form id="consultationForm" method="post" action="adminconsultation_process.php">
                                <div class="mb-3">
                                    <label for="consultationId" class="form-label">Consultation ID:</label>
                                    <input type="text" class="form-control" id="consultationId" name="consultation_id" placeholder="Enter Consultation ID" required>
                                </div>
                                <div class="mb-3">
                                    <label for="healthcare_id" class="form-label">Health Staff ID:</label>
                                    <input type="text" class="form-control" id="healthcare_id" name="healthcare_id" placeholder="Enter Health Staff ID" required>
                                </div>
                                <div class="mb-3">
                                    <label for="patient_id" class="form-label">Patient ID:</label>
                                    <select id="patient_id" name="patient_id" onchange="updatePatientName()" required>
                                        <option value="" disabled selected>Select Patient</option>
                                        <?php include 'get_patient_data.php'; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="patient_name" class="form-label">Patient Name:</label>
                                    <input type="text" class="form-control" id="patient_name" name="patient_name" placeholder="Patient Name" readonly required>
                                </div>
                                <div class="mb-3">
                                    <label for="medicine_id" class="form-label">Medicine ID:</label>
                                    <select id="medicine_id" name="medicine_id" onchange="updateMedicineName()" required>
                                        <option value="" disabled selected>Select medicine</option>
                                        <?php include 'get_medicine_select.php'; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="medicine_name" class="form-label">Medicine Name:</label>
                                    <input type="text" class="form-control" id="medicine_name" name="medicine_name" placeholder="Enter Medicine Name" readonly required>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity:</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" min="1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="time" class="form-label">Time:</label>
                                    <input type="time" class="form-control" id="time" name="time" required>
                                </div>
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date:</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form="consultationForm" class="btn btn-primary">Save</button>
                            <button type="reset" form="consultationForm" class="btn btn-info">Reset</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            
        <main>
            <!-- Button to open the Consultation Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addConsultationModal">
                Add Consultation
            </button>
            <!-- PHP for database connection and data retrieval -->
            <?php
            require 'db_conn.php';

            if (!$conn) {
                echo "Connection failed!";
                exit();
            }

            // Query to select data from the table
            $sql = "SELECT * FROM medical_record";
            $result = $conn->query($sql);
            ?>

            <!-- Container for Consultation Table -->
            <div class="container table-container">
                <?php
                if ($result && $result->num_rows > 0) {
                    echo "<table id='consultationTable' class='display table table-striped table-hover table-bordered' style='width:100%;'>
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Consultation ID</th>
                                    <th>Health ID</th>
                                    <th>Patient ID</th>
                                    <th>Patient Name</th>
                                    <th>Medicine ID</th>
                                    <th>Medicine Name</th>
                                    <th>Quantity</th>
                                    <th>Time</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>";
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td><input type='checkbox' class='row-checkbox'></td>
                                <td>" . $row['consultation_id'] . "</td>
                                <td>" . $row['healthcare_id'] . "</td>
                                <td>" . $row['patient_id'] . "</td>
                                <td>" . $row['patient_name'] . "</td>
                                <td>" . $row['medicine_id'] . "</td>
                                <td>" . $row['medicine_name'] . "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>" . $row['time_'] . "</td>
                                <td>" . $row['date_'] . "</td>
                                <td>
                                    <button class='btn btn-success btn-sm' onclick=\"window.location.href='editconsultation.php?consultationId=" . $row['consultation_id'] . "'\">Edit</button>
                                    <button class='btn btn-danger btn-sm' onclick=\"window.location.href='deleteconsultation.php?patient_id=" . $row['patient_id'] . "'\">Delete</button>
                                </td>
                            </tr>";
                    }

                    echo "</tbody></table>";
                } else {
                    echo "<p>No records found.</p>";
                }
                ?>
            </div>
        </main>


        <!-- JavaScript Libraries for jQuery, Bootstrap, Select2, and DataTables -->
        <!-- Initialize DataTables -->
        <script>
        $(document).ready(function() {
            $('#consultationTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50]
            });

            // Initialize Select2 with custom width for dropdowns
            $('#patient_id').select2({
                width: '100%' // Set width to 100% for a full-width dropdown
            });
            
            $('#medicine_id').select2({
                width: '100%' // Set width to 100% for a full-width dropdown
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


    </script>


    </body>
    </html>
