<?php

include_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = $db->query("SELECT * FROM customer 
LEFT JOIN users ON customer.user_id = users.id WHERE user_id = $id");

    $result_array = [];

    if (mysqli_num_rows($result)) {
        foreach ($result as $row) {
            array_push($result_array, $row);
        }
    }

    header("Content-type: application/json");
    echo json_encode($result_array);
}
