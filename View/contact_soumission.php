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
function formatPhoneNumber($number) {
$number = preg_replace('/[^\d+]/', '', $number);

    if (substr($number, 0, 1) === '+' && strlen($number) > 1) {
        return $number; // Le numéro est valide si il commence par + et a plus de 1 caractère
    }

    if (strlen($number) == 10) {
        return substr($number, 0, 2) . ' ' . substr($number, 2, 2) . ' ' . substr($number, 4, 2) . ' ' . substr($number, 6, 2) . ' ' . substr($number, 8, 2);
    }
    return false;
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
        Ce message a été envoyé automatiquement.
    ";

    $headers = "From: noreply@example.com\r\n"; // Remplace par un e-mail d'expéditeur valide
    $headers .= "Reply-To: " . $data['email'] . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    mail($destinataire, $sujet, $message, $headers);
}

header('location: /succes.php');
exit;
