<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('../../../database/connection.php');
require('../../../vendor/autoload.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sel = "SELECT * FROM properties WHERE status=0 or status=-1 and id='$id'";
    $query = mysqli_query($con, $sel);
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $email = $data['add_by'];
        $mail = new PHPMailer(true);
        try {
            $aprove = "UPDATE properties SET status=1 where id='$id'";
            $query = mysqli_query($con, $aprove);

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
            $mail->Subject = 'Property Verified';
            $mail->Body    = 'Your added Property is Approved By Admin go and check<br/><br/><a href="http://localhost/realEstateP/login.php" target="_blank" style="background-color:#00b98e; padding:1rem; text-decoration:none; color:white; border-radius:5px; display:inline-block;">Login</a>';
            if ($query) {
                if ($mail->send()) {
                    $_SESSION['sms'] = 'Approve';
                    header('location:../../properties.php');
                } else {
                }
            } else {
                $_SESSION['sms'] = 'n_Approve';
                header('location:../../properties.php');
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['sms'] = 'Aproved_s';
        header('location:../../properties.php');
    }
}
