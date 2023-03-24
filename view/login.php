<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $input = file_get_contents('php://input');
  $data = json_decode($input);

  if(isset($data->username) && isset($data->password)) {
    $username = $data->username;
    $password = $data->password;

    // Check if the username and password are correct
    if ($username === 'admin' && $password === 'password') {
      header('Content-Type: application/json');
      echo json_encode(['success' => true]);
    } else {
      header('Content-Type: application/json');
      echo json_encode(['success' => false]);
    }
  } else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false]);
  }
}

?>
