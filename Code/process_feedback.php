<?php
session_start();
require('../database/connection.php');
$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];
$image = $_FILES['image'];
$sel = "SELECT * FROM testimonial where email='$email'";
$query = mysqli_query($con, $sel);
if (mysqli_num_rows($query) > 0) {
    $_SESSION['sms'] = 2;
    header('location:../feedback.php');
} else {
    if ($image && $image['error'] == 0) {
        $target_dir = "../img/feedback_image/";
        $target_file = $target_dir . basename($image["name"]) . rand(10, 100);
        $imageName = basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $target_file);
        $ins = "INSERT INTO testimonial(name,email,feedback,image) values('$name','$email','$feedback','$imageName')";
        $sql = mysqli_query($con, $ins);
        if ($sql) {
            $_SESSION['sms'] = 1;
            header('location:../feedback.php');
        }
    } else {
        $_SESSION['sms'] = 0;
        header('location:../feedback.php');
    }
}
