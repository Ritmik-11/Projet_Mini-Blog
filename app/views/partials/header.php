<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>📝 Mini Blog</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header>
    <div class="header-container">
        <h1>📝 Mini Blog</h1>
        <nav>
            <a href="index.php?page=home">Accueil</a>
            <a href="index.php?page=service">Services</a>
            <a href="index.php?page=contact">Contact</a>
            <?php if (isset($_SESSION["user_id"])): ?>
                <a href="index.php?page=dashboard">Dashboard</a>
                <a href="index.php?page=profile">Profil</a>
                <a href="index.php?page=logout">Déconnexion</a>
            <?php else: ?>
                <a href="index.php?page=login">Connexion</a>
                <a href="index.php?page=register">Inscription</a>
                <p class="nom">Connectez-vous pour pouvoir partager vos idées dans le blog.</p>
            <?php endif; ?>
        </nav>
    </div>
    <hr>
</header>
<script>
    let lastScrollY = window.scrollY;
    const header = document.querySelector("header");

    window.addEventListener("scroll", () => {
        const currentScrollY = window.scrollY;
        const scrollDifference = currentScrollY - lastScrollY;

        if (currentScrollY < 100) {
            header.classList.remove("hide");
        } else if (scrollDifference > 10) {
            header.classList.add("hide");
        } else if (scrollDifference < -10) {
            header.classList.remove("hide");
        }

        lastScrollY = currentScrollY;
    });
</script>

<main>
