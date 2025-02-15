<?php include_once 'header.php'?>

<section class="real_slider">

    <div class="slider">

        <div class="wrapper">

            <div class="swiper-slide" style="background: url(/WWW/Ressources/Images/Image-5test.jpeg.png) no-repeat">

                <div class="content">
                    <span>Exploration, découverte, voyager</span>
                    <h3>Voyager autour du monde</h3>
                    <a href="" class="btn">Plus de découverte</a>
                </div>           
            </div>

            <div class="swiper-slide" style="background: url(/WWW/Ressources/Images/banniere-foret-montagne.avif) no-repeat">

                <div class="content">
                    <span>Exploration, découverte, voyager</span>
                    <h3>Découvrez de nouveaux endroits</h3>
                     <a href="" class="btn">Plus de découverte</a>
                </div>           
            </div>

            <div class="swiper-slide" style="background: url(/WWW/Ressources/Images/Image-3.jpg) no-repeat">

                <div class="content">
                    <span>Exploration, découverte, voyager</span>
                    <h3>Faites en sorte que votre voyage en vaille la peine</h3>
                    <a href="" class="btn">Plus de découverte</a>
                </div>           
            </div>

        </div>
            <div class="button-next"></div>
            <div class="button-prev"></div>
    </div>

</section>

<section class="gallery">
    <h2>Galerie photos</h2>
    <div class="image-grid">
      <div class="image-item"><img src="/WWW/Ressources/Images/Image-7.jpg" alt="Réalisations 1" class="gallery-image"></div>
      <div class="image-item"><img src="/WWW/Ressources/Images/Image-9.jpg" alt="Réalisations 2" class="gallery-image"></div>
      <div class="image-item"><img src="/WWW/Ressources/Images/Image-10.jpg" alt="Réalisations 3" class="gallery-image"></div>
      <div class="image-item"><img src="/WWW/Ressources/Images/Image-13.jpg" alt="Réalisations 3" class="gallery-image"></div>
      <div class="image-item"><img src="/WWW/Ressources/Images/Image-2.jpg" alt="Réalisations 3" class="gallery-image"></div>
      <div class="image-item"><img src="/WWW/Ressources/Images/Image-3.jpg" alt="Réalisations 3" class="gallery-image"></div>
      <!-- Ajoutez plus d'images ici -->
    </div>
</section>

<div class="modal" id="imageModal">
    <span class="close" id="closeModal">&times;</span>
    <img class="modal-content" id="modalImage" />
</div>

<section>
    <div class="video-wrapper">
        <h2>Nos Réalisations en video</h2>
        <div class="video-container">
            <video id="video" src="/WWW/Ressources/Images/Video elagage.MP4" controls></video>
        </div>
    </div>
</section>

<section class="comments">
    <h2>Commentaires</h2>

    <!-- Formulaire de soumission de commentaire -->
    <div class="comment-form">
      <h3>Laissez un commentaire</h3>
      <form id="commentForm">
        <textarea id="comment-text" placeholder="Votre commentaire" name="comment-text" required></textarea>

        <label for="rating">Indiquez votre satisfaction :</label>
        <div class="stars" id="rating">
          <span class="star" data-value="1">&#9733;</span>
          <span class="star" data-value="2">&#9733;</span>
          <span class="star" data-value="3">&#9733;</span>
          <span class="star" data-value="4">&#9733;</span>
          <span class="star" data-value="5">&#9733;</span>
        </div>

        <button type="submit">Envoyer</button>
      </form>
    </div>
</section>
<section>
    <!-- Liste des commentaires -->
    <div class="comments-list" id="comments-list">
      <h3>Commentaires récents</h3>
      <!-- Les commentaires s'ajouteront ici dynamiquement -->
    </div>
</section>



<script src="/WWW/Ressources/script.js"></script>
<?php include_once 'footer.php'?>