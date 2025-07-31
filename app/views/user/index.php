<?php include 'header.php'; ?>

<h2>👥 Gestion des utilisateurs</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nom d'utilisateur</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= $u['role'] ?></td>
            <td><?= $u['blocked'] ? '❌ Bloqué' : '✅ Actif' ?></td>
            <td>
                <a href="?page=users&view_articles=1&id=<?= $u['id'] ?>">📄 Articles</a> |
                <?php if ($u['id'] != $_SESSION['user_id']): ?>
                    <a href="?page=users&toggle_block=1&id=<?= $u['id'] ?>" onclick="return confirm('Changer le statut ?')">
                        <?= $u['blocked'] ? '🔓 Débloquer' : '🔒 Bloquer' ?>
                    </a> |
                    <a href="?page=users&toggle_role=1&id=<?= $u['id'] ?>" onclick="return confirm('Changer le rôle ?')">
                        <?= $u['role'] === 'admin' ? '↩ Rétrograder' : '🚀 Promouvoir' ?>
                    </a> |
                    <a href="?page=users&delete_user=1&id=<?= $u['id'] ?>" style="color:red" onclick="return confirm('Supprimer ?')">🗑 Supprimer</a>
                <?php else: ?>
                    🔐 (vous)
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php if ($articles): ?>
    <h3>📚 Articles publiés</h3>
    <ul>
        <?php foreach ($articles as $a): ?>
            <li><strong><?= htmlspecialchars($a['title']) ?></strong> (<?= date('d/m/Y', strtotime($a['created_at'])) ?>)</li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php include 'footer.php'; ?>
