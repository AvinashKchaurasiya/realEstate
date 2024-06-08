<?php
session_start();
require_once('../../database/connection.php');
if (isset($_POST['add_prop'])) {
    $p_name = $_POST['p_name'];
    $sel = "SELECT * FROM property_types where prop_name = '$p_name'";
    $selQuery = mysqli_query($con, $sel);
    if (mysqli_num_rows($selQuery) > 0) {
        $_SESSION['sms'] = 2;
        header('location:../property_type.php');
    } else {
        $ins = "INSERT INTO property_types(prop_name) values('$p_name')";
        $query = mysqli_query($con, $ins);
        if ($query) {
            $_SESSION['sms'] = 1;
            header('location:../property_type.php');
        } else {
            $_SESSION['sms'] = 0;
            header('location:../property_type.php');
        }
    }
}
