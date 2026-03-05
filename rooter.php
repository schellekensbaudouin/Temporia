<?php


require_once '/config/db_connection.php';

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'home':
        require_once ROOT . '/views/user/home.php';
        break;
    case 'register':
        require_once ROOT . '/views/auth_user/register.php';
        break;
    case 'login':
        require_once ROOT . '/views/auth_user/login.php';
        break;
    case 'logout':
        require_once ROOT . '/views/auth_user/logout.php';
        break;
}