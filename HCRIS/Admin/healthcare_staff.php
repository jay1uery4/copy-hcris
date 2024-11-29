<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEALTHCARE_STAFF</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS for enhanced table styling -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Custom style -->
    <link rel="stylesheet" href="../Css/adminhealthcarestuffstyless.css">
     <!-- JavaScript Libraries for Bootstrap and DataTables -->
     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="body">
    <!-- Sidebar for navigation links -->
    <aside>
        <div id="sidenav" class="col-2">
            <li class="nav-item">
                <a href="adminconsultation.php" class="nav-link">
                    <i class="fa-solid fa-hospital me-2"></i>
                    <span class="d-none d-sm-inline text-white">DASHBOARD</span>
                </a>
            </li>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
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
                    <a href="adminlogin.php" class="nav-link">
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

    <!-- Modal for Adding Healthcare Staff -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Healthcare Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="healthcare_staff_process.php" method="post">
                        <div class="form-group">
                            <label for="healthcare_id">Health ID:</label>
                            <input type="text" class="form-control" id="healthcare_id" name="health_id" placeholder="Enter Healthcare ID" required>
                        </div>
                        <div class="form-group">
                            <label for="healthcarestaff_name">Healthcare Staff Name:</label>
                            <input type="text" class="form-control" id="healthcarestaff_name" name="healthcarestaff_name" placeholder="Input Staff name" required>
                        </div>
                        <div class="form-group">
                            <label for="position_of_staff">Position of Staff:</label>
                            <input type="text" class="form-control" id="position_of_staff" name="position_of_staff" placeholder="Position of the staff" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Input Address" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">SAVE</button>
                            <button type="reset" class="btn btn-info">RESET</button>
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="container col-10 bg-light">
            <h3>Add Healthcare Staff</h3>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">Click to add healthcare staff</button>
        </div>

        <!-- Healthcare Staff Table List -->
        <div class="table-container table-responsive text-center">
            <?php
            require 'db_conn.php';
            if (!$conn) {
                echo "Connection failed!";
                exit();
            }

            $sql = "SELECT * FROM admin_healthcare_unit";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table id='healthcareStaffTable' class='display table table-striped table-hover table-bordered mx-auto' style='width: 100%;'>
                        <thead class='bg-success'>
                            <tr>
                                <th>Select</th>
                                <th>Healthcare ID</th>
                                <th>Healthcare Staff Name</th>
                                <th>Position of Staff</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td><input type='checkbox' class='row-checkbox'></td>
                            <td>" . $row['healthcare_id'] . "</td>
                            <td>" . $row['healthcarestaff_name'] . "</td>
                            <td>" . $row['position_of_staff'] . "</td>
                            <td>" . $row['address'] . "</td>
                            <td>
                                <button class='btn btn-success btn-sm' onclick=\"window.location.href='edithealthcarestaff.php?id=" . $row['healthcare_id'] . "'\">Edit</button>
                                <button class='btn btn-danger btn-sm' onclick=\"window.location.href='deletehealthcarestaff.php?healthcare_id=" . $row['healthcare_id'] . "'\">Delete</button>
                            </td>
                          </tr>";
                }
                
                echo "</tbody></table>";
            } else {
                echo "<div class='alert alert-warning'>No records found.</div>";
            }

            $conn->close();
            ?>
        </div>
    </main>


    <!-- DataTable Initialization -->
    <script>
        $(document).ready(function() {
            $('#healthcareStaffTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50]
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
