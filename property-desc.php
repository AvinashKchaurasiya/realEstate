<?php
session_start();
require('database/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('cssLink.php'); ?>
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .carousel-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        div.stars {
            width: 270px;
            display: inline-block;
        }

        input.star {
            display: none;
        }

        label.star {
            float: right;
            padding: 10px;
            font-size: 1.5rem;
            color: #444;
            transition: all .2s;
            cursor: pointer;
        }

        input.star:checked~label.star:before {
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked~label.star:before {
            color: #FE7;

        }

        input.star-1:checked~label.star:before {
            color: #F62;
        }

        .pagination {
            list-style-type: none;
            display: flex;
            justify-content: start;
            margin-top: 20px;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a {
            display: block;
            padding: 10px 15px;
            background-color: #f2f2f2;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination li a:hover {
            background-color: #ddd;
        }

        .pagination .active a {
            background-color: #00b98e;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <!-- Spinner Start -->
        <?php
        require_once('includes/header3.php');
        ?>
        <div class="container py-5">
            <div class="row g-0 gx-5 wow slideInLeft">
                <div class="col-sm-12">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sel = "SELECT * FROM properties WHERE id='$id'";
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
                                                            <img src="Admin/Images/propertyImage/<?= $data['image'] ?>" class="d-block w-100" alt="...">
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
                                                    $sel = "SELECT rating FROM ratings WHERE property_id='$id'";
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
                                                        <p class="btn btn-success btn-sm"><?= round($total_average_rating, 1) ?> <i class="bi bi-star-fill text-light"></i></p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p class="btn btn-success btn-sm">0 <i class="bi bi-star-fill text-light"></i></p>
                                                    <?php
                                                    }
                                                    ?>

                                                </h6>
                                                <h5 class="card-title">
                                                    <p class="text-success"><?= $row['title']; ?> [<?= $row['prop_name'] ?>]</p>
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
            <?php
            if (isset($_SESSION['email'])) {
            ?>
                <div class="row g-0 gx-5 wow slideInLeft">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header" style="display:flex; justify-content:space-between;">
                                <h6>Leave ratting and your comment on proporty</h6>
                                <?php
                                if (isset($_SESSION['sms'])) {
                                    if ($_SESSION['sms'] === 1) {
                                ?>
                                        <span class="text-success">Your review submitted for this property.</span>
                                    <?php
                                        unset($_SESSION['sms']);
                                    } else if ($_SESSION['sms'] === 0) {
                                    ?>
                                        <span class="text-danger">Your review not submitted for this property.</span>
                                    <?php
                                        unset($_SESSION['sms']);
                                    } else if ($_SESSION['sms'] === 'failed') {
                                    ?>
                                        <span class="text-danger">You already give your review to this property.</span>
                                <?php
                                        unset($_SESSION['sms']);
                                    }
                                }
                                ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Add Review
                                </button>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Review</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="" action="Code/rating.php" method="post">
                                                    <?php
                                                    if (isset($id)) {
                                                    ?>
                                                        <input type="hidden" class="mb-2" name="id" value="<?= $id; ?>" id="id" />
                                                    <?php
                                                    } else if (isset($_GET['id'])) {
                                                        $prop_id = urldecode($_GET['id']);
                                                    ?>
                                                        <input type="hidden" class="mb-2" name="id" value="<?= $prop_id; ?>" id="id" />
                                                    <?php
                                                    }
                                                    ?>

                                                    <div class="form-group row mb-2">
                                                        <div class="stars">
                                                            <input class="star star-5" id="star-5" type="radio" value="5" name="star" />
                                                            <label class="star star-5 bi bi-star-fill text-dark " for="star-5"></label>
                                                            <input class="star star-4" id="star-4" type="radio" value="4" name="star" />
                                                            <label class="star star-4 bi bi-star-fill text-dark" for="star-4"></label>
                                                            <input class="star star-3" id="star-3" type="radio" value="3" name="star" />
                                                            <label class="star star-3 bi bi-star-fill text-dark" for="star-3"></label>
                                                            <input class="star star-2" id="star-2" type="radio" value="2" name="star" />
                                                            <label class="star star-2 bi bi-star-fill text-dark" for="star-2"></label>
                                                            <input class="star star-1" id="star-1" type="radio" value="1" name="star" />
                                                            <label class="star star-1 bi bi-star-fill text-dark" for="star-1"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <div class="col-sm-6">
                                                            <label class="mb-2">Name : <span id="nsms"></span></label>
                                                            <input type="text" name="name" class="form-control mb-2" id="name" onkeyup="return validateName()" placeholder="Enter Your Name" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="mb-2">Email : <span id="esms"></span></label>
                                                            <input type="email" name="email" class="form-control" id="email" onkeyup="return validateEmail()" placeholder="Enter Your Email" />
                                                        </div>
                                                    </div>
                                                    <label class="mb-2">Comment</label>
                                                    <textarea name="comment" rows="5" class="form-control mb-3"></textarea>
                                                    <input type="submit" class="btn btn-success" id="submit" name="rating" value="Submit" />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <?php
                                        $limit = 7;
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $id = isset($_GET['id']) ? $_GET['id'] : '';
                                        $offset = ($page - 1) * $limit;
                                        $sel1 = "SELECT * FROM ratings WHERE property_id='$id' LIMIT $limit OFFSET $offset";
                                        $query1 = mysqli_query($con, $sel1);
                                        if (mysqli_num_rows($query1) > 0) {
                                            while ($row1 = mysqli_fetch_assoc($query1)) {
                                        ?>
                                                <div class="card mb-3 border-bottom" style="border:0px;">
                                                    <div class="card-title" style="display:flex; justify-content:space-between; padding-left:1.5rem;">
                                                        <div class="font-weight:bold;">

                                                            <p class="mb-0"><?= $row1['name']; ?></p>
                                                            <div class="stars rate" data-percent="<?php echo $row1['rating'] ?>">
                                                                <?php if ($row1['rating'] == 1) { ?>
                                                                    <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>
                                                                <?php } elseif ($row1['rating'] == 2) { ?>
                                                                    <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>
                                                                <?php } elseif ($row1['rating'] == 3) { ?>
                                                                    <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>
                                                                <?php } elseif ($row1['rating'] == 4) { ?>
                                                                    <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star"></i>
                                                                <?php } elseif ($row1['rating'] == 5) { ?>
                                                                    <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i>
                                                                <?php } elseif ($row1['rating'] == 0 || $row1['rating'] == null) { ?>
                                                                    <i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <p><?php
                                                            $givenDate = $row1['updated_at'];
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
                                                        </p>
                                                    </div>
                                                    <div class="card-body" style=" padding-left:3rem;">
                                                        <p class="card-text"><?= $row1['comment']; ?></p>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                            $total_records = mysqli_num_rows(mysqli_query($con, "SELECT * FROM ratings WHERE property_id='$id'"));
                                            $total_pages = ceil($total_records / $limit);
                                            echo "<ul class='pagination'>";
                                            if ($page > 1) {
                                                echo "<li><a href='?id=$id&page=" . ($page - 1) . "'>Prev</a></li>";
                                            }
                                            for ($i = 1; $i <= $total_pages; $i++) {
                                                $active_class = ($page == $i) ? "active" : "";
                                                echo "<li class='$active_class'><a href='?id=$id&page=" . $i . "'>" . $i . "</a></li>";
                                            }
                                            if ($page < $total_pages) {
                                                echo "<li><a href='?id=$id&page=" . ($page + 1) . "'>Next</a></li>";
                                            }

                                            echo "</ul>";
                                        }
                                        ?>

                                    </div>
                                    <div class="col-sm-2 border-right">

                                    </div>
                                    <div class="col-sm-3">
                                        <?php
                                        $sel = "SELECT rating FROM ratings WHERE property_id='$id'";
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
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="progress-wrapper" style="display: flex; align-items: center;">
                                                        <label class="me-2">5 </label>
                                                        <div class="progress me-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $count_5; ?>" aria-valuemin="0" aria-valuemax="<?= $count_1 + $count_2 + $count_3 + $count_4 + $count_5 ?>" style="flex: 1;">
                                                            <div class="progress-bar bg-warning" style="width: <?= $count_5; ?>%"></div>
                                                        </div>
                                                        <label> (<?= $count_5; ?>)</label>
                                                    </div>
                                                    <div class="progress-wrapper" style="display: flex; align-items: center;">
                                                        <label class="me-2">4 </label>
                                                        <div class="progress me-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $count_4; ?>" aria-valuemin="0" aria-valuemax="<?= $count_1 + $count_2 + $count_3 + $count_4 + $count_5 ?>" style="flex: 1;">
                                                            <div class="progress-bar bg-warning" style="width: <?= $count_4; ?>%"></div>
                                                        </div>
                                                        <label> (<?= $count_4; ?>)</label>
                                                    </div>

                                                    <div class="progress-wrapper" style="display: flex; align-items: center;">
                                                        <label class="me-2">3 </label>
                                                        <div class="progress me-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $count_3; ?>" aria-valuemin="0" aria-valuemax="<?= $count_1 + $count_2 + $count_3 + $count_4 + $count_5 ?>" style="flex: 1;">
                                                            <div class="progress-bar bg-warning" style="width: <?= $count_3; ?>%"></div>
                                                        </div>
                                                        <label> (<?= $count_3; ?>)</label>
                                                    </div>
                                                    <div class="progress-wrapper" style="display: flex; align-items: center;">
                                                        <label class="me-2">2 </label>
                                                        <div class="progress me-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $count_2; ?>" aria-valuemin="0" aria-valuemax="<?= $count_1 + $count_2 + $count_3 + $count_4 + $count_5 ?>" style="flex: 1;">
                                                            <div class="progress-bar bg-warning" style="width: <?= $count_2; ?>%"></div>
                                                        </div>
                                                        <label> (<?= $count_2; ?>)</label>
                                                    </div>
                                                    <div class="progress-wrapper" style="display: flex; align-items: center;">
                                                        <label class="me-2">1 </label>
                                                        <div class="progress me-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $count_1; ?>" aria-valuemin="0" aria-valuemax="<?= $count_1 + $count_2 + $count_3 + $count_4 + $count_5 ?>" style="flex: 1;">
                                                            <div class="progress-bar bg-warning" style="width: <?= $count_1; ?>%"></div>
                                                        </div>
                                                        <label> (<?= $count_1; ?>)</label>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row g-0 gx-5 wow slideInLeft">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header" style="display:flex; justify-content:space-between;">
                                <h6>Review and ratting</h6>
                            </div>
                            <div class="card-body p-5">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <?php
                                        $limit = 7;
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $id = isset($_GET['id']) ? $_GET['id'] : '';
                                        $offset = ($page - 1) * $limit;
                                        $sel1 = "SELECT * FROM ratings WHERE property_id='$id' LIMIT $limit OFFSET $offset";
                                        $query1 = mysqli_query($con, $sel1);
                                        if (mysqli_num_rows($query1) > 0) {
                                            while ($row1 = mysqli_fetch_assoc($query1)) {
                                        ?>
                                                <div class="card mb-3 border-bottom" style="border:0px;">
                                                    <div class="card-title" style="display:flex; justify-content:space-between; padding-left:1.5rem;">
                                                        <div class="font-weight:bold;">

                                                            <p class="mb-0"><?= $row1['name']; ?></p>
                                                            <div class="stars rate" data-percent="<?php echo $row1['rating'] ?>">
                                                                <?php if ($row1['rating'] == 1) { ?>
                                                                    <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>
                                                                <?php } elseif ($row1['rating'] == 2) { ?>
                                                                    <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>
                                                                <?php } elseif ($row1['rating'] == 3) { ?>
                                                                    <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>
                                                                <?php } elseif ($row1['rating'] == 4) { ?>
                                                                    <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star"></i>
                                                                <?php } elseif ($row1['rating'] == 5) { ?>
                                                                    <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i>
                                                                <?php } elseif ($row1['rating'] == 0 || $row1['rating'] == null) { ?>
                                                                    <i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <p><?php
                                                            $givenDate = $row1['updated_at'];
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
                                                        </p>
                                                    </div>
                                                    <div class="card-body" style=" padding-left:3rem;">
                                                        <p class="card-text"><?= $row1['comment']; ?></p>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                            $total_records = mysqli_num_rows(mysqli_query($con, "SELECT * FROM ratings WHERE property_id='$id'"));
                                            $total_pages = ceil($total_records / $limit);
                                            echo "<ul class='pagination'>";
                                            if ($page > 1) {
                                                echo "<li><a href='?id=$id&page=" . ($page - 1) . "'>Prev</a></li>";
                                            }
                                            for ($i = 1; $i <= $total_pages; $i++) {
                                                $active_class = ($page == $i) ? "active" : "";
                                                echo "<li class='$active_class'><a href='?id=$id&page=" . $i . "'>" . $i . "</a></li>";
                                            }
                                            if ($page < $total_pages) {
                                                echo "<li><a href='?id=$id&page=" . ($page + 1) . "'>Next</a></li>";
                                            }

                                            echo "</ul>";
                                        }
                                        ?>

                                    </div>
                                    <div class="col-sm-2 border-right">

                                    </div>
                                    <div class="col-sm-3">
                                        <?php
                                        $sel = "SELECT rating FROM ratings WHERE property_id='$id'";
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
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="progress-wrapper" style="display: flex; align-items: center;">
                                                        <label class="me-2">5 </label>
                                                        <div class="progress me-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $count_5; ?>" aria-valuemin="0" aria-valuemax="<?= $count_1 + $count_2 + $count_3 + $count_4 + $count_5 ?>" style="flex: 1;">
                                                            <div class="progress-bar bg-warning" style="width: <?= $count_5; ?>%"></div>
                                                        </div>
                                                        <label> (<?= $count_5; ?>)</label>
                                                    </div>
                                                    <div class="progress-wrapper" style="display: flex; align-items: center;">
                                                        <label class="me-2">4 </label>
                                                        <div class="progress me-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $count_4; ?>" aria-valuemin="0" aria-valuemax="<?= $count_1 + $count_2 + $count_3 + $count_4 + $count_5 ?>" style="flex: 1;">
                                                            <div class="progress-bar bg-warning" style="width: <?= $count_4; ?>%"></div>
                                                        </div>
                                                        <label> (<?= $count_4; ?>)</label>
                                                    </div>

                                                    <div class="progress-wrapper" style="display: flex; align-items: center;">
                                                        <label class="me-2">3 </label>
                                                        <div class="progress me-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $count_3; ?>" aria-valuemin="0" aria-valuemax="<?= $count_1 + $count_2 + $count_3 + $count_4 + $count_5 ?>" style="flex: 1;">
                                                            <div class="progress-bar bg-warning" style="width: <?= $count_3; ?>%"></div>
                                                        </div>
                                                        <label> (<?= $count_3; ?>)</label>
                                                    </div>
                                                    <div class="progress-wrapper" style="display: flex; align-items: center;">
                                                        <label class="me-2">2 </label>
                                                        <div class="progress me-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $count_2; ?>" aria-valuemin="0" aria-valuemax="<?= $count_1 + $count_2 + $count_3 + $count_4 + $count_5 ?>" style="flex: 1;">
                                                            <div class="progress-bar bg-warning" style="width: <?= $count_2; ?>%"></div>
                                                        </div>
                                                        <label> (<?= $count_2; ?>)</label>
                                                    </div>
                                                    <div class="progress-wrapper" style="display: flex; align-items: center;">
                                                        <label class="me-2">1 </label>
                                                        <div class="progress me-2" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $count_1; ?>" aria-valuemin="0" aria-valuemax="<?= $count_1 + $count_2 + $count_3 + $count_4 + $count_5 ?>" style="flex: 1;">
                                                            <div class="progress-bar bg-warning" style="width: <?= $count_1; ?>%"></div>
                                                        </div>
                                                        <label> (<?= $count_1; ?>)</label>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <?php require_once('includes/footer.php'); ?>

        <!-- Footer Start -->

    </div>

    <?php require_once('jsLink.php') ?>
    <script>
        const validateName = () => {
            const name = document.getElementById('name').value;
            const sms = document.getElementById('nsms');
            const nameRex = /^[a-zA-Z '-]{2,}$/;
            if (name == '') {
                sms.textContent = 'Please enter your name...';
                sms.style.color = 'red';
                return false;
            } else if (nameRex.test(name)) {
                sms.textContent = '';
                return true;
            } else {
                sms.textContent = 'Please enter a valid name...';
                sms.style.color = 'red';
                return false;
            }
        }

        const validateEmail = () => {
            const email = document.getElementById('email').value;
            const sms = document.getElementById('esms');
            const emailRegex = /^[a-zA-Z]+[\w.-]*[a-zA-Z0-9]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (email == '') {
                sms.textContent = 'Please enter your email...';
                sms.style.color = 'red';
                return false;
            } else if (emailRegex.test(email)) {
                sms.textContent = '';
                return true;
            } else {
                sms.textContent = 'Please enter a valid email...';
                sms.style.color = 'red';
                return false;
            }
        }
    </script>
</body>

</html>