<?php
session_start();

include_once 'header.php';
include_once '../config/database.php';

// Paramètres pour la pagination
$commentsPerPage = 5;
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($currentPage - 1) * $commentsPerPage;

// Suppression d'un commentaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment_id'])) {
    $commentId = intval($_POST['delete_comment_id']);
    $db = Database::connect();

    $stmt = $db->prepare("DELETE FROM comments WHERE id = :id");
    $stmt->execute([':id' => $commentId]);

    // Redirection
    header("Location: realisation.php");
    exit();
}

// Calcul du nombre total de commentaires
$db = Database::connect();
$sql = "SELECT COUNT(*) FROM comments";
$stmt = $db->prepare($sql);
$stmt->execute();
$totalComments = $stmt->fetchColumn();
$totalPages = ceil($totalComments / $commentsPerPage); // Calcul du nombre total de pages

// Récupérer les commentaires pour la page actuelle
$sql = "SELECT * FROM comments ORDER BY created_at DESC LIMIT :offset, :limit";
$stmt = $db->prepare($sql);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $commentsPerPage, PDO::PARAM_INT);
$stmt->execute();
$comments = $stmt->fetchAll();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col realisation-slider mx-4 px-0">
            <section class="real_slider">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide rounded" style="background: url('/Ressources/Images/Image-3test.jpg') no-repeat center center; background-size: cover;">
                            <div class="content text-center text-white">
                                <span>Lorem ipsum dolor sit amet.</span>
                                <h3>Lorem ipsum dolor sit amet.</h3>
                                <a href="#" class="btn btn-success">Plus de découverte</a>
                            </div>
                        </div>
                        <div class="swiper-slide rounded" style="background: url('/Ressources/Images/banniere-foret-montagne.avif') no-repeat center center; background-size: cover;">
                            <div class="content text-center text-white">
                                <span>Lorem ipsum dolor sit amet.</span>
                                <h3>Lorem ipsum dolor sit amet.</h3>
                                <a href="#" class="btn btn-success">Plus de découverte</a>
                            </div>
                        </div>
                        <div class="swiper-slide rounded" style="background: url('/Ressources/Images/Image-3.jpg') no-repeat center center; background-size: cover;">
                            <div class="content text-center text-white">
                                <span>Lorem ipsum dolor sit amet.</span>
                                <h3>Lorem ipsum dolor sit amet.</h3>
                                <a href="#" class="btn btn-success">Plus de découverte</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </section>
        </div>
    </div>
</div>

<section class="gallery py-5">
    <div class="container text-center">
        <h2>Galerie photos</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="image-item">
                    <img src="/Ressources/Images/Image-7.jpg" alt="Réalisations 1" class="gallery-image img-fluid">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="image-item">
                    <img src="/Ressources/Images/Image-9.jpg" alt="Réalisations 2" class="gallery-image img-fluid">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="image-item">
                    <img src="/Ressources/Images/Image-10.jpg" alt="Réalisations 3" class="gallery-image img-fluid">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="image-item">
                    <img src="/Ressources/Images/Image-13.jpg" alt="Réalisations 4" class="gallery-image img-fluid">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="image-item">
                    <img src="/Ressources/Images/Image-2.jpg" alt="Réalisations 5" class="gallery-image img-fluid">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="image-item">
                    <img src="/Ressources/Images/Image-3.jpg" alt="Réalisations 6" class="gallery-image img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal" id="imageModal" style="display: none">
    <span class="close" id="closeModal">&times;</span>
    <img class="modal-content" id="modalImage" />
</div>

<section class="video-wrapper py-5">
    <div class="container text-center">
        <h2>Nos Réalisations en vidéo</h2>
        <div class="video-container">
            <video id="video" src="/Ressources/Images/Video elagage.MP4" controls class="img-fluid"></video>
        </div>
    </div>
</section>

<section class="comments py-5">
    <div class="container">
        <h2>Commentaires</h2>
        <div class="comment-form mb-4">
            <h3>Laissez un commentaire</h3>
            <form action="/comment_soumission.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input type="text" name="nom" class="form-control mb-2" placeholder="Renseignez votre nom" required autocomplete="off">
                <input type="text" name="prenom" class="form-control mb-2" placeholder="Renseignez votre prénom" required autocomplete="off">
                <textarea id="comment-text" class="form-control mb-2" placeholder="Votre commentaire" name="comment" required autocomplete="off"></textarea>
                <label for="rating">Indiquez votre satisfaction :</label>
                <input type="hidden" id="selected-rating" name="rating" />
                <div class="stars" id="rating">
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
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
            <?php if (isset($_SESSION['error_message'])) { ?>
            <em class="text-danger"><?= $_SESSION['error_message'] ?></em>
            <?php 
                unset($_SESSION['error_message']);
            } ?>
        </div>
    </div>
</section>

<section class="comments-list py-5">
    <div class="container">
       <h3>Commentaires récents</h3>
       <div class="comment-container pe-2">
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
                            <button type="button" class="btn btn-danger btn-sm" data-id="<?= $comment['id'] ?>">Supprimer</button>
                        </form>
                    <?php } ?>
                </div>
        <?php }
        } else {
            echo "Il n'y a pas de commentaire";
        }
        ?>
        </div>
    </div>
</section>

<!-- Modal de confirmation de suppression -->
<div id="modal" class="modal hidden">
    <div class="modal-content">
        <p>Voulez-vous vraiment supprimer ce commentaire ?</p>
        <form method="POST">
            <input type="hidden" name="delete_comment_id" id="modal-comment-id">
            <button type="submit" class="btn btn-danger">Oui, supprimer</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
        </form>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-danger');
    const modal = document.getElementById('modal');
    const modalCommentIdInput = document.getElementById('modal-comment-id');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.getAttribute('data-id');
            modalCommentIdInput.value = commentId;
            modal.classList.remove('hidden');
        });
    });

    // Fonction pour fermer la modale
    function closeModal() {
        modal.classList.add('hidden');
    }

    // Fermer la modale en cliquant en dehors
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });
});
</script>

<script src="/Ressources/script.js"></script>
<?php include_once 'footer.php'; ?>
