<?php include __DIR__ . '/../partials/header.php'; ?>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <a href="index.php?controller=articles&action=index">⬅️ Retour à la liste</a>
<?php else: ?>
    <p>Suppression effectuée.</p>
    <a href="index.php?controller=articles&action=index">⬅️ Retour à la liste</a>
<?php endif; ?>

<?php include __DIR__ . '/../partials/footer.php'; ?>
