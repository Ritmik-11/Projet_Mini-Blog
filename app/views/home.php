<?php include 'partials/header.php'; ?>

<div class="img">
    <img src="assets/images/blogs2.jpg" alt="">
</div>

<link rel="stylesheet" href="assets/css/style.css">

<form method="get" action="index.php?controller=search&action=results">
    <input type="text" name="q" placeholder="Rechercher un article...">
    <button type="submit">RECHERCHER 🔍</button>
</form>

<h2>📚 Articles récents</h2>

<?php if (count($articles) === 0): ?>
    <p>Aucun article publié pour le moment.</p>
<?php else: ?>
    <?php foreach ($articles as $article): ?>
        <div class="article_titre" style="border:1px solid #ccc; padding:10px; margin:10px 0; box-shadow:0px 0px 2px black;">
            <h3>
                <a href="index.php?controller=article&action=show&id=<?= $article['id'] ?>">
                    <?= htmlspecialchars($article['title']); ?>
                </a>
            </h3>
            <?php if (!empty($article['image'])): ?>
                <img src="assets/images/<?= htmlspecialchars($article['image']); ?>" alt="Image article" style="max-width: 300px; height: auto; border: 1px solid black;">
            <?php endif; ?>
            <p>✍️ Écrit par <strong><?= htmlspecialchars($article['username']); ?></strong> | 🕒 Le <?= date('d/m/Y à H:i', strtotime($article['created_at'])); ?></p>
            <p><?= nl2br(substr(htmlspecialchars($article['content']), 0, 150)); ?>...</p>
            <a href="index.php?controller=article&action=show&id=<?= $article['id'] ?>">
Lire la suite →</a><br>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php include 'partials/footer.php'; ?>
