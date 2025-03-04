<?php include_once 'header.php'?>

<section class="real_slider">

    <div class="slider">

        <div class="wrapper">

            <div class="swiper-slide" style="background: url(/WWW/Ressources/Images/Image-3test.jpg) no-repeat">

                <div class="content">
                    <span>Lorem ipsum dolor sit amet.</span>
                    <h3>Lorem ipsum dolor sit amet.</h3>
                    <a href="" class="btn">Plus de découverte</a>
                </div>           
            </div>

            <div class="swiper-slide" style="background: url(/WWW/Ressources/Images/banniere-foret-montagne.avif) no-repeat">

                <div class="content">
                    <span>Lorem ipsum dolor sit amet.</span>
                    <h3>Lorem ipsum dolor sit amet.</h3>
                     <a href="" class="btn">Plus de découverte</a>
                </div>           
            </div>

            <div class="swiper-slide" style="background: url(/WWW/Ressources/Images/Image-3.jpg) no-repeat">

                <div class="content">
                    <span>Lorem ipsum dolor sit amet.</span>
                    <h3>Lorem ipsum dolor sit amet.</h3>
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
        <form action="/comment_soumission.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nom" placeholder="Renseignez votre nom" required>
         <input type="text" name="prenom" placeholder="Renseignez votre prénom" required>
            <textarea id="comment-text" placeholder="Votre commentaire" name="comment" required></textarea>

        <label for="rating">Indiquez votre satisfaction :</label>
        <input type="hidden" id="selected-rating" name="rating"/>
        <div class="stars" id="rating" min="1" max="5">
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
      <h3>Commentaires récents</h3><br>
     
       <?php 

    $sql = "SELECT  * FROM comments order by created_at desc";
    $db = Database::connect();
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $comments = $stmt->fetchAll();
    if (!empty($comments)) {
        foreach ($comments as $comment) { ?>
            <div class="comment">
                <div>
                    <?= htmlspecialchars($comment['nom'] . " " . $comment['prenom']) . " : " . htmlspecialchars($comment['comment']) ?>
                </div>    
                <div>Avis : 
                <div class="rating">
                <?php 
                    $rating = (int) $comment['rating'];
                    for ($i = 1; $i <= 5; $i++) {
                        echo $i <= $rating ? '★' : '☆'; 
                    }
                ?>
            </div>
        </div>
            </div>
        <?php }
    } else {
        echo "Il n'y a pas de commentaire";
    } ?>
    </div>
</section>



<script src="/WWW/Ressources/script.js"></script>
<?php include_once 'footer.php'?>