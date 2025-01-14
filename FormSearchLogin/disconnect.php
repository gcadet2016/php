<!DOCTYPE html>
<html lang="fr" id="home">
    <!-- url: http://php.localhost/FormSearchLogin/index.php -->
    <head>
        <title>France tourisme-connexion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="gcadet">
        <meta name="description" content="Recherche de destination">
        <link rel="icon" type="img/x-icon" href="./img/eye-4-16.ico">
        <!-- <link rel="stylesheet" type="text/css" href="./css/default.css"> -->
        <link rel="stylesheet" type="text/css" href="./css/global.css">
        <link rel="stylesheet" type="text/css" href="./css/login.css">
    </head>
    <body>
        <?php require './php/sqlConnection.php'; ?>
        <?php require './php/debug.php'; ?>
        <header>
            <?php session_start(); ?>
            <nav class="nav_left">
                <img src="img/agent.webp" alt="logo" class="logo">
                <a href="index.php">Accueil</a>
                <a href="search.php">Rechercher</a>
                <a href="#about">À propos</a>
                <a href="#contact">Contact</a>
            </nav>
            <nav class="nav_right">
                <img src="img/user-3-48.png" alt="User" class="usrIco">
                <?php if(isset($_SESSION['user_login'])) { 
                    session_unset();    // Supprimer toutes les variables de session
                    session_destroy();  // Détruire la session
                    }
                ?>
                <a class="login" href="login.php">Connexion</a>
            </nav>
        </header>
        <div id="wrapper">
            <h1>Vous avez été déconnecté.</h1>
            <h2>Merci pour votre visite, à très bientôt.</h2>
        </div>
    </body>
</html>