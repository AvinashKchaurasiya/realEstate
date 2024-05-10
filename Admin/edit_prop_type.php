<?php
session_start();
require('../database/connection.php');
if (isset($_SESSION['name']) and isset($_SESSION['email'])) {
    if (isset($_GET['id'])) {
        $prop_id = $_GET['id'];
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
                                        <h3>Edit Property Type</h3>
                                        <?php
                                        if (isset($_SESSION['sms'])) {
                                            if ($_SESSION['sms'] === 1) {
                                        ?>
                                                <span class="text-danger">Property type already Exist...</span>
                                        <?php
                                                unset($_SESSION['sms']);
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row m-3 mb-5">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-4">
                                            <form action="code/update_property_type.php" method="post">
                                                <?php
                                                $sel = "SELECT * FROM property_types WHERE prop_id = '$prop_id'";
                                                $query = mysqli_query($con, $sel);
                                                if ($query) {
                                                    $data = mysqli_fetch_assoc($query);
                                                ?>
                                                    <input type="hidden" name="prop_id" value="<?= $prop_id; ?>" />
                                                    <label class="mb-2">Property Type</label>
                                                    <input type="text" class="form-control mb-2" value="<?= $data['prop_name']; ?>" placeholder="Enter property type..." Name="prop_name" Id="p_name" />
                                                    <input type="submit" name="update_prop" value="Update Property Type" class="btn btn-success" />
                                                <?php
                                                }
                                                ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="property_type" class="btn btn-success btn-sm">
                                        << Back</a>
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
    }
} else {
    header('Location:index');
}
?>