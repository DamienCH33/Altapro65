<?php
require_once __DIR__ . "/../config/database.php";

class Comment {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function addComment($commentText, $rating) {
        $stmt = $this->db->prepare("INSERT INTO comments (comment_text, rating) VALUES (:comment_text, :rating)");
        $stmt->execute([
            ':comment_text' => $commentText,
            ':rating' => $rating
        ]);
    }

    public function getComments() {
        $stmt = $this->db->query("SELECT * FROM comments ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteComment($id) {
        $stmt = $this->db->prepare("DELETE FROM comments WHERE id = :id");
        return $stmt->execute([":id" => $id]);
    }
}
