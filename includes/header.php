<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="index" class="navbar-brand d-flex align-items-center text-center">
            <div class="icon p-2 me-2">
                <img class="img-fluid" src="img/icon-deal.png" alt="Icon" style="width: 30px; height: 30px;">
            </div>
            <h1 class="m-0 text-primary">MainBazar</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Property</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="properties" class="dropdown-item">Property List</a>
                        <a href="#property_type" class="dropdown-item">Property Type</a>
                        <a href="#agents" class="dropdown-item">Property Agent</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="#testimonial" class="dropdown-item">Testimonial</a>
                    </div>
                </div>
                <a href="contact" class="nav-item nav-link">Contact</a>
            </div>
            <?php
            if (isset($_SESSION['name']) and isset($_SESSION['email'])) {
            ?>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle btn btn-primary px-3 d-none d-lg-flex" data-bs-toggle="dropdown"><?= $_SESSION['name']; ?></a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="" class="dropdown-item">Profile</a>
                        <a href="" class="dropdown-item">Change Password</a>
                        <a href="Authentication/logout" class="dropdown-item">Logout</a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <a href="Login" class="btn btn-primary px-3 d-none d-lg-flex">Login</a>
            <?php
            }
            ?>

        </div>
    </nav>
</div>
<div class="container-fluid header bg-white p-0">
    <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
        <div class="col-sm-12 animated fadeIn">
            <div class="owl-carousel header-carousel">
                <div class="owl-carousel-item">
                    <img class="img-fluid" style="height: 60vh;" src="img/carousel-1.jpg" alt="">
                </div>
                <div class="owl-carousel-item">
                    <img class="img-fluid" style="height: 60vh;" src="img/carousel-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>