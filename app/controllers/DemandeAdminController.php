<?php
class DemandeAdminController {
    private $pdo;
    private $viewPath = __DIR__ . '/../views/';

    public function __construct($pdo) {
        session_start();
        $this->pdo = $pdo;
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reason = trim($_POST['reason'] ?? '');

            // Vérifier s’il n’a pas déjà une demande en attente
            $check = $this->pdo->prepare("SELECT * FROM admin_requests WHERE user_id = ? AND status = 'en attente'");
            $check->execute([$user_id]);

            if ($check->rowCount() > 0) {
                $message = "Tu as déjà une demande en attente.";
            } else {
                $stmt = $this->pdo->prepare("INSERT INTO admin_requests (user_id, reason) VALUES (?, ?)");
                $stmt->execute([$user_id, $reason]);
                $message = "Ta demande a été envoyée. Elle est en attente de validation.";
            }
        }

        require $this->viewPath . 'demande_admin/index.php';
    }
}
