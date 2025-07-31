<?php
class ContactController {
    private $pdo;
    private $viewPath = __DIR__ . '/../views/';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        $success = '';
        $error = '';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);
            $message = trim($_POST["message"]);

            if (empty($name) || empty($email) || empty($message)) {
                $error = "Tous les champs sont obligatoires.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Adresse e-mail invalide.";
            } else {
                // 📩 Envoi d’email
                $to = "tonadresse@mail.com";
                $subject = "Nouveau message de $name";
                $body = "De: $name <$email>\n\n$message";

                if (mail($to, $subject, $body)) {
                    $success = "Message envoyé avec succès ! ✅";
                } else {
                    $error = "Échec de l'envoi du message.";
                }

                // 💾 Enregistrement du message
                $stmt = $this->pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
                $stmt->execute([$name, $email, $message]);
            }
        }

        require $this->viewPath . 'contact/index.php';
    }
}
