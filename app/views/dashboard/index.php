<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="img">
    <img src="/public/assets/images/users.png" alt="">
</div>

<div class="dashboard-container">
    <h2>
        Bienvenue sur ton tableau de bord, <?= htmlspecialchars($username); ?> 
        <?php if ($role === 'admin'): ?>
            <span class="badge badge-admin">Admin ✅</span>
        <?php else: ?>
            <span class="badge badge-user">Utilisateur 👤</span>
        <?php endif; ?>
        👋
    </h2>

    <?php if ($role === 'admin'): ?>
        <p>🛠 Tu es connecté en tant qu'<strong>administrateur</strong>.</p>
        <ul>
            <li><a href="/add-article">➕ Ajouter un article</a></li>
            <li><a href="/articles">📃 Gérer les articles</a></li>
            <li><a href="/users">👥 Gérer les utilisateurs</a></li>
            <li><a href="/admin-requests">📩 Voir les demandes admin</a></li>
            <li><a href="/edit-username">✏️ Changer mon username</a></li>
        </ul>
    <?php else: ?>
        <p>🔐 Tu es connecté en tant qu'<strong>utilisateur</strong>.</p>
        <ul>
            <li>📖 Tu peux consulter les articles publiés ou modifier ton profil.</li>
            <li>📝 Faire une demande pour devenir admin : <a href="/demande-admin">Demander un rôle admin</a></li>
            <li>✏️ Changer mon nom d'utilisateur : <a href="/edit-username">Modifier mon username</a></li>
        </ul>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
