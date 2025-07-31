<main class="profile-container">
    <h2>Modifier votre nom d'utilisateur</h2>
    <?php if (!empty($message)): ?>
        <p style="color: <?= strpos($message, 'succès') !== false ? 'green' : 'red' ?>;">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php endif; ?>
    <form method="post">
        <label>Nom actuel :</label>
        <input type="text" value="<?= htmlspecialchars($user['username']) ?>" disabled><br>

        <label for="new_username">Nouveau nom d'utilisateur :</label>
        <input type="text" name="new_username" required>

        <label for="password">Mot de passe actuel :</label>
        <input type="password" name="password" required>

        <button type="submit">Mettre à jour</button>
    </form>
</main>
