<?php
session_start();
require('../../database/connection.php');
if (isset($_POST['img'])) {
    $id = $_POST['p_id'];
    $targetDir = '../../Admin/Images/propertyImage/';
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    foreach ($_FILES['image']['name'] as $key => $val) {
        $currentTime = date('YmdHis');
        $fileName = $currentTime . '_' . basename($_FILES['image']['name'][$key]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $targetFilePath)) {
                $insert = "INSERT into property_images(image,pr_id) VALUES ('$fileName',$id)";
                $query = mysqli_query($con, $insert);
                if ($query) {
                    $_SESSION['sms'] = 2;
                    header('location:../properties');
                } else {
                    $_SESSION['sms'] = 0;
                    header('location:../add-image');
                }
            } else {
                $_SESSION['sms'] = 1;
                header('location:../add-image');
            }
        } else {
            $_SESSION['sms'] = 3;
            header('location:../add-image');
        }
    }
}
