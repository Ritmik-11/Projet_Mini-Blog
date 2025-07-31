<?php
// public/index.php

require_once __DIR__ . '/../config/database.php';

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = __DIR__ . "/../app/controllers/$controllerName.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName($pdo);

    if (class_exists($controllerName)) {
        $controllerInstance = new $controllerName();

        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            http_response_code(404);
            echo "⚠️ Action '$action' introuvable dans le contrôleur '$controllerName'.";
        }
    } else {
        http_response_code(500);
        echo "❌ Classe '$controllerName' introuvable dans le fichier.";
    }
} else {
    http_response_code(404);
    echo "❌ Contrôleur '$controllerName' introuvable.";
}

$router->get('/profile', [AuthController::class, 'requireAuth']);
$router->get('/profile', [ProfileController::class, 'index']);
$router->post('/profile', [ProfileController::class, 'index']);

