<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="img">
    <img src="/images/contact2.jpg" alt="">
</div>

<div class="contact-form">
    <h2>📨 Contacte-nous</h2>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" class="contact-form">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="message">Message :</label>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>
        
        <button type="submit">Envoyer</button>
    </form>

    <?php if (!empty($success)): ?>
        <script>
            const toast = document.getElementById('toast');
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        </script>
    <?php endif; ?>
    
    <div id="toast" class="toast">
        <p>Message envoyé avec succès ! 🎉</p>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
