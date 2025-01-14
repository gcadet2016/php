<!DOCTYPE html>
<html lang="fr" id="home">
    <!-- dev url: http://php.localhost/FormSearchLogin/search.php -->
    <head>
        <title>France tourisme-recherche</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="gcadet">
        <meta name="description" content="Recherche de destination">
        <link rel="icon" type="img/x-icon" href="./img/eye-4-16.ico">
        <!-- <link rel="stylesheet" type="text/css" href="./css/default.css"> -->
        <link rel="stylesheet" type="text/css" href="./css/global.css">
        <link rel="stylesheet" type="text/css" href="./css/search.css">
    </head>
    <body>
        <?php require './php/sqlConnection.php'; ?>
        <?php require './php/debug.php'; ?>
        <?php
            session_start();
            if(!isset($_SESSION['user_login'])) { 
                header('location:login.php');
                exit();
            } 
        ?>
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
            <h1><?php echo 'Bonjour '. $_SESSION['user_firstname'] ?></h1>
            <div id="wrapper">
                <div id="searchform" class="form">
                    <form action="search.php" method="post">
                        <p>
                            <label for="ville">Sélectionner une destination :</label>
                            <select name="ville" id="ville">
                                <option value="">---</option>
                                <?php
                                    try {
                                        $result = $SQLconn->query('SELECT ville_id, ville_name, ville_txt, ville_link FROM villes ORDER BY ville_name');
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $ville = $row['ville_name'];
                                                echo '<option value="'. $ville .'" ';
                                                if(isset($_POST['ville'])) {
                                                    if ($_POST['ville']==$ville){ echo 'selected';}
                                                }
                                                echo '>'.$ville.'</option>';
                                            }
                                        }
                                    } catch (Exception $e) { 
                                        $message = '<p class="error">' . $e->getMessage() . '</p>'; 
                                    } 
                                    echo $message;
                                ?>
                            </select>
                        </p>
                        <div class="submit-container">
                            <input class="buttonClass" type="submit" id="btn" name="search" value="Rechercher">
                        </div>
                    </form>
                </div>
                <div class="resultat">
                    <?php
                    try {
                        if(isset($_POST['search'])) {
                            if(isset($_POST['ville'])) {
                                $ville = $_POST['ville'];
                                $result = $SQLconn->query('SELECT ville_id, ville_name, ville_txt, ville_link FROM villes WHERE ville_name="' . $ville . '"');
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $ville_id = $row['ville_id'];
                                        $ville = $row['ville_name'];
                                        $description = $row['ville_txt'];
                                        $imgLink = $row['ville_link'];
                    ?>
                    <h1 class="h1_left"><?php echo $ville ?></h1>
                    <figure class="img">
                        <picture> 
                            <img src="<?php echo $imgLink ?>" alt="<?php echo $ville ?>">
                        </picture>
                    </figure>
                    <p><?php echo $description ?></p> 

                    <?php           }
                                    $user_id = $_SESSION['user_id'];
                                    // Insert searc in search databse table 
                                    $sql = 'INSERT INTO search (user_id, ville_id) VALUES (' . $user_id .', ' . $ville_id .')'; 
                                    if ($SQLconn->query($sql) != TRUE) {
                                        $message = '<p class="error">Unexpected error: Insert search failed</p>';
                                    }
                                }
                            }
                        }
                    } catch (Exception $e) { 
                        $message = '<p class="error">' . $e->getMessage() . '</p>'; 
                    } finally { 
                        if ($result) { $result->free(); }
                        if ($sqlConn) { $sqlConn->close(); } // Close connexion if necessary
                    }
                    echo $message;
                    ?>
                </div>
                <?php $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
                    debugLog($url);
                    ?> 
                <div class="searchTab">
                    <h2>Historique des recherches</h2>
                    <table class="resultTab">
                        <tr> <th>Ville</th> <th>Nombre de recherches</th> <th>dernière recherche</th></tr>
                        <?php
                            if(isset($_POST['search'])) {
                               if($_POST['ville']!= '') {
                                    $result = $SQLconn->query('SELECT vt.ville_name, vt.ville_link, MAX(st.search_date) as last_date, COUNT(st.search_date) as search_count
                                                                FROM search AS st
                                                                INNER JOIN villes AS vt ON vt.ville_id = st.ville_id
                                                                INNER JOIN users AS ut ON ut.user_id = st.user_id
                                                                WHERE st.user_id = '. $user_id . ' GROUP BY st.ville_id');
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            $ville = $row['ville_name'];
                                            $imgLink = $row['ville_link'];
                                            $date = $row['last_date'];
                                            $count = $row['search_count'];
                        ?> 
                        <tr> 
                            <td><?php echo '<a href="' . $imgLink . '" target="_blank">' . $ville . '</a>'?></td>
                            <td><?php echo $count ?></td>
                            <td><?php echo $date ?></td>
                        </tr> 
                        <?php }}} ?> 
                    </table>
                    <?php
                        }
                    ?>    
                </div>
            </div>
        </main>
    </body>
</html>