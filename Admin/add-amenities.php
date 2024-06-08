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
                                    <p id="sms"></p>
                                    <?php

                                    ?>
                                    <form id="add_amenities" method="post">
                                        <input type="text" class="form-control mb-2" placeholder="Enter Aminities..." Name="amenities" Id="amenities_input" />
                                        <input type="submit" id="amenities_btn" name="add_ame" value="Add Amenities" class="btn btn-success btn-sm btn-block" />
                                    </form>
                                </div>
                            </div>
                            <?php
                            $select = "SELECT * from amenities";
                            $count = mysqli_num_rows(mysqli_query($con, $select));
                            $total_records = $count;
                            $per_page = 10;
                            $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                            $num_pages = ceil($total_records / $per_page);
                            if ($current_page < 1 || $current_page > $num_pages) {
                                $current_page = 1;
                            }
                            $start_from = ($current_page - 1) * $per_page;
                            $sel = "SELECT * from amenities LIMIT $start_from, $per_page";
                            $query = mysqli_query($con, $sel);

                            ?>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>#Sn</th>
                                            <th>Amenities</th>
                                            <th colspan="2">Action</th>
                                        </tr>

                                        <tbody id="amenities_list">
                                            <?php
                                            if (mysqli_num_rows($query) > 0) {
                                                $sn = 1;
                                                while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                    <tr>
                                                        <td><?= $sn; ?></td>
                                                        <td><?= $row['amenity']; ?></td>
                                                        <td><a href="edit_prop_type.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-success "><i class="bi bi-pencil-square"></i></a></td>
                                                        <td><a href="code/delete_prop_type.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a></td>
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
    <script>
        function fetchAmenities() {
            $.ajax({
                type: 'GET',
                url: 'code/fetch_amenities.php',
                success: function(response) {
                    $('#amenities_list').html(response);
                }
            });
        }
        fetchAmenities();
        $(document).ready(function() {
            $('#amenities_btn').click(function() {
                var amenities = $('#amenities_input').val();
                $.ajax({
                    type: 'POST',
                    url: 'code/add_amenities.php',
                    data: {
                        amenities: amenities
                    },
                    success: function(response) {
                        document.getElementById('sms').innerHTML = "Successfully added";
                        document.getElementById('sms').style.color = "green";
                        $('#amenities_input').val('');
                        fetchAmenities();
                    }
                });
            });

            // Function to fetch and display amenities

        });

        function deleteAmenities(id) {
            let ame_id = id;
            $.ajax({
                type: 'POST',
                url: 'code/deleteAmenities.php',
                data: {
                    id: ame_id
                },
                success: function(response) {
                    document.getElementById('sms').innerHTML = "Successfully Deleted";
                    document.getElementById('sms').style.color = "green";
                    fetchAmenities();
                }
            })
        }
    </script>

    </html>
<?php
} else {
    header('Location:index.php');
}
?>