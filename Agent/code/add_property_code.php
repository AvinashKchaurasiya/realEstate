<?php
session_start();
require("../../database/connection.php");
if (isset($_POST['addProp'])) {
    $title = $_POST['title'];
    $category = $_POST['prop_name'];
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
    $add_by = $_SESSION['email'];
    $status = 0;
    $ins = "INSERT INTO properties(title,description,price,location,city,state,country,zip_code,prop_name,bedrooms,bathrooms,area,amenities,availability,owner_name,owner_contact,add_by,status) values('$title','$desc','$price','$location','$city','$state','$country','$zip_code','$category','$bedroom','$bathroom','$area','$amenities','$availability','$o_name','$o_contact','$add_by','$status')";
    $query = mysqli_query($con, $ins);
    if ($query) {
        $_SESSION['sms'] = 1;
        header("Location:../properties.php");
    } else {
        $_SESSION['sms'] = 0;
        echo "error:";
    }
} else {
    echo "Please submit your form";
}
