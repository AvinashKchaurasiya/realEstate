<?php
require('../../database/connection.php');
$sql = "SELECT * FROM amenities";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $sn = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<td>' . $sn . '</td>';
        echo '<td>' . $row["amenity"] . '</td>';
        echo '<td><button class="btn btn-danger btn-sm" onclick="deleteAmenities(' . $row["id"] . ')">Delete</button></td>';
        echo "</tr>";
        $sn++;
    }
} else {
    echo "No amenities found";
}
$conn->close();
