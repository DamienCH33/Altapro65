<?php
require_once __DIR__ . "/../Altapro65/config/database.php";

class Contact {
    public static function save($data) {
        $pdo = Database::connect();
        $sql = "INSERT INTO contacts (nom, prenom, email, phone, message, photo, consentement) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $data["nom"],
            $data["prenom"],
            $data["email"],
            $data["phone"],
            $data["message"],
            $data["photo"],
            $data["consentement"]
        ]);
    }
}
?>
