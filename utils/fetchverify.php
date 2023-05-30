<?php

include_once 'db.php';


if (
    isset($_GET['id']) &&
    isset($_GET['store_name']) &&
    isset($_GET['address']) &&
    isset($_GET['email']) &&
    isset($_GET['phone_number']) &&
    isset($_GET['tin']) &&
    isset($_GET['status'])
) {
    $result1 = $db->query(
        "UPDATE grocery_store 
        SET store_name = '{$_GET['store_name']}',
        address =  '{$_GET['address']}',
        tin = '{$_GET['tin']}',
        status = '{$_GET['status']}'
        WHERE user_id = {$_GET['id']};"
    );

    $result2 = $db->query(
        "UPDATE users
        SET phone_number = '{$_GET['phone_number']}',
        email = '{$_GET['email']}'
        WHERE id = {$_GET['id']};"
    );

    if ($result1 && $result2) {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        echo json_encode(["status" => 1]);
    } else {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        echo json_encode(["status" => 0]);
    }
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = $db->query("SELECT * FROM `grocery_store` LEFT JOIN users ON grocery_store.user_id = users.id 
    WHERE status = 'Not Verified' AND user_id = $id");

    $result_array = [];

    if (mysqli_num_rows($result)) {
        foreach ($result as $row) {
            array_push($result_array, $row);
        }
    }

    header("Content-type: application/json");
    echo json_encode($result_array);
} else {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    echo json_encode(["status" => 3]);
}
