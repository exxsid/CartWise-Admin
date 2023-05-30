<?php

include_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = $db->query("SELECT * FROM `grocery_store` LEFT JOIN users ON grocery_store.user_id = users.id 
    WHERE status = 'Verified' AND user_id = $id");

    $result_array = [];

    if (mysqli_num_rows($result)) {
        foreach ($result as $row) {
            array_push($result_array, $row);
        }
    }

    header("Content-type: application/json");
    echo json_encode($result_array);
}
