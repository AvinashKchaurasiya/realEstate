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
                                            <span class="text-success">Your Property Added Successfully Please wait approval from admin!!!</span>
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
                                        } else if ($_SESSION['sms'] == 'Updated') {
                                        ?>
                                            <span class="text-success">This property is Updated wait to approved from admin!!!</span>
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
                                        <a href="add-property" class="btn btn-success btn-sm mb-2">Add Property</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    $sn = 1;
                                    $email = $_SESSION["email"];
                                    $productsPerPage = 3;
                                    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $offset = ($currentPage - 1) * $productsPerPage;
                                    $totalProductsQuery = "SELECT COUNT(*) AS total FROM properties";
                                    $totalProductsResult = mysqli_query($con, $totalProductsQuery);
                                    $totalProductsRow = mysqli_fetch_assoc($totalProductsResult);
                                    $totalProducts = $totalProductsRow['total'];
                                    $totalPages = ceil($totalProducts / $productsPerPage);

                                    $sel = "SELECT * FROM properties WHERE add_by='$email' LIMIT $productsPerPage OFFSET $offset";
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
                                                        <img src="../Admin/Images/propertyImage/<?= $data['image']; ?>" class="card-img-top" alt="Path is missing" />
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="add-image?id=<?= $row['id']; ?>" class="btn btn-rounded btn-link">ADD IMAGE</a>
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
                                                        <?php
                                                        $selectratting = "SELECT * FROM ratings where property_id='$id'";
                                                        $rattingQuery = mysqli_query($con, $selectratting);
                                                        if (mysqli_num_rows($rattingQuery) > 0) {
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
                                                            <li class="list-group-item px-2">
                                                                <span class="bg-success p-1" style="border-radius: 10px;"><?= round($total_average_rating, 1) ?> <i class="bi bi-star-fill text-light"></i></span>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li class="list-group-item px-2">
                                                                <span class="bg-success p-1" style="border-radius: 10px;">0 <i class="bi bi-star-fill text-light"></i></span>
                                                            </li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <div class="card-body">
                                                        <a href="edit_property?id=<?= $row['id']; ?>" class="btn btn-link text-success">Edit</a>
                                                        <a href="change_prop_img?id=<?= $row['id']; ?>" class="btn btn-link text-success">Change Image</a>
                                                        <a href="product_view?id=<?= $row['id']; ?>" class="btn btn-link text-primary">View</a>
                                                        <a href="code/properties/delete?id=<?= $row['id']; ?>" class="btn btn-link text-danger">Delete</a>
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
    header('Location:index');
}
?>