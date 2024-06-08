<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('../database/connection.php');
require('../vendor/autoload.php');

if (isset($_POST['signup'])) {
    $status = 0;
    $user_type = $_POST['login_type'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO register_a_u (user_type, name, email, password,isVerify) VALUES (?, ?, ?, ?,?)");
    if ($stmt === false) {
        die("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("sssss", $user_type, $name, $email, $hashed_password, $status);
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '211435@kit.ac.in';
        $mail->Password   = 'htenshdyxccmgpbu';
        // $mail->Password   = 'Avinash@2000';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;


        $mail->setFrom('211435@kit.ac.in', 'Main Bazar');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'Verify Your Email';
        $mail->Body    = 'Your account has been created successfully to verify your email<br/><a href="http://localhost/realEstateP/Authentication/verify.php?email=' . $email . '" target="_blank" style="background-color:#00b98e; padding:1rem; text-decoration:none; color:white; border-radius:5px; display:inline-block;">Verify Email</a>';


        if ($stmt->execute()) {
            if ($mail->send()) {
                $_SESSION['sms'] = "1";
                header("Location:../login.php");
            } else {
                $_SESSION['err'] = '0';
                header("Location:../registration.php");
            }
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Error: Registration form not submitted properly.";
}
