<?php include_once '../config/database.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alta Pro 65</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/Ressources/styles.css">
</head>
<body class="altapro">

<header>
  <nav class="navbar custom-navbar navbar-expand-lg">
    <div class="navbar-container">
      <div class="logo">
        <a href="/index.php">
          <img src="/Ressources/Images/logo vectorise.jpg" alt="Logo de l'entreprise">
          <span>Alta Pro 65</span>
        </a>
      </div>

      <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="toggler-icon">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="nav-links navbar-nav">
          <li class="nav-item"><a class="nav-link" href="/index.php">Accueil</a></li>
          <li class="nav-item"><a class="nav-link" href="/service.php">Nos Services</a></li>
          <li class="nav-item"><a class="nav-link" href="/realisation.php">Nos Réalisations</a></li>
          <li class="nav-item"><a class="nav-link" href="/about.php">À Propos</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact.php">Contact</a></li>
        </ul>
      </div>

    </div>
  </nav>
</header>
