<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="img">
    <img src="images/inscrit4.jpg" alt="">
</div>

<h2>Créer un compte</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required value="<?= $_POST['username'] ?? '' ?>"><br>
    <input type="email" name="email" placeholder="Adresse email" required value="<?= $_POST['email'] ?? '' ?>"><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required><br>
    <button type="submit">S'inscrire</button>
</form>

<?php include __DIR__ . '/../partials/footer.php'; ?>
