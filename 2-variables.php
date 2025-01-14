<?php
            $seasonName = 'printemps';
            $seasonDecription = 'Le printemps est l\'une de quatre saisons...';
            $seasonImage = 'printemps.jpg';
?>

<!DOCTYPE html>
<html lang="fr">
<!-- url: http://php.localhost/2-variables.php -->
    <head>
        <title><?php echo $seasonName; ?></title>
    </head>

    <body>
        <h1><?php echo $seasonName; ?></h1>
        <img src="<?php echo $seasonImage; ?>" alt="<?php echo $seasonName; ?>">
        <p>
            <?php echo $seasonDecription; ?>
        </p>
    </body>

</html>