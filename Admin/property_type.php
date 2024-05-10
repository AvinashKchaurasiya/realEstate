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
                                    <h3>Property Type</h3>
                                    <?php
                                    if (isset($_SESSION['sms'])) {
                                        if ($_SESSION['sms'] === 1) {
                                    ?>
                                            <span class="text-success">Property type successfully Added...</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] === 0) {
                                        ?>
                                            <span class="text-danger">Property type Not Added Added...</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] === 2) {
                                        ?>
                                            <span class="text-danger">Property type already Exist...</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] === 4) {
                                        ?>
                                            <span class="text-success">Property type deleted successfully...</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] === 5) {
                                        ?>
                                            <span class="text-danger">Property type deletion Failed...</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] === 6) {
                                        ?>
                                            <span class="text-success">Property type successfully updated...</span>
                                    <?php
                                            unset($_SESSION['sms']);
                                        }
                                    }
                                    ?>
                                    <form action="code/add_property_type.php" method="post">
                                        <input type="text" class="form-control mb-2" placeholder="Enter property type..." Name="p_name" Id="p_name" />
                                        <input type="submit" name="add_prop" value="Add Property Type" class="btn btn-success btn-sm btn-block" />
                                    </form>
                                </div>
                            </div>
                            <?php
                            $select = "SELECT * from property_types";
                            $count = mysqli_num_rows(mysqli_query($con, $select));
                            $total_records = $count;
                            $per_page = 10;
                            $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                            $num_pages = ceil($total_records / $per_page);
                            if ($current_page < 1 || $current_page > $num_pages) {
                                $current_page = 1;
                            }
                            $start_from = ($current_page - 1) * $per_page;
                            $sel = "SELECT * from property_types LIMIT $start_from, $per_page";
                            $query = mysqli_query($con, $sel);

                            ?>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table ">
                                        <tr>
                                            <th>Property Id</th>
                                            <th>Property Name</th>
                                            <th colspan="3">Action</th>
                                        </tr>

                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($query) > 0) {
                                                $sn = 1;
                                                while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                    <tr>
                                                        <td><?= $sn; ?></td>
                                                        <td><?= $row['prop_name']; ?></td>
                                                        <td><a href="edit_prop_type?id=<?= $row['prop_id']; ?>" class="btn btn-sm btn-success "><i class="bi bi-pencil-square"></i></a></td>
                                                        <td><a href="code/delete_prop_type?id=<?= $row['prop_id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a></td>
                                                    </tr>
                                            <?php
                                                    $sn++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='5' class='text-danger'>Table is Empty...</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <?php
                                        if ($current_page > 1) {
                                            echo "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=" . ($current_page - 1) . "'>Previous</a></li>";
                                        }
                                        for ($i = 1; $i <= $num_pages; $i++) {
                                            $active_class = ($current_page == $i) ? "active" : "";
                                            echo "<li class='page-item $active_class'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=$i'>$i</a></li>";
                                        }
                                        if ($current_page < $num_pages) {
                                            echo "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=" . ($current_page + 1) . "'>Next</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </nav>
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