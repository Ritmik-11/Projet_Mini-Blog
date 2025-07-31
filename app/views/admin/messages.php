<?php include __DIR__ . '/../partials/header.php'; ?>

<h2>📥 Messages reçus</h2>

<?php if (empty($messages)): ?>
    <p>Aucun message.</p>
<?php else: ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
        <?php foreach ($messages as $msg): ?>
            <tr>
                <td><?= htmlspecialchars($msg["name"]) ?></td>
                <td><?= htmlspecialchars($msg["email"]) ?></td>
                <td><?= nl2br(htmlspecialchars($msg["message"])) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($msg["created_at"])) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php include __DIR__ . '/../partials/footer.php'; ?>
