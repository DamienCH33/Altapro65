<?php include_once 'header.php'?>

<section class="banner">
  <?php if (isset($_GET['contact-success']) && !empty($_GET['contact-success'])) { ?>
      Message envoyé avec succès.
  <?php } ?>
  <div class="banner-content">
    <h1>Bienvenue chez Alta Pro 65</h1>
    <p>Découvrez nos services.</p>
    <a href="service.php" class="cta-button">Explorer</a>
  </div>
</section>

<section class="presentation">
  <div class="presentation-text">
    <h2>Présentation de notre entreprise :</h2>
    <p> Alta pro 65 est une entreprise à taille humaine spécialisée dans d’élagage, le démontage et l’abattage d’arbres dangereux inaccessibles aux engins :</p>
    
    <div class="presentation-items">
      <div class="presentation-item">
        <i class="fa fa-cogs"></i>
        <h3>Savoir faire</h3>
        <p>Riche d’une expérience de 20 ans dans l’activité, nous traitons les chantiers avec professionnalisme et rigueur.</p>
      </div>
      <div class="presentation-item">
        <i class="fa fa-users"></i>
        <h3>Expertise</h3>
        <p>Nous privilégions les tailles douces et raisonnées et les tailles de sécurité sans dégrader l’état sanitaire des arbres.</p>
        <p>Nous valorisons également les déchets en broyant et en fendant le bois pour votre chauffage.</p>
      </div>
      <div class="presentation-item">
        <i class="fa fa-thumbs-up"></i>
        <h3>Satisfaction</h3>
        <p>La satisfaction de nos clients est notre priorité, et nous nous engageons à offrir un service irréprochable.</p>
      </div>
    </div>
  </div>

  <div class="presentation-photo">
    <img src="/WWW/Ressources/Images/Image-1.jpg" alt="Photo de l'entreprise">
  </div>
</section>


<script src="/WWW/Ressources/script.js"></script>

<?php include_once 'footer.php'?>