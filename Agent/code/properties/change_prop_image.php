<?php
session_start();
require('../../../database/connection.php');
if (isset($_POST['img'])) {
    $id = $_POST['p_id'];
    $image = [];
    $sel = "SELECT * from property_images where pr_id = '$id'";
    $query1 = mysqli_query($con, $sel);
    if ($query1) {
        while ($row = mysqli_fetch_array($query1)) {
            array_push($image, "../../../Admin/Images/propertyImage/" . $row['image']);
        }
    }
    $del = "DELETE FROM property_images WHERE pr_id = '$id'";
    $query2 = mysqli_query($con, $del);
    $targetDir = "../../../Admin/Images/propertyImage/";
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
                if ($query && $query1) {
                    foreach ($image as $img) {
                        unlink($img);
                    }
                    $_SESSION['sms'] = 'img_change';
                    header('location:../../properties');
                } else {
                    $_SESSION['sms'] = 0;
                    header('location:../../change_prop_img');
                }
            } else {
                $_SESSION['sms'] = 1;
                header('location:../../change_prop_img');
            }
        } else {
            $_SESSION['sms'] = 3;
            header('location:../../change_prop_img');
        }
    }
}
