<?php
require('../../database/connection.php');
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $delete = "DELETE FROM amenities where id = '$id'";
    $sql = mysqli_query($con, $delete);
    if ($sql) {
        echo "Deleted";
    } else {
        echo "Somthing Wrong";
    }
}
