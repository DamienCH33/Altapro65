<?php include_once 'header.php' ?>
<?php
include_once '../config/database.php';

// Suppression d'un commentaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment_id'])) {
    $commentId = intval($_POST['delete_comment_id']);
    $db = Database::connect();

    $stmt = $db->prepare("DELETE FROM comments WHERE id = :id");
    $stmt->execute([':id' => $commentId]);

    // Redirection pour éviter la modale qui se réouvre après un F5
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

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
    <div class="comment-form">
        <h3>Laissez un commentaire</h3>
        <form action="/comment_soumission.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <input type="text" name="nom" placeholder="Renseignez votre nom" required autocomplete="off">
            <input type="text" name="prenom" placeholder="Renseignez votre prénom" required autocomplete="off">
            <textarea id="comment-text" placeholder="Votre commentaire" name="comment" required autocomplete="off"></textarea>
            <label for="rating">Indiquez votre satisfaction :</label>
            <input type="hidden" id="selected-rating" name="rating" />
            <div class="stars" id="rating" min="1" max="5">
                <span class="star" data-value="1">&#9733;</span>
                <span class="star" data-value="2">&#9733;</span>
                <span class="star" data-value="3">&#9733;</span>
                <span class="star" data-value="4">&#9733;</span>
                <span class="star" data-value="5">&#9733;</span>
            </div>
            <div style="position: absolute; left: -9999px;">
                <label for="honeypot">Ne pas remplir ce champ</label>
                <input type="text" name="honeypot" id="honeypot" autocomplete="off" tabindex="-1">
            </div>
            <input type="hidden" name="timestamp" value="<?= time(); ?>">
            <button type="submit">Envoyer</button>
        </form>
    </div>
</section>

<!-- Modal d'erreur -->
<div id="errorModal" class="modal hidden">
    <div class="modal-content">
        <span class="close" id="closeErrorModal">&times;</span>
        <p id="errorMessage">Tous les champs sont obligatoires, y compris la notation !</p>
    </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const errorModal = document.getElementById('errorModal');
    const closeErrorModal = document.getElementById('closeErrorModal');
    
    // Fonction pour ouvrir la modale
    function openErrorModal(message) {
        document.getElementById('errorMessage').textContent = message;
        errorModal.classList.remove('hidden');
    }

    // Fonction pour fermer la modale
    closeErrorModal.addEventListener('click', function() {
        errorModal.classList.add('hidden');
    });
    
    // Ajouter un événement de fermeture si on clique en dehors de la modale
    window.addEventListener('click', function(event) {
        if (event.target === errorModal) {
            errorModal.classList.add('hidden');
        }
    });
});
  
</script>

<section>
    <div class="comments-list" id="comments-list">
        <h3>Commentaires récents</h3><br>
        <?php
        $sql = "SELECT * FROM comments ORDER BY created_at DESC";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $comments = $stmt->fetchAll();

        if (!empty($comments)) {
            foreach ($comments as $comment) {
                $createdAtTimestamp = strtotime($comment['created_at']);
                $timeDifference = time() - $createdAtTimestamp;
                $isRecentComment = $timeDifference <= 120;
        ?>
                <div class="comment" data-created-at="<?= strtotime($comment['created_at']) ?>">
                    <div>
                        <strong><?= htmlspecialchars($comment['prenom']) . " " . htmlspecialchars($comment['nom']) ?></strong> :
                        <?= nl2br(htmlspecialchars($comment['comment'])) ?>
                    </div>
                    <div style="margin: 5px 0;">Avis :
                        <div class="rating" style="display: inline-block;">
                            <?php
                            $rating = (int) $comment['rating'];
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $rating ? '★' : '☆';
                            }
                            ?>
                        </div>
                    </div>
                    <div style="font-size: 0.9em; color: gray;">
                        Posté le <?= date('d/m/Y à H:i', $createdAtTimestamp) ?>
                    </div>
                    <?php if ($isRecentComment) { ?>
                        <form method="POST" onsubmit="return false;" style="margin-top: 5px;">
                            <input type="hidden" name="delete_comment_id" value="<?= $comment['id'] ?>">
                            <button type="button" class="btn-supprimer" data-id="<?= $comment['id'] ?>">Supprimer</button>
                        </form>
                    <?php } ?>
                </div>
        <?php }
        } else {
            echo "Il n'y a pas de commentaire";
        }
        ?>
    </div>
</section>

<div id="modal" class="modal hidden">
    <div class="modal-content">
        <p>Voulez-vous vraiment supprimer ce commentaire ?</p>
        <form method="POST">
            <input type="hidden" name="delete_comment_id" id="modal-comment-id">
            <button type="submit" class="btn btn-confirm">Oui, supprimer</button>
            <button type="button" class="btn btn-cancel" onclick="closeModal()">Annuler</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM ready');

    // Ferme la modale (même après F5)
    closeModal();
    sessionStorage.removeItem('modalOpen');

    // Gestion ouverture modale
    document.querySelectorAll('.btn-supprimer').forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.getAttribute('data-id');
            const modal = document.getElementById('modal');
            if (modal && commentId) {
                document.getElementById('modal-comment-id').value = commentId;
                modal.classList.remove('hidden');
                sessionStorage.setItem('modalOpen', 'true');
                console.log('Modale ouverte pour commentaire ID:', commentId);
            }
        });
    });

    // Supprimer bouton après 2 minutes
    const now = Date.now() / 1000;
    document.querySelectorAll('[data-created-at]').forEach(comment => {
        const createdAt = parseInt(comment.getAttribute('data-created-at'), 10);
        const timeDiff = now - createdAt;
        const deleteButton = comment.querySelector('.btn-supprimer');

        if (deleteButton) {
            if (timeDiff >= 120) {
                console.log('Masquage immédiat bouton');
                deleteButton.style.display = 'none';
            } else {
                const timeout = (120 - timeDiff) * 1000;
                console.log(`Masquage dans ${timeout} ms`);
                setTimeout(() => {
                    deleteButton.style.display = 'none';
                }, timeout);
            }
        }
    });
});

function closeModal() {
    const modal = document.getElementById('modal');
    if (modal) {
        modal.classList.add('hidden');
        console.log('Modale fermée');
    }
}
</script>


<script src="/WWW/Ressources/script.js"></script>
<?php include_once 'footer.php' ?>
