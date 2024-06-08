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
            <div class="row g-0 gx-5">
                <?php
                $selectCategory = "SELECT * FROM property_types";
                $query = mysqli_query($con, $selectCategory);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                ?>
                        <div class="col-sm-3">
                            <div class="card mb-5" style="box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;">
                                <h4 class="text-center p-5"><?= $row['prop_name'] ?></h4>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php require_once('includes/footer.php'); ?>

        <!-- Footer Start -->

    </div>

    <?php require_once('jsLink.php') ?>
</body>

</html>