<?php
require_once __DIR__ . "/../Tools/tools_comment.php";

class CommentController {
    private $commentModel;
    
    public function __construct() {
        $this->commentModel = new Comment();
    }

    public function submitComment() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $commentText = $_POST['comment-text'];
            $rating = isset ($_POST['rating'])?$_POST['rating']:NULL;

            if (!empty($commentText) && !empty($rating)) {
                $this->commentModel->addComment($commentText, $rating);
                echo json_encode(["message" => "Commentaire ajouté avec succès !"]);
            } else {
                echo json_encode(["error" => "Tous les champs sont requis."]);
            }
        }
    }

    public function fetchComments() {
        $comments = $this->commentModel->getComments();
        echo json_encode($comments);
    }
    
    public function deleteComment() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
            if ($this->commentModel->deleteComment($_POST["id"])) {
                echo json_encode(["message" => "Commentaire supprimé avec succès."]);
            } else {
                echo json_encode(["error" => "Erreur lors de la suppression."]);
            }
        }
    }
}

