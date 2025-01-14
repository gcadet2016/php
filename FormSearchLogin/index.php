<!DOCTYPE html>
<html lang="fr" id="home">
    <!-- dev url: http://php.localhost/FormSearchLogin/index.php -->
    <head>
        <title>Mondial tourisme</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="gcadet">
        <meta name="description" content="Recherche de destination">
        <link rel="icon" type="img/x-icon" href="./img/eye-4-16.ico">
        <!-- <link rel="stylesheet" type="text/css" href="./css/default.css"> -->
        <link rel="stylesheet" type="text/css" href="./css/global.css">
        <link rel="stylesheet" type="text/css" href="./css/index.css">
    </head>
    <body>
        <?php session_start(); ?>
        <header>
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
                    echo '<a class="login" href="disconnect.php">Déconnexion</a>';
                    } else {
                        echo '<a class="login" href="login.php">Connexion</a>';
                    }
                ?>
            </nav>
        </header>
        <main>
            <section>
                <h1>Bienvenue sur France tourisme</h1>
                <p>Ce site vous permettra de consulter les destinations touristiques proposées par notre agence</p>
                <figure class="img">
                    <picture> 
                        <source media="(max-width: 350px)" srcset="./img/accueil-300x200.jpg">
                        <source media="(max-width: 940px)" srcset="./img/accueil-450x300.jpg">
                        <source media="(max-width: 1200px)" srcset="./img/accueil-612x408.jpg">
                        <source media="(min-width: 1201px)" " srcset="./img/accueil-612x408.jpg">
                        <img src="./img/accueil-612x408.jpg" alt="touriste">
                    </picture>
                </figure>
            </section>
        </main>
    </body>
</html>