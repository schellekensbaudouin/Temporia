<?php
session_start();

// 1. Définition de la constante ROOT (indispensable pour tes chemins)
define('ROOT', dirname(__DIR__)); 

// 2. Inclusion des fichiers de configuration (Chemins sécurisés)

require_once ROOT . "/config_db/db_connection.php";

// 3. Récupération de l'action
$action = $_GET['action'] ?? 'home';

// 4. Router
switch ($action) {
    case 'home':
        require_once ROOT . '/views/user/home.php';
        break;
        
    case 'register':
        require_once ROOT . '/views/user_auth/register.php';
        break;
        
    case 'login':
        require_once ROOT . '/views/user_auth/login.php';
        break;
        
    case 'logout':
        require_once ROOT . '/views/user_auth/logout.php';
        break;

    case 'dashboard':
        require_once ROOT . '/views/user/dashboard.php';
        break;
        
    case 'profile': 
        require_once ROOT . '/views/user/profile.php';
        break;

    case 'devenir_vendeur': 
            require_once ROOT . '/views/user/devenir_vendeur.php';
            break;

    default:
        // Optionnel : Gérer le cas où l'action n'existe pas
        http_response_code(404);
        echo "Page introuvable.";
        break;
        }