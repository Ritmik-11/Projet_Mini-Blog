<?php
class AdminRequestController {
    private $pdo;
    private $viewPath = __DIR__ . '/../views/';

    public function __construct($pdo) {
        session_start();
        $this->pdo = $pdo;
    }

    public function index() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /dashboard');
            exit;
        }

        // Actions GET (approuver/refuser)
        if (isset($_GET['action'], $_GET['id'])) {
            $id = $_GET['id'];
            $action = $_GET['action'];

            if ($action === 'approuver') {
                $this->pdo->prepare("
                    UPDATE users SET role = 'admin' 
                    WHERE id = (SELECT user_id FROM admin_requests WHERE id = ?)
                ")->execute([$id]);

                $this->pdo->prepare("
                    UPDATE admin_requests SET status = 'approuvée' WHERE id = ?
                ")->execute([$id]);

            } elseif ($action === 'refuser') {
                $this->pdo->prepare("
                    UPDATE admin_requests SET status = 'refusée' WHERE id = ?
                ")->execute([$id]);
            }
        }

        // Récupérer les demandes
        $stmt = $this->pdo->query("
            SELECT admin_requests.*, users.username 
            FROM admin_requests 
            JOIN users ON admin_requests.user_id = users.id 
            ORDER BY created_at DESC
        ");
        $requests = $stmt->fetchAll();

        require $this->viewPath . 'admin_requests/index.php';
    }
}
