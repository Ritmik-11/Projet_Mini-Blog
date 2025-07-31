<?php
class DashboardController {
    private $pdo;
    private $viewPath = __DIR__ . '/../views/';

    public function __construct($pdo) {
        session_start();
        $this->pdo = $pdo;
    }

    public function index() {
        if (!isset($_SESSION["user_id"])) {
            $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
            header("Location: /login");
            exit;
        }

        $user_id = $_SESSION["user_id"];
        $username = $_SESSION["username"] ?? '';
        $role = $_SESSION["role"] ?? '';

        if (empty($username) || empty($role)) {
            // On peut afficher une page d'erreur ou un message
            echo "<p>Erreur: informations utilisateur manquantes.</p>";
            return;
        }

        // Appelle la vue en passant les données
        require $this->viewPath . 'dashboard/index.php';
    }
}
