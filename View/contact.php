<?php include_once 'header.php'; ?>

<section class="container my-4">
  <div class="container_form p-4">
    <h2>Contactez-nous</h2>
    <form action="/contact_soumission.php" method="POST" enctype="multipart/form-data" autocomplete="off">
      <input type="text" name="fakeusernameremembered" style="display:none;" autocomplete="off">
      <div class="form-group">
        <input type="text" name="nom_user" class="form-control" placeholder="Renseignez votre nom" required autocomplete="nope">
      </div>
      <div class="form-group">
        <input type="text" name="prenom_user" class="form-control" placeholder="Renseignez votre prénom" required autocomplete="nope">
      </div>
      <div class="form-group">
        <input type="email" name="email_user" class="form-control" placeholder="Renseignez votre email" required autocomplete="new-email">
      </div>
      <div class="form-group">
        <input type="tel" name="phone_user" class="form-control" placeholder="Renseignez votre numéro de téléphone" required autocomplete="nope">
      </div>
      <div class="form-group">
        <textarea name="message" class="form-control" rows="5" placeholder="Votre message" required autocomplete="off"></textarea>
      </div>
      <div class="file-wrapper form-group">
        <input type="file" name="photo" id="photoInput" accept="image/*" class="form-control">
        <button type="button" id="removeFile" style="display: none;" class="btn btn-danger">Supprimer le fichier</button>
      </div>
      <script>
        const photoInput = document.getElementById('photoInput');
        const removeFileButton = document.getElementById('removeFile');
        photoInput.addEventListener('change', function() {
          if (photoInput.files.length > 0) {
            removeFileButton.style.display = 'inline';
          } else {
            removeFileButton.style.display = 'none';
          }
        });
        removeFileButton.addEventListener('click', function() {
          photoInput.value = '';
          removeFileButton.style.display = 'none';
        });
      </script>

      <div class="checkbox-container form-group d-flex align-items-center">
        <input type="checkbox" name="consentement" required>
        <label for="consentement">J'accepte que mes données soient utilisées conformément à la RGPD.</label>
      </div>

      <!-- Honeypot (Champ invisible pour les bots) -->
      <div style="position: absolute; left: -9999px;">
        <label for="honeypot">Ne pas remplir ce champ</label>
        <input type="text" name="honeypot" id="honeypot" autocomplete="off" tabindex="-1">
      </div>

      <!-- Délai minimum caché -->
      <input type="hidden" name="timestamp" value="<?= time(); ?>">
      <button type="submit" class="btn btn-custom-primary btn-block">Envoyer</button>
    </form>
  </div>
</section>

<section class="container my-4">
  <div class="container_info p-4">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2643.5177170557217!2d0.12829879230678698!3d43.109607900832515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a82de9d64375ad%3A0xeb5c91f2af4c4e68!2s11%20Rue%20du%20Moulin%2C%2065200%20Ordizan!5e1!3m2!1sfr!2sfr!4v1744207924773!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    <div class="contact-info">
      <p>
          <strong>Adresse :</strong>
          11 rue du moulin, 65200 ORDIZAN, France
      </p>
      <p>
          <strong>Téléphone :</strong>
          <a href="tel:+33650088065">+33 6 50 08 80 65</a>
      </p>
      <p>
          <strong>Email :</strong>
          <a href="mailto:sebgautier33@gmail.com">sebgautier33@gmail.com</a>
      </p>
    </div>
  </div>

</section>

<?php include_once 'footer.php'; ?>