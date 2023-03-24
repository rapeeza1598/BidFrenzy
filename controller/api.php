<?php
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once '../model/class.users.php';
$users = new users();
$serverReq = $_SERVER['REQUEST_METHOD'];
session_start(); // Start the session
switch ($serverReq) {
    case 'GET':
        if (!isset($_SESSION['username'])) {
            header('Location: ./view/dashboard.html'); // Redirect to login page if session variable is not set
            exit();
        }
        echo json_encode(['METHOD' => 'GET']);
    case 'POST':
        $input = file_get_contents('php://input');
        $data = json_decode($input);
        if (isset($data->username) && isset($data->password)) {
            $username = $data->username;
            $password = $data->password;

            // if ($username === 'admin' && $password === 'admin') {
            //     $_SESSION['username'] = $username; // Set the session variable
            //     echo json_encode(['success' => true]);
            if ($users->usersLogin($username,$password)) {
                $_SESSION['username'] = $username; // Set the session variable
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
        break;
    case 'PUT':
        echo json_encode(['METHOD' => 'PUT']);
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
        break;
    default:
        echo json_encode(['success' => false]);
        break;
}
