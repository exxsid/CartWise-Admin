<?php

include_once 'db.php';

if (
    isset($_GET['id']) &&
    isset($_GET['fname']) &&
    isset($_GET['lname']) &&
    isset($_GET['email']) &&
    isset($_GET['uname']) &&
    isset($_GET['phone']) &&
    isset($_GET['password'])
) {
    $result1 = $db->query(
        "UPDATE customer
        SET firstname = '{$_GET['fname']}',
        lastname = '{$_GET['lname']}',
        username = '{$_GET['uname']}'
        WHERE user_id = {$_GET['id']};"
    );

    $result2 = $db->query(
        "UPDATE users
        SET email = '{$_GET['email']}',
        phone_number = '{$_GET['email']}',
        password = '{$_GET['password']}'
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
} else {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    echo json_encode(["status" => 3]);
}
