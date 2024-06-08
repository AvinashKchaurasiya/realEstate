<header>
    <div id="sidenav-1" class="sidenav" role="navigation" data-hidden="false" data-accordion="true">
        <a class="ripple d-flex justify-content-center py-4" href="dashboard.php" data-ripple-color="primary" style="text-decoration: none;">
            <img id="MDB-logo" src="Images/icon/logo.png" alt="MDB Logo" draggable="false" />
            <h4 class="m-3 mt-4 text-dark">MainBazar</h4>
        </a>
        <ul class="sidenav-menu" style="font-weight: bold;">
            <li class="sidenav-item">
                <a class="sidenav-link" href="dashboard.php" style="text-decoration: none;">
                    <i class="fas fa-chart-area pr-3"></i><span>Dashboard</span></a>
            </li>
            <li class="sidenav-item">
                <a class="sidenav-link" style="text-decoration: none;"><i class="fas fa-cogs pr-3"></i><span>Properties</span></a>
                <ul class="sidenav-collapse">
                    <li class="sidenav-item">
                        <a href="properties.php" class="sidenav-link" style="text-decoration: none;">All Properties</a>
                    </li>
                    <li class="sidenav-item">
                        <a href="property_type.php" class="sidenav-link" style="text-decoration: none;">Property Type</a>
                    </li>
                </ul>
            </li>
            <li class="sidenav-item">
                <a href="rating.php" class="sidenav-link" style="text-decoration: none;"><i class="bi bi bi-star-half pr-3"></i><span>Rating</span></a>
            </li>
        </ul>
    </div>
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container-fluid">
            <button data-toggle="sidenav" data-target="#sidenav-1" class="btn shadow-0 p-0 mr-3 d-block d-xxl-none" aria-controls="#sidenav-1" aria-haspopup="true">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <ul class="navbar-nav ml-auto d-flex flex-row">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                        <?php
                        $email = $_SESSION['email'];;
                        $select = "SELECT * from register_a_u where email='$email'";
                        $query = mysqli_query($con, $select);
                        if ($query) {
                            $row = mysqli_fetch_array($query);
                        ?>
                            <span><?= $row['name']; ?></span>
                        <?php
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="profile.php">My profile</a></li>
                        <li><a class="dropdown-item" href="auth/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>