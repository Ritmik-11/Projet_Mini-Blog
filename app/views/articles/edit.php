<?php include __DIR__ . '/../partials/header.php'; ?>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <p style="color:green;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<?php if (isset($article) || (!empty($title) && !empty($content))): ?>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required><br><br>
    <textarea name="content" rows="10" cols="50" required><?= htmlspecialchars($content) ?></textarea><br><br>
    
    <?php if (!empty($currentImage)): ?>
        <img src="assets/images/<?= htmlspecialchars($currentImage) ?>" style="max-width:200px;"><br>
    <?php endif; ?>
    
    <input type="file" name="image" accept="image/*"><br><br>
    <button type="submit">Mettre à jour</button>
</form>
<?php endif; ?>

<?php include __DIR__ . '/../partials/footer.php'; ?>
