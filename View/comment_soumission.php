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
    $data[$cle] = trim($valeur);
}

if (!empty($data)) {
    
    $parameters = [];
    foreach ($data as $cle=> $valeur){
        $parameters[':' . $cle] = $valeur;
    }

    $sql = "INSERT INTO comments (`" . implode('`, `', array_keys($data)) . "`) 
            VALUES (" . implode(", ", array_keys($parameters)) . ")";
           
    $stmt = $pdo->prepare($sql);
    
    
    $stmt->execute($parameters);

    echo "Votre commentaire a été ajouté avec succès !";
}

header('Location: /realisation.php');
exit();

