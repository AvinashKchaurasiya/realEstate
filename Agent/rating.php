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