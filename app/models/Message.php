<?php
class Message {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllMessages() {
        $stmt = $this->pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
}
