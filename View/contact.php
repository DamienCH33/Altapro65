<?php include_once 'header.php'?>

<section class="container">
    <div class="container_form">
        <h2>Contactez-nous</h2>
        <form action="/contact_soumission.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <!-- Champ fantôme pour éviter l'autocomplétion -->
            <input type="text" name="fakeusernameremembered" style="display:none;" autocomplete="off">

            <input type="text" name="nom_user" placeholder="Renseignez votre nom" required autocomplete="nope">
            <input type="text" name="prenom_user" placeholder="Renseignez votre prénom" required autocomplete="nope">
            <input type="email" name="email_user" placeholder="Renseignez votre email" required autocomplete="new-email">
            <input type="tel" name="phone_user" placeholder="Renseignez votre numéro de téléphone" required autocomplete="nope">
            <textarea name="message" rows="5" placeholder="Votre message" required autocomplete="off"></textarea>
            <input type="file" name="photo" accept="image/*">

            <div class="checkbox-container">
                <input type="checkbox" name="consentement" required>
                <label for="consentement">J'accepte que mes données soient utilisées conformément à la RGPD.</label>
            </div>

            <!-- Honeypot (Champ invisible pour les bots) -->
            <input type="text" name="ref_code" style="display:none;" autocomplete="off">

            <!-- Délai minimum caché -->
            <input type="hidden" name="timestamp" value="<?= time(); ?>">

            <button type="submit">Envoyer</button>
        </form>

    </div>
</section>
<section class="container">
    <div class="container_info">
        <div class="info">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2635.8938488188237!2d0.12830987562705184!3d43.10961048741959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a82de9d64375ad%3A0xeb5c91f2af4c4e68!2s11%20Rue%20du%20Moulin%2C%2065200%20Ordizan!5e1!3m2!1sfr!2sfr!4v1739447740324!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p><strong>Adresse :</strong> 11 rue du moulin, 65200 ORDIZAN, France</p>
            <p><strong>Téléphone :</strong> +33 6 50 08 80 65</p>
            <p><strong>Email :</strong> sebgautier33@gmail.com</p>
        </div>
    </div>
</section>



<?php include_once 'footer.php'?>