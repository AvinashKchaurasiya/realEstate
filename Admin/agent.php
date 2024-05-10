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
                                    <h3>Agents Profile</h3>
                                </div>
                            </div>
                            <?php
                            $sel = "SELECT * from register_a_u WHERE user_type='agent'";
                            $count = mysqli_num_rows(mysqli_query($con, $sel));
                            $total_records = $count;
                            $per_page = 10;
                            $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                            $num_pages = ceil($total_records / $per_page);
                            if ($current_page < 1 || $current_page > $num_pages) {
                                $current_page = 1;
                            }
                            $start_from = ($current_page - 1) * $per_page;
                            $select = "SELECT * from register_a_u WHERE user_type='agent' LIMIT $start_from, $per_page";
                            $query = mysqli_query($con, $select);

                            ?>

                            <div class="card-body">
                                <div class="table-responsive mb-3">
                                    <table class="table align-middle mb-0 bg-white">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>User type</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Number</th>
                                                <th>isVerified</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_assoc($query)) {
                                            ?>
                                                    <tr>
                                                        <td><?= $row['user_type']; ?></td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <?php
                                                                if ($row['image'] != NULL) {
                                                                ?>
                                                                    <img src="../Agent/Images/profiles/<?= $row['image']; ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="ms-3 ml-3">
                                                                    <p class="fw-bold mb-1"><?= $row['name']; ?></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="fw-normal mb-1"><?= $row['email']; ?></p>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($row['number'] != null) {
                                                                echo $row['number'];
                                                            } else {
                                                            ?>
                                                                ---
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($row['isVerify'] == 1) {
                                                            ?>
                                                                <span class="btn-sm bg-success text-light">Verified</span>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span class="btn-sm bg-danger text-light">Not Verified</span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'> No data found</td></tr>";
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