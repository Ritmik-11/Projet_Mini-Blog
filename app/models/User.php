<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create($username, $email, $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashed]);
    }
    public function findByUsername($username) {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetch();
    }

    public function setResetToken($userId, $token)
    {
    $stmt = $this->pdo->prepare("UPDATE users SET reset_token = ?, token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE id = ?");
    return $stmt->execute([$token, $userId]);
    }

    public function updatePasswordWithToken($token, $hashedPassword)
    {
    $stmt = $this->pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE reset_token = ? AND token_expiry > NOW()");
    $stmt->execute([$hashedPassword, $token]);
    return $stmt->rowCount() > 0;
    }

    public function getById($id)
    {
    $stmt = $this->pdo->prepare("SELECT username, email, role, profile_image FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
    }

    public function updatePassword($id, $hash)
    {
    $stmt = $this->pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->execute([$hash, $id]);
    }

    public function updateProfileImage($id, $image)
    {   
    $stmt = $this->pdo->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
    $stmt->execute([$image, $id]);
    }

    public function getPasswordById($id) {
    $stmt = $this->pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result ? $result['password'] : null;
    }


}
