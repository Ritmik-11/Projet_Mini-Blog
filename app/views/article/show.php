<?php include __DIR__ . '/../partials/header.php'; ?>

<?php if (isset($error)): ?>
    <p><?= htmlspecialchars($error) ?></p>
<?php else: ?>
    <article>
        <h2><?= htmlspecialchars($article["title"]) ?></h2>
        <p>✍️ Par <strong><?= htmlspecialchars($article["username"]) ?></strong></p>
        <p>🕒 Publié le <?= date('d/m/Y à H:i', strtotime($article["created_at"])) ?></p>
        <hr>
        <?php if (!empty($article["image"])): ?>
            <img src="assets/images/<?= htmlspecialchars($article["image"]) ?>" alt="Image de l'article" style="max-width:100%; height:auto;"><br><br>
        <?php endif; ?>
        <p><?= nl2br(htmlspecialchars($article["content"])) ?></p>
    </article>
<?php endif; ?>

<?php include __DIR__ . '/../partials/footer.php'; ?>
