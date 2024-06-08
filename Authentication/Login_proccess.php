<?php
session_start();
require('../database/connection.php');
if (isset($_POST['login'])) {
    $login_type = $_POST['login_type'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $con->prepare("SELECT * FROM register_a_u WHERE user_type = ? AND email = ?");
    $stmt->bind_param("ss", $login_type, $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();

    if ($user_data) {
        if (password_verify($password, $user_data['password'])) {
            if ($login_type == 'agent') {
                $_SESSION['name'] = $user_data['name'];
                $_SESSION['email'] = $user_data['email'];
                header("location:../agent/dashboard.php");
                exit();
            } else if ($login_type == 'user') {
                $_SESSION['name'] = $user_data['name'];
                $_SESSION['email'] = $user_data['email'];
                header("location:../index.php");
                exit();
            }
        } else {
            $_SESSION['sms'] = "2";
            header("location:../login.php");
            exit();
        }
    } else {
        $_SESSION['sms'] = "4";
        header("location:../login.php");
        exit();
    }
} else {
    echo "Please Submit Form First";
}
