<?php
include_once 'testdb.php';

$query = "SELECT * FROM users";

$result = mysqli_query($db, $query);

$result_array = [];

if (mysqli_num_rows($result)) {
    foreach ($result as $row) {
        array_push($result_array, $row);
    }
    header("Content-type: application/json");
    echo json_encode($result_array);
} else {
    echo "<h4>No Record found</h4>";
}

$db->close();
