<?php include_once '../config/database.php';
?><!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alta Pro 65</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="/WWW/Ressources/styles.css">
</head>
<body>

  <header>
    <nav class="navbar">
    <div class="logo">
            <a href="/index.php">
                <img src="/WWW/Ressources/Images/logo vectorise.jpg" alt="Logo de l'entreprise">
            
            <span>Alta Pro 65</span>
            </a>
        </div>
      <div class="hamburger" id="hamburger" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
      </div>
    <ul class="nav-links">
      <li><a href="/index.php">Accueil</a></li>
      <li><a href="/service.php">Nos Services</a></li>
      <li><a href="/realisation.php">Nos Réalisations</a></li>
      <li><a href="/about.php">À Propos</a></li>
      <li><a href="/contact.php">Contact</a></li>
    </ul>
  </nav>
</header>