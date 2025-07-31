<?php
require_once __DIR__ . '/../../config/database.php'; // Connexion PDO
require_once __DIR__ . '/../models/Article.php';     // Modèle Article

class HomeController {
    public function index() {
        global $pdo; // récupère la connexion depuis database.php

        $articleModel = new Article($pdo);
        $articles = $articleModel->getAllWithAuthors();

        // disponible pour la vue
        include __DIR__ . '/../views/home.php';
    }
}
