<?php

var_dump($_POST,$_FILES);


foreach ($_POST as $cle => $valeur) {
    $data[$cle] = $valeur;
}
$table = 'contact';
$sql = "INSERT INTO " . $table . " (" . implode(', ', array_keys($data)) . ") VALUES ('" . implode("', '", $data) . "')";



    $connexion = new mysqli('localhost','root','','alta pro 65');

if ($connexion->connect_error) {
    die("Erreur de connexion : " . $connexion->connect_error);
}
$connexion->query($sql);

header('location: /index.php');