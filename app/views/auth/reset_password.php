<?php include __DIR__ . '/../partials/header.php'; ?>

<h2>🔁 Nouveau mot de passe</h2>

<form method="post">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    
    <label for="new_password">Nouveau mot de passe :</label><br>
    <input type="password" name="new_password" required><br><br>

    <button type="submit">Changer</button>
</form>

<p><?= $message ?></p>

<?php include __DIR__ . '/../partials/footer.php'; ?>
