<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="search-results">
    <h2>Résultats pour : "<?= htmlspecialchars($query) ?>"</h2>

    <?php if (count($results) === 0): ?>
        <p>Aucun article trouvé.</p>
    <?php else: ?>
        <?php foreach ($results as $article): ?>
            <?php if (!empty($article['image'])): ?>
                <img src="assets/images/<?= htmlspecialchars($article['image']) ?>" alt="Image article" style="max-width: 100%; height: auto;">
            <?php endif; ?>
            <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
                <h3>
                    <a href="index.php?controller=article&action=show&id=<?= $article['id'] ?>">
                        <?= htmlspecialchars($article['title']) ?>
                    </a>
                </h3>
                <p>✍️ Par <?= htmlspecialchars($article['username']) ?> | 🕒 Le <?= date('d/m/Y à H:i', strtotime($article['created_at'])) ?></p>
                <p><?= nl2br(substr(htmlspecialchars($article['content']), 0, 150)) ?>...</p>
                <a href="index.php?controller=article&action=show&id=<?= $article['id'] ?>">Lire la suite →</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
