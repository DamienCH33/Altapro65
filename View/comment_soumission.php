<?php
include_once '../config/database.php';



// Vérification du Honeypot
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (!empty($_POST['honeypot'])) {
        die('Erreur : formulaire soumis par un bot.');
    }

    // Vérification du délai minimum (5 secondes avant soumission)
    if (!isset($_POST['timestamp']) || time() - $_POST['timestamp'] < 5) {
        die("Soumission trop rapide !");
    }
}

// Validation des champs
if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['comment']) || empty($_POST['rating'])) {
    session_start();
    $_SESSION['error_message'] = "Tous les champs sont obligatoires, y compris la notation !";
    header('Location: /realisation.php');
    exit();
}

$pdo = Database::connect();

$data = [];
foreach ($_POST as $cle => $valeur) {
    if ($cle == 'nom') {
        $valeur = strtoupper($valeur);
    }
    if ($cle == 'prenom') {
        $valeur = ucwords(strtolower($valeur));
    }
    // Exclure le champ honeypot
    if ($cle != 'honeypot') {
        $data[$cle] = trim($valeur);
    }
}

if (!empty($data)) {
    $parameters = [];
    foreach ($data as $cle => $valeur) {
        $parameters[":$cle"] = $valeur;
    }

    $sql = "INSERT INTO comments (`" . implode('`, `', array_keys($data)) . "`) 
                VALUES (" . implode(", ", array_keys($parameters)) . ")";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($parameters);

    echo "Votre commentaire a été ajouté avec succès !";
}

header('Location: /realisation.php');
exit();
