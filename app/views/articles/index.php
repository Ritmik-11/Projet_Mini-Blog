<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="img">
    <img src="assets/images/article.jpg" alt="">
</div>

<h2>📂 Tableau de bord – Articles</h2>

<a href="index.php?controller=articles&action=add">➕ Ajouter un nouvel article</a>
<br><br>

<?php if (empty($articles)): ?>
    <p>Aucun article publié.</p>
<?php else: ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $article['id']; ?></td>
                <td><?= htmlspecialchars($article['title']); ?></td>
                <td><?= htmlspecialchars($article['username']); ?></td>
                <td><?= date('d/m/Y H:i', strtotime($article['created_at'])); ?></td>
                <td>
                    <a href="index.php?controller=articles&action=edit&id=<?= $article['id']; ?>">✏️ Modifier</a> | 
                    <a href="index.php?controller=articles&action=delete&id=<?= $article['id']; ?>" onclick="return confirm('Supprimer cet article ?')">🗑️ Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php include __DIR__ . '/../partials/footer.php'; ?>
