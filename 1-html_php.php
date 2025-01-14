<!DOCTYPE html>
<html lang="fr">
<!-- url: http://php.localhost/1-html_php.php -->
    <head>
        <title>Html et php</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="gcadet">
        <!-- Pour les moteurs de recherche-->
        <meta name="description" content="Description de la page pour les moteurs de recherche.">
        <meta name="keywords" content="HTML, CSS, JavaScript, exemple">

        <link rel="icon" type="img/x-icon" href="../../img/icone.png">
        <link rel="stylesheet" type="text/css" href="../../css/default.css">
        <link rel="stylesheet" type="text/css" href="../../css/global.css">
    </head>

    <body>
        <?php
            echo('Titre de la page<br>');    // \n ajoute un retour à la ligne dans le contexte de la console ou d'un fichier texte.
            echo("Text php<br>");            # dans un contexte html, utiliser <br>
            echo('escape char c\'est sympa<br>');

            /*
                Commentaire
            */
            $saison = 'été';
            echo $saison;
            echo ', nous sommes en ' . $saison;
            echo '<br>Les feuilles ne tombent pas en <strong>' . $saison . '</strong><br>';

            $first = 'Hello';
            $last = 'world!<br>';
            echo $first . $last;

            // Constante
            define('PAYS', 'France');
            echo 'Nous sommes en ' . PAYS . '<br>';

            define('HOME', 'info.php');
            echo '<a href="' . HOME . '">PHP Info</a>';
        ?>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
            aliqua. Nunc sed augue lacus viverra vitae congue eu. Egestas sed tempus urna et pharetra pharetra massa massa ultricies. 
            Faucibus ornare suspendisse sed nisi. Massa id neque aliquam vestibulum morbi blandit cursus. Laoreet sit amet cursus sit. 
            Convallis aenean et tortor at risus viverra adipiscing at in. Cursus eget nunc scelerisque viverra mauris in aliquam sem 
            fringilla. Pharetra vel turpis nunc eget lorem dolor sed viverra. Turpis tincidunt id aliquet risus feugiat in ante metus 
            dictum. Auctor augue mauris augue neque. Id aliquet lectus proin nibh nisl condimentum id. Elementum facilisis leo vel 
            fringilla est. Consequat ac felis donec et odio pellentesque. Diam ut venenatis tellus in metus vulputate. Netus et 
            malesuada fames ac turpis egestas sed tempus urna. Elementum integer enim neque volutpat ac tincidunt vitae. Purus 
            viverra accumsan in nisl nisi scelerisque eu ultrices vitae. Et egestas quis ipsum suspendisse ultrices.
        </p>
    </body>

</html>