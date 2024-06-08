<?php
session_start();
require('../database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];

    $sel = "SELECT * FROM wishlist where property_id = '$id' AND email = '$email'";
    if (mysqli_num_rows(mysqli_query($con, $sel)) > 0) {
        echo "This Property already exists in your wishlist";
    } else {
        $sql = "INSERT INTO wishlist (email, property_id) VALUES (?, ?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('si', $email, $id);
            if ($stmt->execute()) {
                echo 'Wishlist item added successfully';
            } else {
                echo 'Error: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            echo 'Error: ' . $con->error;
        }
    }
    $con->close();
}
