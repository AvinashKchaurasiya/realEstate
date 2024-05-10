<?php
session_start();
require("../../../database/connection.php");
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $category = $_POST['prop_t_id'];
    $desc = $_POST['description'];
    $amenities = $_POST['amenities'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $zip_code = $_POST['zip_code'];
    $bedroom = $_POST['bedrooms'];
    $bathroom = $_POST['bathrooms'];
    $area = $_POST['area'];
    $availability = $_POST['availability'];
    $o_name = $_POST['owner_name'];
    $o_contact = $_POST['owner_contact'];
    $update = "UPDATE properties SET title ='$title', description ='$desc',price ='$price',location='$location',city='$city',state='$state',country='$country',zip_code='$zip_code',prop_id='$category',bedrooms='$bedroom',bathrooms='$bathroom',area='$area',amenities='$amenities',availability='$availability',owner_name='$o_name',owner_contact='$o_contact' where id='$id'";
    $query = mysqli_query($con, $update);
    if ($query) {
        $_SESSION['sms'] = 'Updated';
        header("Location:../../properties");
    } else {
        $_SESSION['sms'] = 'n_update';
        header("Location:../../properties");
    }
} else {
    echo "Please submit your form";
}
