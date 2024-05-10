<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <?php require_once('cssLink.php'); ?>
</head>

<body style="background-color: white;">
    <div class="container-fluid">
        <div class="row" style="margin-top:12rem;">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="card">
                    <center><img src="img/verified.png" class="card-img-top" style="width: 150px; height:150px;" alt="Email Verified" title="Email Verified" /></center>
                    <div class="card-body text-center">
                        <h5 class="card-title">Your email is verified.</h5>
                        <p class="card-text">Click on login button to further process.</p>
                        <a href="login" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <?php require_once('jsLink.php') ?>
</body>

</html>