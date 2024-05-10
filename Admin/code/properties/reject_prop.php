<?php
session_start();
require('../../../database/connection.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sel = "SELECT * FROM properties WHERE status =0 or status=1 and id = '$id'";
    if (mysqli_num_rows(mysqli_query($con, $sel)) > 0) {
        $update = "UPDATE properties SET status=-1 where id = '$id'";
        $query = mysqli_query($con, $update);
        if ($query) {
            $_SESSION['sms'] = 'reject';
            header('location:../../properties');
        } else {
            $_SESSION['sms'] = 'not_reject';
            header('location:../../properties');
        }
    } else {
        $_SESSION['sms'] = 'rejected';
        header('location:../../properties');
    }
}
