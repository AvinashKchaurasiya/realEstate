<?php
session_start();
require('../../database/connection.php');
if (isset($_POST['update_prop'])) {
    $prop_id = $_POST['prop_id'];
    $prop_name = $_POST['prop_name'];
    $sel = "SELECT * FROM property_types where prop_name = '$prop_name'";
    $query = mysqli_query($con, $sel);
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['sms'] = 1;
        header('Location:../edit_prop_type');
    } else {
        $update = "UPDATE property_types SET prop_name = '$prop_name' WHERE prop_id = '$prop_id'";
        $sql = mysqli_query($con, $update);
        if ($sql) {
            $_SESSION['sms'] = 6;
            header('Location:../property_type');
        }
    }
}
