<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
require('database/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('cssLink.php'); ?>
</head>
<style>
    /* Customize the Owl Carousel navigation buttons */
    .owl-prev,
    .owl-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 60px;
        height: 40px;
        border-radius: 50%;
        background-color: #00b98e;
        color: #fff;
        font-size: 24px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
        z-index: 1000;
    }

    .owl-prev,
    .owl-next {
        text-transform: capitalize;
        content: none;
    }

    .owl-prev {
        left: 10px;
    }

    .owl-next {
        right: 10px;
    }

    .owl-carousel .item {
        width: 280px;
        height: 380px;
        margin-right: 15px;
        margin-left: 15px;
    }

    .owl-carousel .item .team-item {
        width: 100%;
        height: 100%;
    }
</style>

<body>
    <div class="container-fluid p-0">
        <?php
        require_once('includes/header.php');
        ?>
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 30px 0px 20px 0px;">
            <div class="container">
                <form action="properties.php" method="get">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" style="height: 6vh;" name="location" placeholder="Enter local Location">
                                <button class="btn btn-light" type="button" id="near_me"><i class="bi bi-crosshair2"></i></button>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <input type="submit" class="btn" style="height: 6vh; background-color:white; opacity:1; " name="search" id="search" />
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-xxl py-5" id="property_type">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Property Types</h1>
                    <p></p>
                </div>
                <div class="row g-4">
                    <div class="container owl-2-style">
                        <div class="owl-carousel owl-2">
                            <?php
                            $sel = "SELECT * FROM property_types";
                            $query = mysqli_query($con, $sel);
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $name = $row['prop_name'];
                            ?>
                                    <div class="card wow fadeInUp" data-wow-delay="0.1s" style="border:0px;">
                                        <div class="media-29101 p-3">
                                            <h6 class="text-center"><?= $row['prop_name']; ?></h6>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-12">
                    <div class="text-center mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">Property Listing</h1>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="row g-0 gx-5">
                <div class="col-sm-12">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <?php
                                $sel = "SELECT A.*,B.rating
                                FROM properties A
                                LEFT JOIN ratings B ON A.id = B.property_id
                                WHERE status = 1
                                LIMIT 6";
                                $query = mysqli_query($con, $sel);

                                if (mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_assoc($query)) {
                                ?>

                                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="property-item rounded overflow-hidden">
                                                <div class="position-relative overflow-hidden">
                                                    <?php
                                                    $id = $row['id'];
                                                    $selImage = "SELECT * FROM property_images where pr_id='$id'";
                                                    $qu = mysqli_query($con, $selImage);
                                                    if (mysqli_num_rows($qu) > 0) {
                                                        $data = mysqli_fetch_assoc($qu);
                                                    ?>
                                                        <a href="property-desc.php?id=<?= $id; ?>"><img class="img-fluid" src="Admin/Images/propertyImage/<?= $data['image'] ?>" alt=""></a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="property-desc.php?id=<?= $id; ?>"><img class="img-fluid" src="img/icon/prop.png" alt=""></a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div>
                                                    <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                                        <?= $row['prop_name']; ?>
                                                    </div>
                                                </div>
                                                <div class="p-4 pb-0">
                                                    <h6 class="text-primary mb-3">रु <?= $row['price']; ?></h6>
                                                    <a class="d-block h5 mb-2" href="property-desc.php?id=<?= $id; ?>"><?= ucfirst($row['title']); ?></a>
                                                    <p class="card-text"><i class="bi bi-geo-alt-fill text-success"></i> <?= $row['location'] . ', ' . $row['city'] . ',' . $row['state'] . ', ' . $row['country'] . '-' . $row['zip_code'] ?></p>

                                                </div>
                                                <div class="d-flex border-top">
                                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i><?= $row['area']; ?></small>
                                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i><?= $row['bedrooms']; ?> Bed</small>
                                                    <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i><?= $row['bathrooms']; ?> Bath</small>
                                                </div>
                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                                ?>
                                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                    <a class="btn btn-primary py-3 px-5" href="properties.php">Browse More Property</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xxl py-5" id="about">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/about.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">#1 Place To Find The Perfect Property</h1>
                        <p class="mb-4">Looking for the perfect property? Your search ends here! Welcome to our curated collection of exquisite homes tailored to meet your every need.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Best properties here</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xxl py-5" id="agents">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Property Agents</h1>
                    <p>These are our top agents.</p>
                </div>
                <div class="row g-4">
                    <div class="col">
                        <div class="owl-carousel owl-theme">
                            <?php
                            $sel = "SELECT * FROM register_a_u WHERE user_type='agent'";
                            $query = mysqli_query($con, $sel);
                            if (mysqli_num_rows($query) > 0) {
                                while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                    <div class="item">
                                        <div class="team-item rounded overflow-hidden">
                                            <div class="position-relative">
                                                <?php
                                                if ($data['image'] == null) {
                                                ?>
                                                    <img class="img-fluid" src="img/agent/profile.png" alt="">
                                                <?php
                                                } else {
                                                ?>
                                                    <img class="img-fluid" src="Agent/Images/profiles/<?= $data['image'] ?>" style="width: 280px; height:310px;" alt="">
                                                <?php
                                                }
                                                ?>
                                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                                    <a class="btn btn-square mx-1" href="Tel:<?= $data['number']; ?>"><i class="fa fa-phone"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center p-4 mt-3">
                                                <h5 class="fw-bold mb-0"><?= $data['name']; ?></h5>
                                                <small></small>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xxl py-5" id="testimonial">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Our Clients Say!</h1>
                    <p></p>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <?php
                    $selectFeedback = "SELECT * FROM testimonial order by id DESC";
                    $query = mysqli_query($con, $selectFeedback);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <div class="testimonial-item bg-light rounded p-3">
                                <div class="bg-white border rounded p-4">
                                    <p><?= $row['feedback'] ?></p>
                                    <div class="d-flex align-items-center">
                                        <img class="img-fluid flex-shrink-0 rounded" src="img/feedback_image/<?= $row['image'] ?>" style="width: 60px; height: 60px;">
                                        <div class="ps-3">
                                            <h6 class="fw-bold mb-1"><?= $row['name']; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php require_once('includes/footer.php'); ?>
    </div>

    <?php require_once('jslink.php') ?>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 2,
                        nav: false
                    },
                    1000: {
                        items: 4,
                        nav: true,
                        loop: false
                    }
                }
            });
        });

        $(function() {

            if ($('.owl-2').length > 0) {
                $('.owl-2').owlCarousel({
                    center: false,
                    items: 1,
                    loop: true,
                    stagePadding: 0,
                    margin: 20,
                    smartSpeed: 1000,
                    autoplay: true,
                    nav: true,
                    dots: true,
                    pauseOnHover: false,
                    responsive: {
                        600: {
                            margin: 20,
                            nav: true,
                            items: 2
                        },
                        1000: {
                            margin: 20,
                            stagePadding: 0,
                            nav: true,
                            items: 5
                        }
                    }
                });
            }

        });
    </script>
</body>

</html>