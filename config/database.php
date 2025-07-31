<?php
$host = 'localhost';
$dbname = 'mini_blog_db';
$user = 'root'; // ou autre nom selon ta config
$pass = '';     // mot de passe MySQL s'il y en a un

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
