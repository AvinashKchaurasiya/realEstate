<?php
require('../../database/connection.php');
if (isset($_POST['amenities'])) {
    $amenities = $_POST['amenities'];
    $sql = "INSERT INTO amenities (amenity) VALUES ('$amenities')";
    if ($con->query($sql) === TRUE) {
        echo "Amenities added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

$conn->close();
