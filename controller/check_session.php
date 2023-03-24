<?php
session_start();
header('Content-Type: application/json');
// Check if the session variable exists
if(isset($_SESSION['username'])) {
  echo json_encode(['loggedIn' => true, 'username' => $_SESSION['username']]);
} else {
  echo json_encode(['loggedIn' => false]);
}
