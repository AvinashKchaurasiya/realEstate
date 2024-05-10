<!-- htenshdyxccmgpbu -->
<?php
session_start();
require('database/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('cssLink.php'); ?>
    <style>
        .carousel-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <!-- Spinner Start -->
        <?php
        require_once('includes/header2.php');
        ?>
        <div class="container py-5">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-12">
                    <div class="mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">Properties</h1>
                    </div>
                </div>
            </div>
            <div class="row g-0 gx-5 wow slideInLeft">
                <div class="col-sm-3 nb-3" style="border-right: 1px solid;">
                    <div class="card">
                        <div class="card-title">
                            Filter Property
                        </div>
                        <div class="card-body">
                            <form>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <?php
                    if (isset($_GET['location'])) {
                        $location = $_GET['location'];
                        $sel = "SELECT *
                        FROM properties Where status=1 and
                        WHERE A.location LIKE '%$location%' 
                            OR A.city LIKE '%$location%' 
                            OR A.state LIKE '%$location%' 
                            OR A.country LIKE '%$location%' 
                            OR A.zip_code LIKE '%$location%'
                        GROUP BY A.id";
                        $query = mysqli_query($con, $sel);
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <div id="carouselExampleFade<?= $row['id']; ?>" class="carousel slide carousel-fade">
                                                <div class="carousel-inner">
                                                    <?php
                                                    $id = $row['id'];
                                                    $selImage = "SELECT * FROM property_images where pr_id='$id'";
                                                    $qu = mysqli_query($con, $selImage);
                                                    $active = true;
                                                    while ($data = mysqli_fetch_assoc($qu)) {
                                                    ?>
                                                        <div class="carousel-item <?= $active ? 'active' : ''; ?>">
                                                            <a href="property-desc?id=<?= $id; ?>"><img src="Admin/Images/propertyImage/<?= $data['image'] ?>" class="d-block w-100" alt="..."></a>
                                                        </div>
                                                    <?php
                                                        $active = false;
                                                    }
                                                    ?>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade<?= $row['id']; ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade<?= $row['id']; ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h6 style="display: flex; justify-content:space-between;">
                                                    <p class="text-success"><i class="bi bi-currency-rupee" style="font-weight:bold;"></i><?= $row['price']; ?></p>
                                                    <?php
                                                    $sel = "SELECT * FROM ratings WHERE property_id='$id'";
                                                    $query = mysqli_query($con, $sel);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        $count_5 = 0;
                                                        $count_4 = 0;
                                                        $count_3 = 0;
                                                        $count_2 = 0;
                                                        $count_1 = 0;
                                                        $total_rating_sum = 0;
                                                        $total_ratings = 0;
                                                        while ($row1 = mysqli_fetch_assoc($query)) {
                                                            if ($row1['rating'] == 5) {
                                                                $count_5++;
                                                            } else if ($row1['rating'] == 4) {
                                                                $count_4++;
                                                            } else if ($row1['rating'] == 3) {
                                                                $count_3++;
                                                            } else if ($row1['rating'] == 2) {
                                                                $count_2++;
                                                            } else if ($row1['rating'] == 1) {
                                                                $count_1++;
                                                            }
                                                            $total_rating_sum += $row1['rating'];
                                                            $total_ratings++;
                                                        }
                                                        $total_average_rating = ($total_ratings > 0) ? $total_rating_sum / $total_ratings : 0;
                                                    ?>
                                                        <p class="btn btn-success">
                                                            <?= round($total_average_rating, 1); ?> <i class="bi bi-star-fill"></i>
                                                        </p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p class="btn btn-success">
                                                            0 <i class="bi bi-star-fill"></i>
                                                        </p>
                                                    <?php
                                                    }
                                                    ?>
                                                </h6>
                                                <h5 class="card-title">
                                                    <a href="property-desc?id=<?= $id; ?>">
                                                        <p class="text-success"><?= $row['title']; ?> [<?= $row['prop_name'] ?>]</p>
                                                    </a>
                                                </h5>
                                                <p class="card-text"><?= substr($row['description'], 0, 80); ?>....</p>
                                                <p class="card-text"><i class="bi bi-geo-alt-fill text-success"></i> <?= $row['location'] . ', ' . $row['city'] . ',' . $row['state'] . ', ' . $row['country'] . '-' . $row['zip_code'] ?></p>
                                                <p class="card-text"><i class="fa fa-bed text-success"></i> <?= $row['bedrooms']; ?> Bed, <i class="fa fa-bath text-success"></i> <?= $row['bedrooms']; ?> Bath, <i class="fa fa-ruler-combined text-success"></i> <?= $row['area']; ?> Sqft</p>

                                                <p class="card-text text-end disable"><small class="text-body-secondary">
                                                        <?php
                                                        $givenDate = $row['updated_at'];
                                                        $givenDateTime = new DateTime($givenDate);
                                                        $currentDateTime = new DateTime();
                                                        $difference = $currentDateTime->getTimestamp() - $givenDateTime->getTimestamp();
                                                        $minutesDifference = round($difference / 60);
                                                        if ($minutesDifference < 1) {
                                                            $output = 'Just now';
                                                        } elseif ($minutesDifference < 60) {
                                                            $output = $minutesDifference . ' mins ago';
                                                        } elseif ($minutesDifference < 1440) {
                                                            $hoursDifference = round($minutesDifference / 60);
                                                            $output = $hoursDifference . ' hours ago';
                                                        } else {
                                                            $daysDifference = round($minutesDifference / 1440);
                                                            $output = $daysDifference . ' days ago';
                                                        }
                                                        echo $output;
                                                        ?>
                                                    </small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="">
                                <p class="text-danger text-center">There is not a single properties on your serched location!!!</p>
                            </div>
                            <?php
                        }
                    } else {
                        $sel = "SELECT * FROM properties Where status=1";
                        $query = mysqli_query($con, $sel);
                        if ($count = mysqli_num_rows($query) > 0) {
                            echo $count;
                            while ($row = mysqli_fetch_assoc($query)) {
                                $id = $row['id'];
                            ?>
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <div id="carouselExampleFade<?= $row['id']; ?>" class="carousel slide carousel-fade">
                                                <div class="carousel-inner">
                                                    <?php
                                                    $selImage = "SELECT * FROM property_images where pr_id='$id'";
                                                    $qu = mysqli_query($con, $selImage);
                                                    $active = true;
                                                    while ($data = mysqli_fetch_assoc($qu)) {
                                                    ?>
                                                        <div class="carousel-item <?= $active ? 'active' : ''; ?>">
                                                            <a href="property-desc?id=<?= $id; ?>"><img src="Admin/Images/propertyImage/<?= $data['image'] ?>" class="d-block w-100" alt="..."></a>
                                                        </div>
                                                    <?php
                                                        $active = false;
                                                    }
                                                    ?>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade<?= $row['id']; ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade<?= $row['id']; ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h6 style="display: flex; justify-content:space-between;">
                                                    <p class="text-success"><i class="bi bi-currency-rupee" style="font-weight:bold;"></i><?= $row['price']; ?></p>
                                                    <?php
                                                    $sel = "SELECT * FROM ratings WHERE property_id='$id'";
                                                    $query = mysqli_query($con, $sel);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        $count_5 = 0;
                                                        $count_4 = 0;
                                                        $count_3 = 0;
                                                        $count_2 = 0;
                                                        $count_1 = 0;
                                                        $total_rating_sum = 0;
                                                        $total_ratings = 0;
                                                        while ($row1 = mysqli_fetch_assoc($query)) {
                                                            if ($row1['rating'] == 5) {
                                                                $count_5++;
                                                            } else if ($row1['rating'] == 4) {
                                                                $count_4++;
                                                            } else if ($row1['rating'] == 3) {
                                                                $count_3++;
                                                            } else if ($row1['rating'] == 2) {
                                                                $count_2++;
                                                            } else if ($row1['rating'] == 1) {
                                                                $count_1++;
                                                            }
                                                            $total_rating_sum += $row1['rating'];
                                                            $total_ratings++;
                                                        }
                                                        $total_average_rating = ($total_ratings > 0) ? $total_rating_sum / $total_ratings : 0;
                                                    ?>
                                                        <p class="btn btn-success">
                                                            <?= round($total_average_rating, 1); ?> <i class="bi bi-star-fill"></i>
                                                        </p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p class="btn btn-success">
                                                            0 <i class="bi bi-star-fill"></i>
                                                        </p>
                                                    <?php
                                                    }
                                                    ?>
                                                </h6>
                                                <h5 class="card-title">
                                                    <a href="property-desc?id=<?= $id; ?>">
                                                        <p class="text-success"><?= $row['title']; ?> [<?= $row['prop_name'] ?>]</p>
                                                    </a>
                                                </h5>
                                                <p class="card-text"><?= substr($row['description'], 0, 80); ?>....</p>
                                                <p class="card-text"><i class="bi bi-geo-alt-fill text-success"></i> <?= $row['location'] . ', ' . $row['city'] . ',' . $row['state'] . ', ' . $row['country'] . '-' . $row['zip_code'] ?></p>
                                                <p class="card-text"><i class="fa fa-bed text-success"></i> <?= $row['bedrooms']; ?> Bed, <i class="fa fa-bath text-success"></i> <?= $row['bedrooms']; ?> Bath, <i class="fa fa-ruler-combined text-success"></i> <?= $row['area']; ?> Sqft</p>

                                                <p class="card-text text-end disable"><small class="text-body-secondary">
                                                        <?php
                                                        $givenDate = $row['updated_at'];
                                                        $givenDateTime = new DateTime($givenDate);
                                                        $currentDateTime = new DateTime();
                                                        $difference = $currentDateTime->getTimestamp() - $givenDateTime->getTimestamp();
                                                        $minutesDifference = round($difference / 60);
                                                        if ($minutesDifference < 1) {
                                                            $output = 'Just now';
                                                        } elseif ($minutesDifference < 60) {
                                                            $output = $minutesDifference . ' mins ago';
                                                        } elseif ($minutesDifference < 1440) {
                                                            $hoursDifference = round($minutesDifference / 60);
                                                            $output = $hoursDifference . ' hours ago';
                                                        } else {
                                                            $daysDifference = round($minutesDifference / 1440);
                                                            $output = $daysDifference . ' days ago';
                                                        }
                                                        echo $output;
                                                        ?>
                                                    </small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
        <?php require_once('includes/footer.php'); ?>

        <!-- Footer Start -->

    </div>

    <?php require_once('jsLink.php') ?>
</body>

</html>