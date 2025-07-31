<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="img">
    <img src="images/connect6.jpeg" alt="">
</div>

<h2>Connecte-toi</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <label for="username">Nom d'utilisateur :</label><br>
    <input type="text" id="username" name="username" required value="<?= $_POST['username'] ?? '' ?>"><br><br>

    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">Se connecter</button>
    <p><a href="index.php?controller=auth&action=forgotPassword">Mot de passe oublié ?</a></p>
</form>

<?php include __DIR__ . '/../partials/footer.php'; ?>
