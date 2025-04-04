<?php
include_once '../config/database.php';

// Vérification du Honeypot
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (!empty($_POST['honeypot'])) {
        die('Erreur : formulaire soumis par un bot.');
    }

    // Vérification du délai minimum (10 secondes avant soumission)
    if (!isset($_POST['timestamp']) || time() - $_POST['timestamp'] < 10) {
        die("Soumission trop rapide !");
    }
}
$pdo = Database::connect();

$data = [];

// Vérification champs manquants
$requiredFields = ['nom_user', 'prenom_user', 'email_user', 'phone_user', 'message'];
$missingFields = [];

foreach ($requiredFields as $field) {
    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
        $missingFields[] = $field;
    }
}

if (!empty($missingFields)) {
    $missingFieldsStr = implode(', ', $missingFields);
    echo "Les champs suivants sont obligatoires : $missingFieldsStr.";
    exit;
}

// Vérification du format de l'email
if (isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "L'adresse email n'est pas valide.";
    exit;
}

foreach ($_POST as $cle => $valeur) {
    if (strpos($cle, '_user') !== false) {
        $cle = str_replace('_user', '', $cle);
    }
    if ($cle == 'nom') {
        $valeur = strtoupper($valeur);
    }
    if ($cle == 'prenom') {
        $valeur = ucwords(strtolower($valeur));
    }
    if ($cle == 'email') {
        $valeur = strtolower($valeur);
    }
    if ($cle == 'message') {
        $valeur = ucfirst($valeur);
    }
    if ('' !== $valeur) {
        $data[$cle] = $valeur;
    }
}

// Fonction de formatage du numéro de téléphone
function formatPhoneNumber($number)
{
    $number = preg_replace('/[^\d+]/', '', $number);

    if (substr($number, 0, 1) === '+' && strlen($number) > 1) {
        return $number; // Le numéro est valide si il commence par + et a plus de 1 caractère
    }

    if (strlen($number) == 10) {
        return substr($number, 0, 2) . ' ' . substr($number, 2, 2) . ' ' . substr($number, 4, 2) . ' ' . substr($number, 6, 2) . ' ' . substr($number, 8, 2);
    }
    return false;
}

// Traitement de l'upload de l'image
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $uploadDir = 'C:/wamp64/www/Projet_Altapro65/uploads/'; 
    $uploadFile = $uploadDir . preg_replace("/[^a-zA-Z0-9\._-]/", "_", basename($_FILES['photo']['name']));
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedTypes)) {
        die('Seuls les fichiers image sont autorisés.');
    }
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
        $data['photo'] = $uploadFile;
    } else {
        die('Erreur lors du téléchargement du fichier.');
    }
}


// Ajout de la date d'envoi date et heure actuelles
$data['date_envoi'] = date('Y-m-d H:i:s');

if (!empty($data)) {
    $parameters = [];
    foreach ($data as $cle => $valeur) {
        $parameters[':' . $cle] = $valeur;
    }

    $sql = "INSERT INTO contact (`" . implode('`, `', array_keys($data)) . "`) 
            VALUES (" . implode(", ", array_keys($parameters)) . ")";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($parameters);

    echo "Votre message a été ajouté avec succès !";

    // Envoi de l'email au propriétaire du site
    $destinataire = "damienchauveau@hotmail.fr";
    $sujet = "Nouvelle demande de contact";
    $message = "
        Une nouvelle demande de contact a été soumise sur le site :
        
        Nom : " . $data['nom'] . "
        Prénom : " . $data['prenom'] . "
        Email : " . $data['email'] . "
        Téléphone : " . ($data['phone'] ?? "Non renseigné") . "
        Message : 
        " . $data['message'] . "
        Date d'envoi : " . $data['date_envoi'] . "

        ---
        Ce message a été envoyé automatiquement. Merci de ne pas y répondre.
    ";

    // En-têtes pour envoyer un email avec pièce jointe
    $boundary = uniqid('np');

    $headers = "From: noreply@example.com\r\n";
    $headers .= "Reply-To: " . $data['email'] . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    // Corps du message
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n";

    // Ajouter la pièce jointe
    if ($data['photo']) {
        $fileContent = file_get_contents($data['photo']);
        $encodedFile = chunk_split(base64_encode($fileContent));
        $body .= "--$boundary\r\n";
        $body .= "Content-Type: image/" . $imageFileType . "; name=\"" . basename($data['photo']) . "\"\r\n";
        $body .= "Content-Disposition: attachment; filename=\"" . basename($data['photo']) . "\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= $encodedFile . "\r\n";
    }

    // Terminer le message
    $body .= "--$boundary--";

    // Envoi de l'email
    if (mail($destinataire, $sujet, $body, $headers)) {
        echo "Email envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi de l'email.";
    }
}

header('location: /succes.php');
exit;
