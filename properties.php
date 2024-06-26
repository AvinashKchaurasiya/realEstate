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

        #form_filter>#category:hover,
        #form_filter>input:hover,
        #form_filter>#price:hover,
        label:hover {
            cursor: pointer;
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
            <div class="row g-0 gx-5">
                <div class="col-sm-3 nb-3" style="border-right: 1px solid;">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="">Filter Property</h5>
                        </div>
                        <div class="card-body">
                            <form id="form_filter" action="" method="post">
                                <label class="mb-2">Category</label>
                                <select id="category" name="category[]" class="multiple-select mb-2" multiple>
                                    <option value="">Choose Category</option>
                                    <?php
                                    $selCat = "SELECT * FROM property_types";
                                    $query = mysqli_query($con, $selCat);
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                            <option value="<?= $row['prop_name'] ?>"><?= $row['prop_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <label class="mb-2">Bedrooms</label><br />
                                <select id="bedrooms" name="bedrooms[]" class="multiple-select mb-2" multiple>
                                    <option value="">Bedrooms</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                                <label class="mb-2">Bathrooms</label><br />
                                <select class="multiple-select mb-2" name="bathrooms[]" id="bathrooms" multiple>
                                    <option value="">Bathrooms</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                                <label class="mb-2">Amenities</label>
                                <select class="multiple-select mb-2" name="amenities[]" id="amenities" multiple>
                                    <option value="">Amenities</option>
                                    <?php
                                    $selAmenities = "SELECT * FROM amenities";
                                    $query = mysqli_query($con, $selAmenities);
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                            <option value="<?= $row['amenity'] ?>"><?= $row['amenity'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="radio" name="price" id="price" value="0" class="mt-2"> <label for="price">Price : Low to High</label><br />
                                <input type="radio" name="price" id="price1" value="1" class="mt-2"> <label for="price1">Price : High to Low</label><br /><br />
                                <label class="mb-2">Price</label>
                                <input type="price" name="price1" id="price2" value="" class="mb-2 form-control" />
                                <input type="submit" id="filter_button" name="filter_btn" class="w-100 btn btn-sm btn-success" value="Apply Filters">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9" id="">
                    <?php
                    if (isset($_POST['filter_btn'])) {
                        $conditions = array();

                        // Check if category is selected
                        if (!empty($_POST['category'])) {
                            $categories = implode("','", $_POST['category']);
                            $conditions[] = "prop_name IN ('$categories')";
                        }

                        // Check if bedrooms are selected
                        if (!empty($_POST['bedrooms'])) {
                            $bedrooms = implode(",", $_POST['bedrooms']);
                            $conditions[] = "bedrooms IN ($bedrooms)";
                        }

                        // Check if bathrooms are selected
                        if (!empty($_POST['bathrooms'])) {
                            $bathrooms = implode(",", $_POST['bathrooms']);
                            $conditions[] = "bathrooms IN ($bathrooms)";
                        }

                        // Check if amenities are selected
                        if (!empty($_POST['amenities'])) {
                            $amenities = implode("','", $_POST['amenities']);
                            $conditions[] = "amenities IN ('$amenities')";
                        }

                        // Check if a specific price range is provided
                        if (!empty($_POST['price1'])) {
                            $price = $_POST['price1'];
                            $conditions[] = "price <= $price";
                        }

                        // Check if price sorting option is selected
                        $orderBy = "";
                        if (!empty($_POST['price'])) {
                            $orderBy = ($_POST['price'] == 1) ? "ORDER BY price DESC" : "ORDER BY price ASC";
                        }

                        // Construct the SQL query
                        $sql = "SELECT * FROM properties";
                        if (!empty($conditions)) {
                            $sql .= " WHERE " . implode(" AND ", $conditions);
                        }
                        $sql .= " $orderBy";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
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
                                                            <a href="property-desc.php?id=<?= $id; ?>"><img src="Admin/Images/propertyImage/<?= $data['image'] ?>" class="d-block w-100" alt="..."></a>
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
                                                    $Rattingquery = mysqli_query($con, $sel);
                                                    if (mysqli_num_rows($Rattingquery) > 0) {
                                                        $count_5 = 0;
                                                        $count_4 = 0;
                                                        $count_3 = 0;
                                                        $count_2 = 0;
                                                        $count_1 = 0;
                                                        $total_rating_sum = 0;
                                                        $total_ratings = 0;
                                                        while ($row1 = mysqli_fetch_assoc($Rattingquery)) {
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
                                                    <a href="property-desc.php?id=<?= $id; ?>">
                                                        <p class="text-success"><?= $row['title']; ?> [<?= $row['prop_name'] ?>]</p>
                                                    </a>
                                                </h5>
                                                <p class="card-text"><?= substr($row['description'], 0, 80); ?>....</p>
                                                <p class="card-text"><i class="bi bi-geo-alt-fill text-success"></i> <?= $row['location'] . ', ' . $row['city'] . ',' . $row['state'] . ', ' . $row['country'] . '-' . $row['zip_code'] ?></p>
                                                <p class="card-text"><i class="fa fa-bed text-success"></i> <?= $row['bedrooms']; ?> Bed, <i class="fa fa-bath text-success"></i> <?= $row['bedrooms']; ?> Bath, <i class="fa fa-ruler-combined text-success"></i> <?= $row['area']; ?> Sqft</p>

                                                <div class="card-text disable" style="display:flex; justify-content:space-between;">
                                                    <?php
                                                    if (isset($_SESSION['email'])) {
                                                    ?>
                                                        <span class="btn btn-outline-success btn-sm" onclick="addWishList(<?= $id; ?>, '<?= $_SESSION['email']; ?>')">
                                                            <i class="bi bi-bag-heart-fill" style="font-size:1rem;"></i> Add To Wishlist
                                                        </span>

                                                    <?php
                                                    }
                                                    ?>
                                                    <small class="text-body-secondary">
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
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <h3 class="text-danger text-center">No properties matched found.</h3>
                            <?php
                        }
                    } else if (isset($_GET['location'])) {
                        $location = $_GET['location'];
                        $sel = "SELECT *
                        FROM properties
                        WHERE status = 1 
                            AND (location LIKE '%$location%' 
                                 OR city LIKE '%$location%' 
                                 OR state LIKE '%$location%' 
                                 OR country LIKE '%$location%' 
                                 OR zip_code LIKE '%$location%')
                        GROUP BY id";
                        $query = mysqli_query($con, $sel);
                        if (mysqli_num_rows($query) > 0) {
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
                                                            <a href="property-desc.php?id=<?= $id; ?>"><img src="Admin/Images/propertyImage/<?= $data['image'] ?>" class="d-block w-100" alt="..."></a>
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
                                                    $Rattingquery = mysqli_query($con, $sel);
                                                    if (mysqli_num_rows($Rattingquery) > 0) {
                                                        $count_5 = 0;
                                                        $count_4 = 0;
                                                        $count_3 = 0;
                                                        $count_2 = 0;
                                                        $count_1 = 0;
                                                        $total_rating_sum = 0;
                                                        $total_ratings = 0;
                                                        while ($row1 = mysqli_fetch_assoc($Rattingquery)) {
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
                                                    <a href="property-desc.php?id=<?= $id; ?>">
                                                        <p class="text-success"><?= $row['title']; ?> [<?= $row['prop_name'] ?>]</p>
                                                    </a>
                                                </h5>
                                                <p class="card-text"><?= substr($row['description'], 0, 80); ?>....</p>
                                                <p class="card-text"><i class="bi bi-geo-alt-fill text-success"></i> <?= $row['location'] . ', ' . $row['city'] . ',' . $row['state'] . ', ' . $row['country'] . '-' . $row['zip_code'] ?></p>
                                                <p class="card-text"><i class="fa fa-bed text-success"></i> <?= $row['bedrooms']; ?> Bed, <i class="fa fa-bath text-success"></i> <?= $row['bedrooms']; ?> Bath, <i class="fa fa-ruler-combined text-success"></i> <?= $row['area']; ?> Sqft</p>

                                                <div class="card-text disable" style="display:flex; justify-content:space-between;">
                                                    <?php
                                                    if (isset($_SESSION['email'])) {
                                                    ?>
                                                        <span class="btn btn-outline-success btn-sm" onclick="addWishList(<?= $id; ?>, '<?= $_SESSION['email']; ?>')">
                                                            <i class="bi bi-bag-heart-fill" style="font-size:1rem;"></i> Add To Wishlist
                                                        </span>

                                                    <?php
                                                    }
                                                    ?>
                                                    <small class="text-body-secondary">
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
                                                    </small>
                                                </div>
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
                                                            <a href="property-desc.php?id=<?= $id; ?>"><img src="Admin/Images/propertyImage/<?= $data['image'] ?>" class="d-block w-100" alt="..." style="height:100%;"></a>
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
                                                    $Ratingquery = mysqli_query($con, $sel);
                                                    if (mysqli_num_rows($Ratingquery) > 0) {
                                                        $count_5 = 0;
                                                        $count_4 = 0;
                                                        $count_3 = 0;
                                                        $count_2 = 0;
                                                        $count_1 = 0;
                                                        $total_rating_sum = 0;
                                                        $total_ratings = 0;
                                                        while ($row1 = mysqli_fetch_assoc($Ratingquery)) {
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
                                                    <a href="property-desc.php?id=<?= $id; ?>">
                                                        <p class="text-success"><?= $row['title']; ?> [<?= $row['prop_name'] ?>]</p>
                                                    </a>
                                                </h5>
                                                <p class="card-text"><?= substr($row['description'], 0, 80); ?>....</p>
                                                <p class="card-text"><i class="bi bi-geo-alt-fill text-success"></i> <?= $row['location'] . ', ' . $row['city'] . ',' . $row['state'] . ', ' . $row['country'] . '-' . $row['zip_code'] ?></p>
                                                <p class="card-text"><i class="fa fa-bed text-success"></i> <?= $row['bedrooms']; ?> Bed, <i class="fa fa-bath text-success"></i> <?= $row['bedrooms']; ?> Bath, <i class="fa fa-ruler-combined text-success"></i> <?= $row['area']; ?> Sqft</p>

                                                <div class="card-text disable" style="display:flex; justify-content:space-between;">
                                                    <?php
                                                    if (isset($_SESSION['email'])) {
                                                    ?>
                                                        <span class="btn btn-outline-success btn-sm" onclick="addWishList(<?= $id; ?>, '<?= $_SESSION['email']; ?>')">
                                                            <i class="bi bi-bag-heart-fill" style="font-size:1rem;"></i> Add To Wishlist
                                                        </span>

                                                    <?php
                                                    }
                                                    ?>
                                                    <small class="text-body-secondary">
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
                                                    </small>
                                                </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#amenities').selectize({
                plugins: ['remove_button'],
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    };
                }
            });
            $('#bathrooms').selectize({
                plugins: ['remove_button'],
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    };
                }
            });
            $('#bedrooms').selectize({
                plugins: ['remove_button'],
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    };
                }
            });
            $('#category').selectize({
                plugins: ['remove_button'],
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    };
                }
            });
        });
        const addWishList = (id, email) => {
            $.ajax({
                url: 'code/add_to_wishlist.php',
                type: 'POST',
                data: {
                    id: id,
                    email: email
                },
                success: function(response) {
                    alert(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    </script>
</body>

</html>