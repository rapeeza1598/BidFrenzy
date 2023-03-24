<?php
header('Content-Type: application/json');
// Check if the session variable exists
if (isset($_SESSION['username'])) {
    session_destroy();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
