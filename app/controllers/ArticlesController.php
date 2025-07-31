<?php
require_once __DIR__ . '/../models/Article.php';

class ArticlesController {
    // Méthode index() déjà existante, on la garde

    public function add() {
        session_start();

        if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? '') !== 'admin') {
            header("Location: index.php?controller=login&action=index");
            exit;
        }

        $title = '';
        $content = '';
        $success = '';
        $error = '';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            global $pdo;

            $title = trim($_POST["title"] ?? '');
            $content = trim($_POST["content"] ?? '');

            // Gestion image
            $imageName = '';
            if (!empty($_FILES['image']['name'])) {
                $imageTmp = $_FILES['image']['tmp_name'];
                $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
                $targetPath = __DIR__ . '/../../public/assets/images/' . $imageName;

                $allowed = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($_FILES['image']['type'], $allowed)) {
                    $error = "Seuls les fichiers JPEG, PNG ou GIF sont autorisés.";
                } elseif (!move_uploaded_file($imageTmp, $targetPath)) {
                    $error = "Échec du téléchargement de l’image.";
                }
            }

            if (empty($title) || empty($content)) {
                $error = "Titre et contenu sont obligatoires.";
            }

            if (!$error) {
                $articleModel = new Article($pdo);
                if ($articleModel->create($title, $content, $imageName, $_SESSION["user_id"])) {
                    $success = "Article publié avec succès ! 🎉";
                    $title = '';
                    $content = '';
                } else {
                    $error = "Erreur lors de la publication.";
                }
            }
        }
        
        include __DIR__ . '/../views/articles/add.php';
    }
    public function edit() {
    session_start();
    if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? '') !== 'admin') {
        header("Location: index.php?controller=login&action=index");
        exit;
    }

    global $pdo;

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $error = "Article invalide.";
        include __DIR__ . '/../views/articles/edit.php';
        return;
    }

    $id = (int) $_GET['id'];
    $articleModel = new Article($pdo);
    $article = $articleModel->getById($id);

    if (!$article) {
        $error = "Article non trouvé.";
        include __DIR__ . '/../views/articles/edit.php';
        return;
    }

    $title = $article['title'];
    $content = $article['content'];
    $currentImage = $article['image'];
    $success = '';
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $newImage = $currentImage;

        if (!empty($_FILES['image']['name'])) {
            $imageTmp = $_FILES['image']['tmp_name'];
            $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetPath = __DIR__ . '/../../public/assets/images/' . $imageName;
            $allowed = ['image/jpeg', 'image/png', 'image/gif'];

            if (!in_array($_FILES['image']['type'], $allowed)) {
                $error = "Seuls les fichiers JPEG, PNG ou GIF sont autorisés.";
            } elseif (!move_uploaded_file($imageTmp, $targetPath)) {
                $error = "Échec du téléchargement de l’image.";
            } else {
                if (!empty($currentImage) && file_exists(__DIR__ . '/../../public/assets/images/' . $currentImage)) {
                    unlink(__DIR__ . '/../../public/assets/images/' . $currentImage);
                }
                $newImage = $imageName;
            }
        }

        if (empty($title) || empty($content)) {
            $error = "Titre et contenu sont obligatoires.";
        }

        if (!$error) {
            if ($articleModel->update($id, $title, $content, $newImage)) {
                $success = "Article mis à jour avec succès ! ✅";
                $currentImage = $newImage;
            } else {
                $error = "Erreur lors de la mise à jour.";
            }
        }
    }

    include __DIR__ . '/../views/articles/edit.php';
}

public function delete() {
    session_start();
    if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? '') !== 'admin') {
        header("Location: index.php?controller=login&action=index");
        exit;
    }

    global $pdo;

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $error = "ID d'article invalide.";
        include __DIR__ . '/../views/articles/delete.php';
        return;
    }

    $id = (int) $_GET['id'];
    $articleModel = new Article($pdo);
    $article = $articleModel->getById($id);

    if (!$article) {
        $error = "Article non trouvé.";
        include __DIR__ . '/../views/articles/delete.php';
        return;
    }

    // Suppression de l'image
    if (!empty($article['image']) && file_exists(__DIR__ . '/../../public/assets/images/' . $article['image'])) {
        unlink(__DIR__ . '/../../public/assets/images/' . $article['image']);
    }

    if ($articleModel->delete($id)) {
        // redirection vers la liste des articles
        header("Location: index.php?controller=articles&action=index&msg=deleted");
        exit;
    } else {
        $error = "Erreur lors de la suppression.";
        include __DIR__ . '/../views/articles/delete.php';
    }
}

}
