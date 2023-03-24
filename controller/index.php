<?php
$reruestURL = $_SERVER['REQUEST_URI'];

switch ($reruestURL) {
    case '':
        echo "1";
        break;
    case '/':
        echo '1';
        break;
    case '/login':
        echo 'Login';
        break;
    case '/logout':
        echo 'Logout';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '../view/404.html';
        break;
}