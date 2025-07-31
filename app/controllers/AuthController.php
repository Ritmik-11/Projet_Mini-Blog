<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirm = $_POST['confirm_password'];

            $userModel = new User($this->pdo);

            if ($password !== $confirm) {
                $error = "Les mots de passe ne correspondent pas.";
            } elseif ($userModel->findByEmail($email)) {
                $error = "Un utilisateur avec cet email existe déjà.";
            } else {
                if ($userModel->create($username, $email, $password)) {
                    header('Location: index.php?page=login');
                    exit;
                } else {
                    $error = "Erreur lors de l'inscription.";
                }
            }
        }

        require 'app/views/auth/register.php';
    }
    public function login() {
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $userModel = new User($this->pdo);
        $user = $userModel->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php?page=dashboard");
            exit;
        } else {
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }

    require 'app/views/auth/login.php';
    }
    public function forgotPassword()
{
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email']);

        $userModel = new User($this->pdo);
        $user = $userModel->findByEmail($email);

        if ($user) {
            $token = bin2hex(random_bytes(50));
            $userModel->setResetToken($user['id'], $token);

            $reset_link = "http://localhost/mini_blog/index.php?controller=auth&action=resetPassword&token=$token";

            // Ici tu peux envoyer un mail avec ce lien (simulé ici)
            $message = "Un lien de réinitialisation a été envoyé à votre email : <a href='$reset_link'>Réinitialiser maintenant</a>";
        } else {
            $message = "Adresse email non reconnue.";
        }
    }

    require __DIR__ . '/../views/auth/forgot_password.php';
    }
    public function resetPassword()
    {
    $token = $_GET['token'] ?? '';
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['token'];
        $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        $userModel = new User($this->pdo);
        $success = $userModel->updatePasswordWithToken($token, $newPassword);

        if ($success) {
            $message = "Mot de passe modifié avec succès. <a href='index.php?controller=auth&action=login'>Se connecter</a>";
        } else {
            $message = "Lien invalide ou expiré.";
        }
    }

    require __DIR__ . '/../views/auth/reset_password.php';
    }

    public function logout()
    {
    session_start();
    session_unset();
    session_destroy();

    header("Location: /login");
    exit;
    }

    public function profile()
    {
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit;
    }

    $userModel = new User($this->pdo);
    $userId = $_SESSION['user_id'];
    $success = '';
    $error = '';

    // Récupérer l'utilisateur
    $user = $userModel->getById($userId);

    // Récupérer les articles de l'utilisateur
    $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE author_id = ? ORDER BY created_at DESC");
    $stmt->execute([$userId]);
    $myArticles = $stmt->fetchAll();

    // Traitement POST (mot de passe ou image)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Changement de mot de passe
        if (isset($_POST['new_password'])) {
            $newPassword = trim($_POST['new_password']);
            $confirmPassword = trim($_POST['confirm_password']);

            if ($newPassword !== $confirmPassword) {
                $error = "Les mots de passe ne correspondent pas.";
            } elseif (strlen($newPassword) < 6) {
                $error = "Le mot de passe doit contenir au moins 6 caractères.";
            } else {
                $hash = password_hash($newPassword, PASSWORD_DEFAULT);
                $userModel->updatePassword($userId, $hash);
                $success = "Mot de passe mis à jour !";
            }
        }

        // Upload photo profil
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['profile_image']['tmp_name'];
            $imageName = uniqid() . '_' . basename($_FILES['profile_image']['name']);
            $targetPath = __DIR__ . '/../../public/assets/images/' . $imageName;

            $allowed = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['profile_image']['type'], $allowed)) {
                if (move_uploaded_file($tmpName, $targetPath)) {
                    $userModel->updateProfileImage($userId, $imageName);
                    $_SESSION['profile_image'] = $imageName;
                    $success = "Photo de profil mise à jour !";
                    $user['profile_image'] = $imageName; // mettre à jour pour la vue
                } else {
                    $error = "Erreur lors de l’upload de l’image.";
                }
            } else {
                $error = "Format d’image non valide.";
            }
        }
    }

    // Afficher la vue avec les données
    require_once __DIR__ . '/../views/auth/profile.php';
}


}
