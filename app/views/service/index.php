<?php include 'views/layout/header.php'; ?>

<div class="img">
    <img src="images/service5.jpg" alt="">
</div>

<h2>🎯 Nos Services</h2>
<p>Découvrez les services que nous proposons pour répondre à vos besoins.</p>

<div class="services-container">
    <div class="service-item">
        <h3>🔒 Sécurité Informatique</h3>
        <p>Nous offrons des services de cybersécurité pour protéger vos systèmes et données sensibles contre les menaces externes.</p>
    </div>
    <div class="service-item">
        <h3>💻 Développement Web</h3>
        <p>Création de sites web professionnels, optimisés et responsive, adaptés à vos besoins spécifiques.</p>
    </div>
    <div class="service-item">
        <h3>📱 Application Mobile</h3>
        <p>Développement d'applications mobiles pour iOS et Android afin de toucher un plus large public.</p>
    </div>
</div>

<h2>Vente de PC dernière génération</h2>
<div class="services-container">
    <!-- Tes PC ici -->
    <div class="service-item">
        <img src="images/pc3.jpeg" alt="">
        <h2>Prix: 3799$</h2>
        <p>PC Portable Asus Gaming TUF565GM-AL371T 15.6" FHD IPS Intel Core i5-8300H 8 Go RAM 128 </p>
    </div>
    <!-- Les autres blocs PC... -->
</div>

<h3>📩 Demande de Service</h3>
<form method="post" class="service-form">
    <label for="service_name">Nom du service :</label>
    <select name="service_name" id="service_name">
        <option value="cybersecurity">Sécurité Informatique</option>
        <option value="web_dev">Développement Web</option>
        <option value="mobile_app">Application Mobile</option>
    </select><br><br>

    <label for="details">Détails de votre demande :</label>
    <textarea name="details" id="details" rows="4" required></textarea><br><br>

    <button type="submit">Envoyer la demande</button>
</form>

<?php include 'views/layout/footer.php'; ?>
