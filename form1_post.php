<!DOCTYPE html>
<html lang="fr">
    <!-- url: http://php.localhost/form1_post.php -->
    <head>
        <title>Formulaire covoiturage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="gcadet">
        <meta name="description" content="Formulaire d'inscription pour covoiturage">
        <style>
            h1 {
                text-align: center;
                color: #3a8a9e;
            }
            #wrapper{
                margin: 25px auto;
                width: 650px;
                background-color: #fff;
                padding: 15px;
                border: 1px solid #d5f;
            }
            form {
                padding:20px;
                background-color: #91B6C0;
                font-family:Arial;
            }
            label{
                width: 150px;
                margin-right: 20px;
                font-size: 1em;
                text-align: right;
            }
            form p{
                margin: 1em 0;
            }
            input, label {
                display: inline-block;
            }
            input, select {
                width: 180px;
                padding: 4px;
                background: #f2f2f2;
                border: 1px solid #ddd;
            }
            #ville {
                width: 190px;
            }
            
            .buttonClass {
            font-size: 15px;
            width: 180px;
            height: 40px;
            border-width: 1px;
            color: #3a8a9e;
            border-color: #d6bcd6;
            font-weight: bold;
            border-radius: 10px;
            box-shadow: 3px 4px 0px 0px #899599;
            text-shadow: 0px 1px 0px #e1e2ed;
            background: linear-gradient(#ededed, #bab1ba);
            }

            .buttonClass:hover {
            background: linear-gradient(#bab1ba, #ededed);
            }
              
            .submit-container { 
                display: flex; 
                justify-content: flex-end; 
            }
            .resultat {
                margin-top: 50px;
            }
            .resultTab td, .resultTab th {
                padding: 10px;
                width: 100px;
                text-align: left;
            }
        </style>
    </head>
    <body>
        <?php
            $titrePage='Inscription covoiturage';
            $travels = [
                ['departure' => 'Paris', 'arrival' => 'Nantes', 'departureTime' => '11:00', 'arrivalTime' => '12:34', 'driver' => 'Thomas'],
                ['departure' => 'Orléans', 'arrival' => 'Nantes', 'departureTime' => '05:15', 'arrivalTime' => '09:32', 'driver' => 'Mathieu'],
                ['departure' => 'Dublin', 'arrival' => 'Tours', 'departureTime' => '07:23', 'arrivalTime' => '08:50', 'driver' => 'Nathanaël'],
                ['departure' => 'Paris', 'arrival' => 'Orléans', 'departureTime' => '03:00', 'arrivalTime' => '05:26', 'driver' => 'Clément'],
                ['departure' => 'Paris', 'arrival' => 'Nice', 'departureTime' => '10:00', 'arrivalTime' => '12:09', 'driver' => 'Audrey'],
                ['departure' => 'Nice', 'arrival' => 'Nantes', 'departureTime' => '10:40', 'arrivalTime' => '13:00', 'driver' => 'Pollux'],
                ['departure' => 'Nice', 'arrival' => 'Tours', 'departureTime' => '11:00', 'arrivalTime' => '16:10', 'driver' => 'Edouard'],
                ['departure' => 'Tours', 'arrival' => 'Amboise', 'departureTime' => '16:00', 'arrivalTime' => '18:40', 'driver' => 'Priscilla'],
                ['departure' => 'Nice', 'arrival' => 'Nantes', 'departureTime' => '12:00', 'arrivalTime' => '16:00', 'driver' => 'Charlotte'],  
            ];  
        ?>
        <h1><?php echo $titrePage; ?></h1>
        <div id="wrapper">
            <div id="formulaire" class="form">
                <form action="form1_post.php" method="post">
                    <p>
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" value="<?php if(isset($_POST['nom'])) {echo $_POST['nom'];}?>" required>
                    </p>

                    <p>
                        <label for="email">Adresse e-mail :</label>
                        <input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];}?>" required autocomplete="off">
                    </p>

                    <p>
                        <label for="phone">Téléphone :</label>
                        <input type="tel" id="phone" name="phone" value="<?php if(isset($_POST['phone'])) {echo $_POST['phone'];}?>" required autocomplete="off">
                    </p>
                    
                    <p>
                        <label for="ville">Ville de départ :</label>
                        <select name="ville" id="ville">
                            <option value="">---</option>
                            <?php
                                $villes = array_column($travels, 'departure');    // Extraire les villes de départ
                                $villes_uniques = array_unique($villes);          // Obtenir les villes distinctes 
                                sort($villes_uniques);                            // Trier les dates dans l'ordre alphabétique

                                foreach($villes_uniques as $ville) { 
                                     echo '<option value="'.$ville.'" ';
                                     if($_POST['ville']==$ville){ echo 'selected';}
                                     echo '>'.$ville.'</option>';
                                }
                            ?>
                        </select>
                    </p>
                    <div class="submit-container">
                        <input class="buttonClass" type="submit" id="btn" name="search" value="Rechercher">
                    </div>

                    <div class="resultat">
                        <?php
                            if(isset($_POST['search'])) {
                                if(isset($_POST['ville'])) {
                        ?>
                        <table class="resultTab">
                            <tr> <th>Départ</th> <th>Destination</th> <th>Heure de départ</th> <th>Heure d'arrivée</th> <th>Chauffeur</th></tr> 
                            <?php foreach($travels as $travel) { if($_POST['ville']==$travel['departure']) { ?> 
                                <tr> 
                                    <td><?php echo $travel['departure']; ?></td>
                                    <td><?php echo $travel['arrival']; ?></td>
                                    <td><?php echo $travel['departureTime']; ?></td>
                                    <td><?php echo $travel['arrivalTime']; ?></td> 
                                    <td><?php echo $travel['driver']; ?></td>
                                </tr> 
                            <?php }} ?> 
                        </table>
                        <?php
                            }}
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>