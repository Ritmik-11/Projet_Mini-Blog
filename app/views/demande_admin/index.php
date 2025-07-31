<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="profile-container">
    <h2>🔑 Demande pour devenir administrateur</h2>

    <?php if (!empty($message)): ?>
        <p style="color: green"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Pourquoi veux-tu devenir admin ?</label><br>
        <textarea name="reason" rows="5" cols="50" required></textarea><br>
        <button type="submit">Envoyer la demande</button>
    </form>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
