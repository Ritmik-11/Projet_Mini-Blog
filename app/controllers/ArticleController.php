<?php
require_once __DIR__ . '/../models/Article.php';

class ArticleController {
    public function show() {
        global $pdo;

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $error = "Article invalide.";
            include __DIR__ . '/../views/article/show.php';
            return;
        }

        $id = (int) $_GET['id'];
        $articleModel = new Article($pdo);
        $article = $articleModel->getById($id);

        if (!$article) {
            $error = "Article non trouvé.";
        }

        include __DIR__ . '/../views/article/show.php';
    }
}
