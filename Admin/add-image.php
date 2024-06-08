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
                                    <h3>Add Property</h3>
                                    <?php
                                    if (isset($_SESSION['sms'])) {
                                        if ($_SESSION['sms'] == 0) {
                                    ?>
                                            <span class="text-danger">Image Not inserted in the table</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 1) {
                                        ?>
                                            <span class="text-danger">Sorry, there was an error uploading your file</span>
                                        <?php
                                            unset($_SESSION['sms']);
                                        } else if ($_SESSION['sms'] == 3) {
                                        ?>
                                            <span class="text-danger">Sorry, only JPG, JPEG, PNG, GIF files are allowed</span>
                                    <?php
                                            unset($_SESSION['sms']);
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                ?>
                                    <form action="code/add-image_code.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="p_id" value="<?= $id; ?>" />
                                        <label class="mb-2">Product Images</label>
                                        <input type="file" name="image[]" class="form-control mb-3" multiple />
                                        <input type="submit" value="add_image" name="img" class="btn btn-success" />
                                    </form>
                                <?php
                                } else {
                                ?>
                                    <script>
                                        window.location.href = "properties.php";
                                    </script>
                                <?php
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
    header('Location:index.php');
}
?>