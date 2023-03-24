<?php
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once '../model/class.users.php';
$users = new users();
$serverReq = $_SERVER['REQUEST_METHOD'];

if ($serverReq == 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input);
    if (isset($data->username) && isset($data->password) && isset($data->email) && isset($data->firstName) && isset($data->lastName)) {
        $username = $data->username;
        $password = $data->password;
        $email = $data->email;
        $firstName = $data->firstName;
        $lastName = $data->lastName;
        if ($users->usersRegister($username, $password, $email, $firstName, $lastName)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
