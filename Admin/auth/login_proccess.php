<?php
session_start();
require('../../database/connection.php');
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $con->prepare("SELECT * FROM admin_tbl WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $admin_data = $result->fetch_assoc();
    if ($admin_data) {
        if (password_verify($password, $admin_data['password'])) {
            $_SESSION['name'] = $admin_data['name'];
            $_SESSION['email'] = $admin_data['email'];
            header("location:../dashboard");
            exit();
        } else {
            $_SESSION['sms'] = "1";
            header("location:../index");
            exit();
        }
    } else {
        $_SESSION['sms'] = "2";
        header("location:../index");
        exit();
    }
} else {
    echo "Please Submit";
}
