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
                    <div class="col-md-12">
                        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3>Properties List</h3>
                                    <?php
                                    if (isset($_SESSION['sms'])) {
                                        if ($_SESSION['sms'] === 1) {
                                    ?>
                                            <span class="text-success">Your Property Added Successfully!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 2) {
                                        ?>
                                            <span class="text-success">Images are added successfully!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'deleted') {
                                        ?>
                                            <span class="text-success">Property and Images Deleted successfully!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'not_d') {
                                        ?>
                                            <span class="text-danger">Property and Images are Not Deleted successfully!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'Approve_All') {
                                        ?>
                                            <span class="text-success">All peoperties are Approved successfully!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'Aproved') {
                                        ?>
                                            <span class="text-warning">All Properties are already Approved!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'Approve') {
                                        ?>
                                            <span class="text-success">Property is Approved successfully!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'Aproved_s') {
                                        ?>
                                            <span class="text-warning">This property is already Approved!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'reject') {
                                        ?>
                                            <span class="text-success">This property Rejected Successfully!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'rejected') {
                                        ?>
                                            <span class="text-warning">This property is already rejectedd!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'not_reject') {
                                        ?>
                                            <span class="text-danger">This property is Not rejected!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'Updated') {
                                        ?>
                                            <span class="text-success">This property is Updated!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'n_update') {
                                        ?>
                                            <span class="text-danger">This property is Not updated!!!</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 'img_change') {
                                        ?>
                                            <span class="text-success">Property Image changed successfully!!!</span>
                                    <?php
                                            unset($_SESSION['sms']);
                                        }
                                    }
                                    ?>
                                    <div>
                                        <a href="add-property.php" class="btn btn-success btn-sm mb-2">Add Property</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    $sn = 1;
                                    $productsPerPage = 3;
                                    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $offset = ($currentPage - 1) * $productsPerPage;
                                    $totalProductsQuery = "SELECT COUNT(*) AS total FROM properties";
                                    $totalProductsResult = mysqli_query($con, $totalProductsQuery);
                                    $totalProductsRow = mysqli_fetch_assoc($totalProductsResult);
                                    $totalProducts = $totalProductsRow['total'];
                                    $totalPages = ceil($totalProducts / $productsPerPage);
                                    $sel = "SELECT * FROM properties LIMIT $productsPerPage OFFSET $offset";
                                    $query = mysqli_query($con, $sel);

                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="card" style="box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;">
                                                    <?php
                                                    $id = $row['id'];
                                                    $selImage = "SELECT * FROM property_images where pr_id='$id'";
                                                    $qu = mysqli_query($con, $selImage);
                                                    if (mysqli_num_rows($qu) > 0) {
                                                        $data = mysqli_fetch_assoc($qu);
                                                    ?>
                                                        <img src="Images/propertyImage/<?= $data['image']; ?>" class="card-img-top" alt="Path is missing" style="width: 100%; height: 250px;" />
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="add-image.php?id=<?= $row['id']; ?>" class="btn btn-rounded btn-link">ADD IMAGE</a>
                                                    <?php
                                                    }
                                                    ?>

                                                    <div class="card-body">
                                                        <p style="display:flex; justify-content:space-between;">
                                                            <span class="text-success"><i class="bi bi-currency-rupee" style="font-weight:bold;"></i><?= $row['price']; ?></span>
                                                            <span>
                                                                <?php
                                                                if ($row['status'] == 1) {
                                                                ?>
                                                                    <span class="btn-sm bg-success text-light">Approved</span>
                                                                <?php
                                                                } else if ($row['status'] == 0) {
                                                                ?>
                                                                    <span class="btn-sm bg-warning text-light">Not Approved</span>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <span class="btn-sm bg-danger text-light">Rejected</span>
                                                                <?php
                                                                }
                                                                ?>

                                                            </span>
                                                        </p>
                                                        <h5 class="card-title"><?= $row['title']; ?> [<span style="font-weight:bold;"><?= $row['prop_name']; ?></span>]</h5>
                                                        <p class="card-text"></p>
                                                        <p class="card-text"><?= substr($row['description'], 0, 40); ?>...</p>
                                                    </div>
                                                    <ul class="list-group list-group-light list-group-small">
                                                        <li class="list-group-item px-2"><?= substr($row['location'] . ', ' . $row['city'] . ', ' . $row['state'] . ', ' . $row['country'] . ' - ' . $row['zip_code'], 0, 40) ?>...</li>
                                                        <li class="list-group-item px-2"><?= $row['bedrooms'] . ' Bed, ' . $row['bathrooms'] . ' Bath & ' . $row['area'] . ' Area ' ?></li>
                                                        <li class="list-group-item px-2"><?= $row['amenities']; ?></li>
                                                        <li class="list-group-item px-2"><?= ucfirst($row['availability']); ?></li>
                                                        <li class="list-group-item px-2"><?= $row['owner_name']; ?></li>
                                                        <li class="list-group-item px-2"><?= $row['owner_contact']; ?></li>
                                                    </ul>
                                                    <div class="card-body">
                                                        <a href="code/properties/approve_prop.php?id=<?= $row['id']; ?>" class="btn btn-link text-success">Approve</a>
                                                        <a href="edit_property.php?id=<?= $row['id']; ?>" class="btn btn-link text-success">Edit</a>
                                                        <a href="change_prop_img.php?id=<?= $row['id']; ?>" class="btn btn-link text-success">Change Image</a>
                                                        <a href="product_view.php?id=<?= $row['id']; ?>" class="btn btn-link text-primary">View</a>
                                                        <a href="code/properties/reject_prop.php?id=<?= $row['id']; ?>" class="btn btn-link text-danger">Reject</a>
                                                        <a href="code/properties/delete.php?id=<?= $row['id']; ?>" class="btn btn-link text-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                            $sn++;
                                        }
                                    } else {
                                        ?>
                                        <p class="text-danger text-center">No data Found!!!</p>
                                    <?php
                                    }
                                    if ($totalPages > 1) {
                                    ?>
                                        <ul class='pagination p-2'>
                                            <?php
                                            if ($currentPage > 1) {
                                                echo "<li class='page-item'><a class='page-link' href='?page=" . ($currentPage - 1) . "'>Previous</a></li>";
                                            }
                                            for ($i = 1; $i <= $totalPages; $i++) {
                                                $activeClass = ($currentPage == $i) ? " active" : "";
                                                echo "<li class='page-item$activeClass'><a class='page-link' href='?page=$i'>$i</a></li>";
                                            }
                                            if ($currentPage < $totalPages) {
                                                echo "<li class='page-item'><a class='page-link' href='?page=" . ($currentPage + 1) . "'>Next</a></li>";
                                            }
                                            ?>
                                        </ul>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
        </footer>
        <?php
        require('jsLink.php');
        ?>
    </body>

    </html>
<?php
} else {
    header('Location:index.php');
}
?>