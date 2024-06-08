<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('../database/connection.php');
require('../vendor/autoload.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $mail = new PHPMailer(true);
    $update = "UPDATE register_a_u SET password='$hashed_password' where email='$email'";
    if (mysqli_query($con, $update)) {
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '211435@kit.ac.in';
            $mail->Password   = 'htenshdyxccmgpbu';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;


            $mail->setFrom('211435@kit.ac.in', 'Main Bazar');
            $mail->addAddress($email, 'Reset Password');

            $mail->isHTML(true);
            $mail->Subject = 'Reset Password Done';
            $mail->Body    = 'Your password is successfully reset.<br/>Your Password is : ' . $password . ' <br/><br/>
            <a href="http://localhost/realEstateP/login.php" target="_blank" style="background-color:#00b98e; padding:1rem; text-decoration:none; color:white; border-radius:5px; display:inline-block;">Login</a>';
            if ($mail->send()) {
                echo "sent";
            } else {
                echo "n_sent";
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email is not registered please check your email address";
    }
}
