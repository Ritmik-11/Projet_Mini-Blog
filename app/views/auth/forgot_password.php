<?php include __DIR__ . '/../partials/header.php'; ?>

<h2>🔐 Mot de passe oublié ?</h2>

<form method="post">
    <label for="email">Votre adresse email :</label><br>
    <input type="email" name="email" id="email" required><br><br>
    <button type="submit">Réinitialiser</button>
</form>

<?php if (!empty($message)): ?>
    <p><?= $message ?></p>
<?php endif; ?>

<?php include __DIR__ . '/../partials/footer.php'; ?>
