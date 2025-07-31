<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="img">
    <img src="assets/images/blogs1.jpg" alt="">
</div>

<h2>📝 Ajouter un article</h2>

<?php if ($success): ?>
    <p style="color:green;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Titre de l'article" value="<?= htmlspecialchars($title) ?>" required><br><br>
    
    <textarea name="content" placeholder="Contenu de l'article" rows="10" cols="50" required><?= htmlspecialchars($content) ?></textarea><br><br>
    
    <input type="file" name="image" accept="image/*"><br><br>
    
    <button type="submit">Publier</button>
</form>

<?php include __DIR__ . '/../partials/footer.php'; ?>
