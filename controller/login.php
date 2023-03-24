<?php
$serverReq = $_SERVER['REQUEST_METHOD'];
if ($serverReq == 'GET') {
    $data = file_get_contents("php://input");
    $data = json_decode($data, true);
    $username = $data['username'];
    $password = $data['password'];
    
}