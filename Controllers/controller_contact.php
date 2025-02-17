<?php
require_once __DIR__ . "/../Tools/tools_contact.php";

class ContactController {
    public function submitForm() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom = htmlspecialchars($_POST["nom"]);
            $prenom = htmlspecialchars($_POST["prenom"]);
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            $phone = htmlspecialchars($_POST["phone"]);
            $message = htmlspecialchars($_POST["message"]);
            $consentement = isset($_POST["consentement"]) ? 1 : 0;

            // fichier uploadé
            $photo = null;
            if (!empty($_FILES["photo"]["name"])) {
                $target_dir = __DIR__ . "/../uploads/";
                if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
                $photo = basename($_FILES["photo"]["name"]);
                move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir . $photo);
            }

            // Sauvegarde des données
            $success = Contact::save([
                "nom" => $nom,
                "prenom" => $prenom,
                "email" => $email,
                "phone" => $phone,
                "message" => $message,
                "photo" => $photo,
                "consentement" => $consentement
            ]);

            if ($success) {
                header("Location: /index.php?page=success");
                exit();
            }
        }
    }
}
?>
