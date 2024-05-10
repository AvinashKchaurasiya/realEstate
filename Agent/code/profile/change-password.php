<?php
require('../../../database/connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $npassword = $_POST['npassword'];
    $cpassword = $_POST['cpassword'];
    $hashed_password = password_hash($npassword, PASSWORD_DEFAULT);
    $stmt = $con->prepare("SELECT * FROM register_a_u WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();
    if ($user_data) {
        $update = "UPDATE register_a_u SET password='$hashed_password' WHERE email='$email'";
        $updateQuery = mysqli_query($con, $update);
        if ($updateQuery) {
            echo "Password Changed";
        }
    } else {
        echo "This" . $email . " is not exist";
    }
}
