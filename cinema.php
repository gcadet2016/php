<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- url: http://php.localhost/cinema.php -->
        <title>Formulaire film cinéma</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="gcadet">
        <meta name="description" content="Formulaire de sélection de film">
        <style>
            h1 {
                text-align: center;
                color: #3a8a9e;
            }
            #wrapper{
                margin: 25px auto;
                width: 900px;
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
            .resultTab tr {
                display: grid;
                grid-template-columns: 200px 4em 6em 200px 3em 6em;
                grid-template-rows: auto;
                row-gap: 10px;
                column-gap: 10px;
                text-align: left;
            }

        </style>
        <script> 
            function goToLink(select) { 
                var url = select.value; 
                if (url) { window.location.href = url; } 
            } 
        </script>
    </head>
    <body>
        <?php
            $titrePage='Cinématèque';
            $films = [
                ['id' => 'f1', 'titre' => 'Les Évadés', 'date' => '1994', 'durée' => '2h 22m', 'publique' => 'Tous publics avec avertissement', 'note' => '9.3', 'nbVotes' => '3 M', 'link' => 'https://www.imdb.com/fr/title/tt0111161/?ref_=chttp_i_1'],
                ['id' => 'f2', 'titre' => 'Le Parrain', 'date' => '1972', 'durée' => '2h 55m', 'publique' => '', 'note' => '9.2', 'nbVotes' => '2.1 M', 'link' => 'https://www.imdb.com/fr/title/tt0068646/?ref_=chttp_t_2'],
                ['id' => 'f3', 'titre' => 'The Dark Knight : Le Chevalier noir', 'date' => '2008', 'durée' => '2h 32m', 'publique' => 'Tous publics', 'note' => '9.0', 'nbVotes' => '3 M', 'link' => 'https://www.imdb.com/fr/title/tt0468569/?ref_=chttp_t_3'],
                ['id' => 'f4', 'titre' => 'Le Parrain, 2ᵉ partie', 'date' => '1974', 'durée' => '3h 22m', 'publique' => '', 'note' => '9.0', 'nbVotes' => '1.4 M', 'link' => 'https://www.imdb.com/fr/title/tt0071562/?ref_=chttp_t_4'],
                ['id' => 'f5', 'titre' => '12 Hommes en colère', 'date' => '1957', 'durée' => '1h 36m', 'publique' => 'Tous publics', 'note' => '9.0', 'nbVotes' => '903 k', 'link' => 'https://www.imdb.com/fr/title/tt0050083/?ref_=chttp_t_5'],
                ['id' => 'f6', 'titre' => 'Le Seigneur des anneaux : Le Retour du roi', 'date' => '2003', 'durée' => '3h 21m', 'publique' => 'Tous publics avec avertissement', 'note' => '9.0', 'nbVotes' => '2 M', 'link' => 'https://www.imdb.com/fr/title/tt0167260/?ref_=chttp_t_6'],
                ['id' => 'f7', 'titre' => 'La Liste de Schindler', 'date' => '1993', 'durée' => '3h 15m', 'publique' => 'Tous publics', 'note' => '9.0', 'nbVotes' => '1.5 M', 'link' => 'https://www.imdb.com/fr/title/tt0108052/?ref_=chttp_t_7'],
                ['id' => 'f8', 'titre' => 'Pulp Fiction', 'date' => '1994', 'durée' => '2h 34m', 'publique' => '', 'note' => '8.9', 'nbVotes' => '2.3 M', 'link' => 'https://www.imdb.com/fr/title/tt0110912/?ref_=chttp_t_8'],
                ['id' => 'f9', 'titre' => 'Le Seigneur des anneaux : La Communauté de l\'anneau', 'date' => '2001', 'durée' => '2h 58m', 'publique' => 'Tous publics', 'note' => '8.9', 'nbVotes' => '2.1 M', 'link' => 'https://www.imdb.com/fr/title/tt0120737/?ref_=chttp_t_9'],  
            ];  
        ?>
        <h1><?php echo $titrePage; ?></h1>
        <div id="wrapper">
            <div id="formulaire" class="form">
                <form action="cinema.php" method="get">
                    <!-- La consigne du devoir n'est pas claire:
                     "Affichez en liste de liens HTML '<a href="' les années des films listés."
                     J'ai développé 2 options.
                     La première est très moche et ne pourrait jamais être sur la page d'un site tel que celui de l'exercice.
                     Mais elle semble répondre au plus près de la consigne!
                     Le code est ci-dessous et est en commentaire -->
                    <!-- <p>
                        <?php
                            $url = 'http://php.localhost/cinema.php';
                            $dates = array_column($films, 'date');          // Extraire les dates
                            $dates_uniques = array_unique($dates);          // Obtenir les dates distinctes
                            rsort($dates_uniques);                          // Trier les dates dans l'ordre décroissant
                            //print_r($dates_uniques);
                            foreach($dates_uniques as $an) { 
                                echo '<a href="' . $url .'?an=' . $an . '">' . $an . '</a><br>';      
                            }
                        ?>
                    </p> -->
                    <!-- Seconde option un peu plus ergonomique, une liste comme demandée mais déroulante -->
                    <p>
                        <label for="filter">Sélectionner l'année:</label>
                        <select name="filter" id="filter" onchange="goToLink(this)">
                            <option value="">Sélectionnez une année</option>
                            <?php
                                // Générer les <options telles que :
                                // <option value="http://php.localhost/cinema.php?an=2018">2018</option>
                                $dates = array_column($films, 'date');      // Extraire les dates
                                $dates_uniques = array_unique($dates);      // Obtenir les dates distinctes 
                                rsort($dates_uniques);                      // Trier les dates dans l'ordre décroissant

                                foreach($dates_uniques as $an) { 
                                     echo '<option value="' . $url . '?an=' . $an . '" ';   
                                     if($_GET['an']==$an){ echo 'selected';}
                                     echo '>'. $an .'</option>';
                                }
                            ?>
                        </select>
                    </p>
                    <div class="resultat">
                        <?php
                            if(isset($_GET['an'])) {
                        ?>
                        <table class="resultTab">
                            <tr> <th>Titre</th> <th>Année</th> <th>Durée</th> <th>Publique</th> <th>Note</th> <th>NbVotes</th></tr> 
                            <?php 
                            foreach($films as $film) { 
                                if($_GET['an']==$film['date']) { ?> 
                                <tr> 
                                    <td><?php echo '<a href="'.$film['link'].'" target="_blank">'.$film['titre'].'</a>'; ?></td>
                                    <td><?php echo $film['date']; ?></td>
                                    <td><?php echo $film['durée']; ?></td>
                                    <td><?php echo $film['publique']; ?></td> 
                                    <td><?php echo $film['note']; ?></td>
                                    <td><?php echo $film['nbVotes']; ?></td>
                                </tr> 
                            <?php }}} ?> 
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>