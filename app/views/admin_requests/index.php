<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="dashboard-container">
    <h2>📩 Demandes d’administration</h2>

    <?php foreach ($requests as $req): ?>
        <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
            <p><strong>Utilisateur :</strong> <?= htmlspecialchars($req['username']) ?></p>
            <p><strong>Raison :</strong> <?= nl2br(htmlspecialchars($req['reason'])) ?></p>
            <p><strong>Status :</strong> <?= $req['status'] ?></p>
            <?php if ($req['status'] === 'en attente'): ?>
                <a href="?action=approuver&id=<?= $req['id'] ?>">✅ Approuver</a> |
                <a href="?action=refuser&id=<?= $req['id'] ?>">❌ Refuser</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
