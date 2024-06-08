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
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header" style="display:flex; justify-content:space-between;">
                            <h3>Feedback Form</h3>
                            <?php
                            if (isset($_SESSION['sms'])) {
                                if ($_SESSION['sms'] == 1) {
                            ?>
                                    <p class="text-success">Feedback Succeessfully Sent.</p>
                                <?php
                                    unset($_SESSION['sms']);
                                } else if ($_SESSION['sms'] == 0) {
                                ?>
                                    <p class="text-danger">Select Image first.</p>
                                <?php
                                    unset($_SESSION['sms']);
                                } else if ($_SESSION['sms'] == 2) {
                                ?>
                                    <p class="text-danger">You already sent.</p>
                            <?php
                                    unset($_SESSION['sms']);
                                }
                            }
                            ?>
                        </div>
                        <div class="card-body">
                            <form id="feedback_From" method="post" action="code/process_feedback.php" enctype="multipart/form-data">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <label class="mb-2">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Your Name" id="name" required />
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="mb-2">Email</label>
                                        <input type="email" name="email" placeholder="Enter Email Address" class="form-control" id="email" required />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <label class="mb-2">Your Feedback</label>
                                        <textarea name="feedback" class="form-control" id="feedback" placeholder="Write your feedback message" name="feedback" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label class="mb-2">Upload Your Image</label>
                                        <input type="file" name="image" id="image" class="form-control" />
                                    </div>
                                </div>
                                <input type="submit" name="feedback_btn" class="btn btn-primary" value="Send Feedback" id="feedback_btn" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <?php require_once('includes/footer.php'); ?>

        <!-- Footer Start -->

    </div>

    <?php require_once('jsLink.php') ?>
</body>

</html>