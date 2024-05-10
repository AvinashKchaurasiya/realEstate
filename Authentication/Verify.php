<?php
require('../database/connection.php');
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    // echo $email;
    $update = "UPDATE register_a_u SET isVerify=1 where email='$email'";
    $query = mysqli_query($con, $update);
    if ($query) {
        echo "<script>";
        echo "window.location.href='http://localhost/realEstateP/Verified'";
        echo "</script>";
    }
}
