<!DOCTYPE html>
<html lang="fr">
<!-- url: http://php.localhost/mySQL_1.php -->
    <head>
        <title>SQL & php</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="gcadet">
        <!-- for search engine -->
        <meta name="description" content="Get and insert data in MySQL">
        <meta name="keywords" content="HTML, PHP, MySQL, example">
    </head>

    <body>
        <?php
            // Global var
            $mySQLsvr = 'localhost';
            $mySQLusr = 'admin';
            $mySQLpwd = 'HpmMITops$!1152';
            $mySQLdb = 'projet_villes';
        ?>
        <h1>Query Data</h1>
        <?php
            try {
                $sqlConn = new mysqli($mySQLsvr, $mySQLusr, $mySQLpwd, $mySQLdb);

                // Vérifier la connexion 
                if ($sqlConn->connect_error) { 
                    throw new Exception("Échec de la connexion : " . $sqlConn->connect_error . '<br>'); 
                } else { 
                    echo "Connexion réussie<br>"; 
                }

                $result = $sqlConn->query('SELECT ville_id, ville_nom from villes');
                if ($result->num_rows > 0) {
                    // echo '<ul>';
                    // while($row = $result->fetch_array()) {
                    //     echo '<li>' . $row['ville_id'] . '-' . $row['ville_nom'] . '</li>';
                    // }
                    // echo '</ul><br>';

                    // Il est recommandé de séparer le code php/SQL du code php/HTML

                    //while($row = $result->fetch_array()) {
                    while($row = $result->fetch_assoc()) {
                        $villes[$row['ville_id']] = $row['ville_nom'];
                    }
                    print_r($villes);
                } else {
                    echo "0 résultats";
                }
                echo '<br>';

            } catch (Exception $e) { 
                echo 'Erreur : ' . $e->getMessage() . '<br>'; 
            } finally { 
                
                if ($result) { 
                    echo 'free dataset<br>';
                    $result->free(); 
                }
                // Fermer la connexion si elle a été établie 
                if ($sqlConn) { 
                    echo 'close connection<br>';
                    $sqlConn->close(); } 
            }
        ?>

        <table border=1>
            <th>Id</th><th>Ville</th>
            <?php
                echo '<ul>';
                foreach($villes as $id => $ville):
                    echo '<tr><td>' . $id . '</td><td>' . $ville . '</td></tr>';
                endforeach
            ?>
        </table>

        <h1>Insert Data</h1>
        <?php
            try {
                $sqlConn = new mysqli($mySQLsvr, $mySQLusr, $mySQLpwd, $mySQLdb);

                // Vérifier la connexion 
                if ($sqlConn->connect_error) { 
                    throw new Exception("Échec de la connexion : " . $sqlConn->connect_error . '<br>'); 
                } else { 
                    echo "Connexion réussie<br>"; 
                }

                $new_ville_nom = 'Lilles';
                $query = 'INSERT INTO villes (ville_nom) VALUES ("' . $new_ville_nom . '")';
                echo 'SQL query: ' . $query . '<br>';
                $sqlConn->query($query);

                echo 'Inserted ville_nom = '. $new_ville_nom . '  ville_id = ' . $sqlConn->insert_id . '<br>'; // Retourne l'identifiant clé primaire

            } catch (Exception $e) { 
                echo 'Erreur : ' . $e->getMessage() . '<br>'; 
            } finally { 
                
                // Fermer la connexion si elle a été établie 
                if ($sqlConn) { 
                    echo 'close connection<br>';
                    $sqlConn->close(); } 
            }
        ?>
    </body>
</html>