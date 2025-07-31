<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $userModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
        session_start();
    }

    public function editUsername() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getById($userId);
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newUsername = trim($_POST['new_username']);
            $password = $_POST['password'];

            // Vérifie si le nouveau nom est déjà pris par un autre
            $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
            $stmt->execute([$newUsername, $userId]);

            if ($stmt->rowCount() > 0) {
                $message = "Nom d'utilisateur déjà pris.";
            } elseif (!password_verify($password, $this->userModel->getPasswordById($userId))) {
                // Pour vérifier, on va devoir ajouter cette méthode dans User.php
                $message = "Mot de passe incorrect.";
            } else {
                // Mise à jour du nom d'utilisateur
                $update = $this->pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
                $update->execute([$newUsername, $userId]);

                $_SESSION['username'] = $newUsername;
                $message = "Nom d'utilisateur mis à jour avec succès !";
                $user['username'] = $newUsername;
            }
        }

        require_once __DIR__ . '/../views/user/edit_username.php';
    }
}
