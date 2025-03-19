<?php
include_once '../config/database.php';

$pdo = Database::connect();

$data = [];

foreach ($_POST as $cle => $valeur) {
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

function formatPhoneNumber($number) {
   
    $number = preg_replace('/[^\d]/', '', $number);
    
    if (strlen($number) != 10) {
        return false;
    }
    
    return substr($number, 0, 2) . ' ' .
           substr($number, 2, 2) . ' ' .
           substr($number, 4, 2) . ' ' .
           substr($number, 6, 2) . ' ' .
           substr($number, 8, 2);
}
if (isset($_POST['phone']) && $phone = formatPhoneNumber($_POST['phone'])) {
    $data['phone'] = $phone;
}

if (!empty($data)) {
    
    $parameters = [];
    foreach ($data as $cle=> $valeur){
        $parameters[':' . $cle] = $valeur;
    }

    $sql = "INSERT INTO contact (`" . implode('`, `', array_keys($data)) . "`) 
            VALUES (" . implode(", ", array_keys($parameters)) . ")";
           
    $stmt = $pdo->prepare($sql);
        
    $stmt->execute($parameters);

    echo "Votre message a été ajouté avec succès !";

    mail(DESTINATOR_EMAIL, 'Prise contact', json_encode($data));

    header('location: /index.php?contact-success=1');
    die;
}

header('location: /index.php');