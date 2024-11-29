<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/adminhomepagestyles.css">
    <title>ADMIN_HOME_PAGE</title>
</head>
<body>

    <!-- Sidebar Toggle Button for Small Screens -->
    <button id="sidebarToggle" class="btn btn-dark d-md-none" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i> Menu
    </button>

    <!-- Sidebar for navigation links -->
    <aside>
        <div id="sidenav" class="col-2">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-hospital me-2"></i>
                        <span class="d-none d-sm-inline text-white"></span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-stethoscope me-2"></i>
                        <span class="d-none d-sm-inline text-white"></span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-pills me-2"></i>
                        <span class="d-none d-sm-inline text-white"></span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-user-nurse me-2"></i>
                        <span class="d-none d-sm-inline text-white"></span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-user me-2"></i>
                        <span class="d-none d-sm-inline text-white"></span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-chart-line me-2"></i>
                        <span class="d-none d-sm-inline text-white"></span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-history me-2"></i>
                        <span class="d-none d-sm-inline text-white"></span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-sign-out-alt me-2"></i>
                        <span class="d-none d-sm-inline text-white"></span>
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
        <div class="main-content">
            <div id="maincard" class="card">
                <div class="card-body">
                    <h5 class="card-title fa-solid fa-ghost"></h5>
                    <p class="card-text h5">WELCOME USER.</p>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
