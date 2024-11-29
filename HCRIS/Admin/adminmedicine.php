<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN_MEDICINE</title>
    
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
    <!-- Custom CSS file for additional styles -->
    <link rel="stylesheet" href="../Css/adminmedicinestyless.css">

    <!-- jQuery and DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript bundle for modal and other components -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="container-liquid">
    <!-- Sidebar for navigation links -->
    <aside>
        <div id="sidenav" class="col-2">
            <!-- Sidebar content with navigation links -->
            <li class="nav-item">
                <a href="adminconsultation.php" class="nav-link">
                    <i class="fa-solid fa-hospital me-2"></i>
                    <span class="d-none d-sm-inline text-white">DASHBOARD</span>
                </a>
            </li>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <!-- Sidebar links -->
                <li class="nav-item"><a href="adminconsultation.php" class="nav-link"><i class="fa-solid fa-stethoscope me-2"></i><span class="d-none d-sm-inline text-white">Consultation</span></a></li>
                <hr>
                <li class="nav-item"><a href="adminmedicine.php" class="nav-link"><i class="fa-solid fa-pills me-2"></i><span class="d-none d-sm-inline text-white">Medicine Inventory</span></a></li>
                <hr>
                <li class="nav-item"><a href="healthcare_staff.php" class="nav-link"><i class="fa-solid fa-user-nurse me-2"></i><span class="d-none d-sm-inline text-white">Healthcare Staff</span></a></li>
                <hr>
                <li class="nav-item"><a href="adminpatientrec.php" class="nav-link"><i class="fa-solid fa-user me-2"></i><span class="d-none d-sm-inline text-white">Patient Record</span></a></li>
                <hr>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-chart-line me-2"></i><span class="d-none d-sm-inline text-white">Report</span></a></li>
                <hr>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-history me-2"></i><span class="d-none d-sm-inline text-white">Activity Log</span></a></li>
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
    
    <!-- Header section with site title -->
    <header>
        <nav class="navbar navbar-expand-sm">
            <div class="logo-text-container">
                <img src="../Photos/logo.png" alt="Healthcare Logo" class="logo">
                <p class="logo-text text-white h3">Panghiawan Barangay Healthcare</p>
            </div>
        </nav>
    </header>

    <main>
        <!-- Modal for Adding Medicine -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ADD MEDICINE</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="medicineForm" action="adminmedicine_process.php" method="post">
                            <div class="form-group">
                                <label for="medicine_id">Medicine Id:</label>
                                <input type="text" class="form-control" id="medicine_id" name="medicine_id" placeholder="Enter medicine ID" required>
                            </div>
                            <div class="form-group">
                                <label for="medicine_name">Medicine Name:</label>
                                <input type="text" class="form-control" id="medicine_name" name="medicine_name" placeholder="Enter medicine name" required>
                            </div>
                            <div class="form-group">
                                <label for="medicine_quantity">Medicine Quantity:</label>
                                <input type="number" class="form-control" id="medicine_quantity" name="medicine_quantity" placeholder="Enter quantity" min="1" required>
                            </div>
                            <div class="form-group">
                                <label for="date_manufactured">Date Manufactured:</label>
                                <input type="date" class="form-control" id="date_manufactured" name="date_manufactured" required>
                            </div>
                            <div class="form-group">
                                <label for="expiration_date">Expiration Date:</label>
                                <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" form="medicineForm">SAVE</button>
                        <button type="reset" class="btn btn-info" form="medicineForm">RESET</button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container col-10 bg-light d-flex ">
            <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#myModal">Click to add medicine</button>
        </div>

        <!-- Medicine Inventory Table -->
        <div class="table-container table-responsive text-center">
            <?php
            require 'db_conn.php';

            if (!$conn) {
                echo "<div class='alert alert-danger'>Connection failed!</div>";
                exit();
            }

            $sql = "SELECT * FROM admin_medicine_inventory";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table id='medicineTable' class='display table table-striped table-hover table-bordered mx-auto' style='width: 80%;'>
                      <thead>
                            <tr>
                                <th>Select</th>
                                <th>Medicine ID</th>
                                <th>Medicine Name</th>
                                <th>Quantity</th>
                                <th>Date Manufactured</th>
                                <th>Expiration Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td><input type='checkbox' class='row-checkbox'></td> <!-- Individual row checkbox -->
                            <td>{$row['medicine_id']}</td>
                            <td>{$row['medicine_name']}</td>
                            <td>{$row['medicine_quantity']}</td>
                            <td>{$row['date_manufactured']}</td>
                            <td>{$row['expiration_date']}</td>
                            <td>
                                <div class='d-flex justify-content-between'>
                                    <button class='btn btn-success btn-sm me-2' onclick=\"window.location.href='editmedicineinv.php?medicineId={$row['medicine_id']}'\">
                                        Edit
                                    </button>
                                    <button class='btn btn-danger btn-sm' onclick=\"window.location.href='deletemedicineinv.php?id={$row['medicine_id']}'\">
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

            $conn->close();
            ?>
        </div>
    </main>

    <!-- Initialize DataTables for the medicine table -->
    <script>
        $(document).ready(function() {
            $('#medicineTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "pageLength": 10,
                "lengthMenu": [5, 10, 25, 50, 100, 500, 900 ]
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
