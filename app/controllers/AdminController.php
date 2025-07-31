<?php
require_once __DIR__ . '/../models/Message.php';

class AdminController {
    private $pdo;

    public function __construct() {
        require __DIR__ . '/../../config/database.php';
        $this->pdo = $pdo;
        session_start();
    }

    public function messages() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        $messageModel = new Message($this->pdo);
        $messages = $messageModel->getAllMessages();

        require __DIR__ . '/../views/admin/messages.php';
    }
}
