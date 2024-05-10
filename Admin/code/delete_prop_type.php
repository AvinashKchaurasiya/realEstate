<?php
session_start();
require('../../database/connection.php');
if (isset($_GET['id'])) {
    $prop_id = $_GET['id'];
    $del = "DELETE FROM property_types where prop_id = '$prop_id'";
    $query = mysqli_query($con, $del);
    if ($query) {
        $_SESSION['sms'] = 4;
        header('location:../property_type');
    } else {
        $_SESSION['sms'] = 5;
        header('location:../property_type');
    }
}
