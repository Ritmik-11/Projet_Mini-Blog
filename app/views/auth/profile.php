<?php include 'partials/header.php'; ?>

<div class="img">
    <img src="/public/assets/images/profil.jpeg" alt="">
</div>

<div class="profile-container">
    <h2>👤 Mon Profil</h2>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if (!empty($user['profile_image'])): ?>
        <img src="/public/assets/images/<?= htmlspecialchars($user['profile_image']) ?>" alt="Photo de profil" width="150">
    <?php endif; ?>

    <div class="profil">
        <table border="1" cellpadding="10">
            <tr>
                <th>Nom d'utilisateur</th>
                <td><?= htmlspecialchars($user['username']) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($user['email']) ?></td>
            </tr>
            <tr>
                <th>Rôle</th>
                <td><?= htmlspecialchars($user['role']) ?></td>
            </tr>
        </table>
    </div>

    <form method="post" enctype="multipart/form-data">
        <p>📸 Mettre à jour la photo de profil</p>
        <input type="file" name="profile_image" accept="image/*">
        <button type="submit">Uploader</button>
    </form>

    <hr>

    <h3>🔒 Changer le mot de passe</h3>
    <form method="post">
        <input type="password" name="new_password" placeholder="Nouveau mot de passe" required><br><br>
        <input type="password" name="confirm_password" placeholder="Confirme le mot de passe" required><br><br>
        <button type="submit">Changer</button>
    </form>

    <hr>

    <h3>📄 Mes articles</h3>
    <?php if (empty($myArticles)): ?>
        <p>Aucun article publié pour l’instant.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($myArticles as $a): ?>
                <li>
                    <strong><?= htmlspecialchars($a['title']) ?></strong>
                    (publié le <?= date('d/m/Y H:i', strtotime($a['created_at'])) ?>)
                </li>
            <?php endforeach; ?>
        </ul>

        <hr>

        <h3>🖼️ Galerie de mes images</h3>
        <div class="gallery">
            <?php
            $hasImages = false;
            foreach ($myArticles as $a) {
                if (!empty($a['image'])) {
                    $hasImages = true;
                    echo '<img src="/public/assets/images/' . htmlspecialchars($a['image']) . '" alt="Image de l\'article" class="thumb">';
                }
            }
            if (!$hasImages) {
                echo "<p>Aucune image trouvée dans vos articles.</p>";
            }
            ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'partials/footer.php'; ?>
