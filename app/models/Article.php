<?php
class Article {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllWithAuthors() {
        $stmt = $this->pdo->query("SELECT articles.*, users.username 
                                   FROM articles 
                                   JOIN users ON articles.author_id = users.id 
                                   ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
    public function getById($id) {
    $stmt = $this->pdo->prepare("SELECT articles.*, users.username 
                                 FROM articles 
                                 JOIN users ON articles.author_id = users.id 
                                 WHERE articles.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
    }
    public function search($query) {
    $sql = "SELECT articles.*, users.username 
            FROM articles 
            JOIN users ON articles.author_id = users.id 
            WHERE articles.title LIKE :query OR articles.content LIKE :query
            ORDER BY created_at DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['query' => "%$query%"]);
    return $stmt->fetchAll();
    }
    public function create($title, $content, $imageName, $authorId) {
    $sql = "INSERT INTO articles (title, content, image, author_id) VALUES (?, ?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$title, $content, $imageName, $authorId]);
    }
    public function update($id, $title, $content, $imageName) {
    $sql = "UPDATE articles SET title = ?, content = ?, image = ? WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$title, $content, $imageName, $id]);
    }

    public function delete($id) {
    $stmt = $this->pdo->prepare("DELETE FROM articles WHERE id = ?");
    return $stmt->execute([$id]);
    }

    public function getByAuthor($author_id)
    {
    $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE author_id = ? ORDER BY created_at DESC");
    $stmt->execute([$author_id]);
    return $stmt->fetchAll();
    }


}
