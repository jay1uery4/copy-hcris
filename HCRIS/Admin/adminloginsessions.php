<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/adminhomepagestyles.css">
    <!-- BUILT IN STYLE OF THE TABLE -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>ADMIN_LOGIN_SESSIONS</title>
</head>
<body>
    <!-- Sidebar for navigation links -->
    <aside>
        <div id="sidenav" class="col-2">
            <ul class="nav nav-pills flex-column mb-auto">
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
                </li>
                <hr>
                <li class="nav-item">
                    <a href="adminloginsessions.php" class="nav-link">
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

    <!-- HEADER NAV BAR -->
    <header>
        <nav class="navbar navbar-expand-sm">
            <div class="logo-text-container">
                <img src="../Photos/logo.png" alt="Healthcare Logo" class="logo">
                <p class="logo-text text-white h3">Panghiawan Barangay Healthcare</p>
            </div>
        </nav>
    </header>

    <!-- MAIN CONTENT OF THE HOME PAGE -->
    <main>
    <div class="table-container table-responsive text-center">
            <?php
            require 'db_conn.php';

            if (!$conn) {
                echo "<div class='alert alert-danger'>Connection failed!</div>";
                exit();
            }

            $sql = "SELECT * FROM admin_loginsessions";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table id='logginSessionTable' class='display table table-striped table-hover table-bordered mx-auto' style='width: 80%;'>
                      <thead>
                            <tr>
                                <th>LOGIN_INDEX</th>
                                <th>ADMIN_NAME</th>
                                <th>ADMIN_ID</th>
                                <th>TIME OF LOGIN</th>
                                <th>TIME OF LOGOUT</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['log_id']}</td>
                            <td>{$row['admin_name']}</td>
                            <td>{$row['admin_id']}</td>
                            <td>{$row['login_time']}</td>
                            <td>{$row['logout_time']}</td>
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
            $('#loginSessionTable').DataTable({
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
