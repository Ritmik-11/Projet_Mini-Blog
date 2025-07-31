<?php

require_once 'app/models/User.php';
require_once 'app/models/Article.php';

class ProfileController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: /login");
            exit;
        }
        require_once 'config/database.php'; 

        $userModel = new User($pdo);        
        $articleModel = new Article($pdo);  


        $user_id = $_SESSION["user_id"];

        $success = '';
        $error = '';

        // 🔁 Mise à jour mot de passe
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['new_password'])) {
            $newPassword = trim($_POST['new_password']);
            $confirmPassword = trim($_POST['confirm_password']);

            if ($newPassword !== $confirmPassword) {
                $error = "Les mots de passe ne correspondent pas.";
            } elseif (strlen($newPassword) < 6) {
                $error = "Le mot de passe doit contenir au moins 6 caractères.";
            } else {
                $hash = password_hash($newPassword, PASSWORD_DEFAULT);
                $userModel->updatePassword($user_id, $hash);
                $success = "Mot de passe mis à jour !";
            }
        }

        // 🔁 Upload image
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['profile_image']['tmp_name'];
            $imageName = uniqid() . '_' . basename($_FILES['profile_image']['name']);
            $targetPath = 'public/assets/images/' . $imageName;

            $allowed = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['profile_image']['type'], $allowed)) {
                if (move_uploaded_file($tmpName, $targetPath)) {
                    $userModel->updateProfileImage($user_id, $imageName);
                    $_SESSION['profile_image'] = $imageName;
                    $success = "Photo de profil mise à jour !";
                } else {
                    $error = "Erreur lors de l’upload de l’image.";
                }
            } else {
                $error = "Format d’image non valide.";
            }
        }

        $user = $userModel->getById($user_id);
        $myArticles = $articleModel->getByAuthor($user_id);

        $this->render('auth/profile', compact('user', 'myArticles', 'success', 'error'));
    }
}
