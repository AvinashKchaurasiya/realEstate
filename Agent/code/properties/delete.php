<?php
session_start();
require('../../../database/connection.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $image = [];
    $sel = "SELECT * from property_images where pr_id = '$id'";
    $query = mysqli_query($con, $sel);
    if ($query) {
        while ($row = mysqli_fetch_array($query)) {
            array_push($image, "../../../Admin/Images/propertyImage/" . $row['image']);
        }
    }
    // print_r($image);
    $del = "DELETE FROM properties WHERE id='$id'";
    $query1 = mysqli_query($con, $del);
    $delImage = "DELETE FROM property_images where pr_id='$id'";
    $query2 = mysqli_query($con, $delImage);
    if ($query1 && $query2) {
        foreach ($image as $img) {
            unlink($img);
        }
        $_SESSION['sms'] = 'deleted';
        header("location:../../properties");
    } else {
        $_SESSION['sms'] = 'not_d';
        header("location:../../properties");
    }
} else {
    header("location:../../properties");
}
