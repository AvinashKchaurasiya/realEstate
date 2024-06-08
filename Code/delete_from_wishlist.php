<?php
session_start();
require('../database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $del = "DELETE FROM wishlist where id = '$id'";
    if (mysqli_query($con, $del)) {
        echo "Successfully Removed";
    } else {
        echo "Something went wrong";
    }
    $con->close();
}
