<?php
require_once __DIR__ . '/../models/Article.php';

class SearchController {
    public function results() {
        global $pdo;

        $query = $_GET['q'] ?? '';

        $articleModel = new Article($pdo);
        if ($query) {
            $results = $articleModel->search($query);
        } else {
            $results = [];
        }

        include __DIR__ . '/../views/search/results.php';
    }
}
