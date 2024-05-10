<?php
session_start();
require('../../../database/connection.php');
if (isset($_POST['saves'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $update = "UPDATE register_a_u SET name='$name', email='$email',number='$number' where id='$id'";
    $query = mysqli_query($con, $update);
    if ($query) {
        $_SESSION['sms'] = 'updated';
        header('location:../../profile');
    } else {
        $_SESSION['sms'] = 'not_updated';
        header('location:../../profile');
    }
}
