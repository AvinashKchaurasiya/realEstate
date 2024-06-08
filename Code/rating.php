<?php
session_start();
require_once('../database/connection.php');
if (isset($_POST['rating'])) {
    $prop_id = $_POST['id'];
    $id = urlencode($prop_id);
    $ratting = $_POST['star'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $sel = "SELECT * FROM ratings where property_id='$prop_id' AND email='$email'";
    if (mysqli_num_rows(mysqli_query($con, $sel)) > 0) {
        $_SESSION['sms'] = "failed";
        header('Location:../property-desc.php?id=' . $id);
    } else {
        $ins = "INSERT INTO ratings(property_id,rating,name,email,comment) Values('$prop_id','$ratting','$name','$email','$comment')";
        if (mysqli_query($con, $ins)) {
            $_SESSION['sms'] = 1;
            header('Location:../property-desc.php?id=' . $id);
        } else {
            $_SESSION['sms'] = 0;
            header('Location:../property-desc.php?id=' . $id);
        }
    }
} else {
    header('Location:../property-desc.php?id=' . $id);
}
