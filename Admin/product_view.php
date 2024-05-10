<?php
session_start();
require('../database/connection.php');
if (isset($_SESSION['name']) and isset($_SESSION['email'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        require('cssLink.php');
        ?>
    </head>

    <body>
        <?php
        require('includes/header.php');
        ?>
        <main style="margin-top: 90px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3>Properties List</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $sel = "SELECT A.*,B.prop_name 
                                    FROM properties A 
                                    JOIN 
                                        property_types B ON A.prop_id = B.prop_id
                                    where A.id='$id'";
                                    $query = mysqli_query($con, $sel);
                                    if ($query) {
                                        $data = mysqli_fetch_assoc($query);

                                ?>
                                        <div class="card mb-3">
                                            <div class="row g-0">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <?php
                                                        $select = "SELECT * FROM property_images where pr_id='$id'";
                                                        $query2 = mysqli_query($con, $select);
                                                        if (mysqli_num_rows($query2) > 0) {
                                                            while ($row = mysqli_fetch_array($query2)) {
                                                        ?>
                                                                <div class="col-sm-3 mb-4">
                                                                    <img src="Images/propertyImage/<?= $row['image']; ?>" class=" w-100 h-100" alt="...">
                                                                </div>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <div style="display: flex; justify-content:center;" class="mb-2">
                                                                <a href=" add-image?id=<?= $data['id']; ?>" class="btn btn-primary btn-sm">Add Images</a>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="border-top:1px solid black;">
                                                <div class="col-sm-12">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-success"><?= $data['title']; ?> [<?= $data['prop_name']; ?>]</h5>
                                                        <p class="text-success"><i class="bi bi-currency-rupee" style="font-weight:bold;"></i><?= $data['price']; ?></p>
                                                        <p><?= $data['description']; ?></p>
                                                        <p><i class="bi bi-geo-alt-fill text-success"></i> <?= $data['location'] . ', ' . $data['city'] . ',' . $data['state'] . ', ' . $data['country'] . '-' . $data['zip_code'] ?></p>
                                                        <p><i class="fa fa-bed text-success"></i> <?= $data['bedrooms']; ?> Bed, <i class="fa fa-bath text-success"></i> <?= $data['bedrooms']; ?> Bath, <i class="fa fa-ruler-combined text-success"></i> <?= $data['area']; ?> Sqft</p>
                                                        <p>Amenity : <?= $data['amenities']; ?></p>
                                                        <p>Status : <?= $data['availability']; ?></p>
                                                        <p><span class="me-5">Owner Name : <?= $data['owner_name']; ?></span>, <span>Owner Contact: <?= $data['owner_contact'] ?></span></p>
                                                    </div>
                                                    <div class="card-footer" style="display:flex; justify-content:space-between">
                                                        <a href="properties" class="btn btn-success btn-sm"> Back </a>
                                                        <p class="card-text" style="text-align:right;"><small class="text-body-secondary">Last Update
                                                                <?php
                                                                $givenDate = $data['updated_at'];
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
                                                                ?></small>
                                                        </p>
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
                </div>
            </div>
        </main>
        <footer></footer>
        <?php
        require('jsLink.php');
        ?>
    </body>

    </html>
<?php
} else {
    header('Location:index');
}
?>