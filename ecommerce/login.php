<!DOCTYPE html>
<html lang="fr" id="home">
    <!-- dev url: http://php.localhost/ecommerce/login.php -->
    <head>
        <title>France tourisme-connexion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="gcadet">
        <meta name="description" content="Recherche de destination">
        <link rel="icon" type="img/x-icon" href="./img/logo-icon.png">
        <!-- <link rel="stylesheet" type="text/css" href="./css/default.css"> -->
        <link rel="stylesheet" type="text/css" href="./css/global.css">
        <link rel="stylesheet" type="text/css" href="./css/login.css">
    </head>
    <body>
        <?php require './php/sqlConnection.php'; ?>
        <?php require './php/debug.php'; ?>
        <?php
            session_start();
        ?>
        <header>
            <nav class="nav_left">
                <img src="img/logo-small.png" alt="logo" class="logo">
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
        <div id="wrapper">
            <h1>Connexion utilisateur</h1>
            <h2>Vous disposez déjà d'un compte utilisateur:</h2>
            <div id="loginform" class="form">
                <form action="login.php" method="post">
                    <p>
                        <label for="userLogin">email :</label>
                        <input type="text" id="userLogin" name="userLogin" value="<?php if(isset($_POST['userLogin'])) {echo $_POST['userLogin'];}?>" required>
                    </p>
                    <p>
                        <label for="pwd1">Mot de passe :</label>
                        <input type="password" id="pwd1" name="pwd1" value="<?php if(isset($_POST['pwd1'])) {echo $_POST['pwd1'];}?>" required>
                    </p>
                    <div class="submit-container">
                        <input class="buttonClass" type="submit" id="btn1" name="login" value="Se connecter">
                    </div>
                    <?php
                        try {
                            $message = '';
                            // Récupérer les données du formulaire de login
                            if(isset($_POST['login'])) {
                                $user_input_login = $_POST['userLogin'];
                                $user_input_pwd = $_POST['pwd1'];

                                // Vérification des champs
                                if(empty($user_input_login) or empty($user_input_pwd)) {
                                    $message = '<p class="error">Saisie incomplète<p>';
                                } else {
                                    $sqlQuery = "SELECT user_id, user_login , user_password, user_firstname FROM users WHERE user_login='" . $user_input_login . "'";
                                    $result = $SQLconn->query($sqlQuery);
                                    $row = $result->fetch_array();
                                    if(!isset($row['user_login'])) {
                                        $message = '<p class="error">Erreur d\'authentification: accès refusé<p>';
                                    } else {
                                        $user_id = $row['user_id'];
                                        $user_login = $row['user_login'];
                                        $user_pwd = $row['user_password'];
                                        $user_firstname =  $row['user_firstname'];
                                        if(!password_verify($user_input_pwd, $user_pwd)) {
                                            $message = '<p class="error">Erreur d\'authentification: accès refusé<p>';
                                        } else {
                                            $message=('<p class="success">Authentification success</p>');
                                            // Ouverture de la session et redirection vers la page de recherche
                                            session_start();
                                            $_SESSION['user_id'] = $user_id;
                                            $_SESSION['user_login'] = $user_login;
                                            $_SESSION['user_firstname'] = $user_firstname;
                                            header('location:index.php');
                                            exit();
                                        }
                                    }
                                }
                            } 
                        } catch (Exception $e) { 
                            $message = '<p class="error">' . $e->getMessage() . '</p>'; 
                        } finally {             
                            if ($result) { $result->free(); }                       
                            echo $message;
                        } 
                    ?>
                </form>
            </div>
            <h2>Créer votre compte utilisateur:</h2>
            <div id="createform" class="form">
                <form action="login.php" method="post">
                    <p>
                        <label for="lastname">Nom :</label>
                        <input type="text" id="lastname" name="lastname" value="<?php if(isset($_POST['lastname'])) {echo $_POST['lastname'];}?>" required>
                    </p>
                    <p>
                        <label for="firstname">Prénom :</label>
                        <input type="text" id="firstname" name="firstname" value="<?php if(isset($_POST['firstname'])) {echo $_POST['firstname'];}?>" required>
                    </p>
                    <p>
                        <label for="email">Adresse e-mail :</label>
                        <input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];}?>" required>
                    </p>
                    <p>
                        <label for="pwd">Mot de passe :</label>
                        <input type="password" id="pwd" name="pwd" value="" required>
                    </p>
                    <p>
                        <label for="pwd2">Vérification du Mot de passe :</label>
                        <input type="password" id="pwd2" name="pwd2" value="" required>
                    </p>
                    <div class="submit-container">
                        <input class="buttonClass" type="submit" id="btn2" name="createAccount" value="Créer mon compte">
                    </div>
                    <?php
                        try {
                            $message = '';
                            // Récupérer les données du formulaire de création de compte
                            if(isset($_POST['createAccount'])) {
                                $user_input_lastname = $_POST['lastname'];
                                $user_input_firstname = $_POST['firstname'];
                                $user_input_email = $_POST['email'];
                                $user_input_pwd = $_POST['pwd'];
                                $hashed_password = password_hash($user_input_pwd, PASSWORD_DEFAULT);

                                // Vérification des champs
                                if(empty($user_input_email) or empty($user_input_pwd)) {
                                    // Les autres champs sont en required
                                    $message = '<p class="error">Saisie incomplète<p>';
                                } else if($user_input_pwd != $_POST['pwd2']) {
                                    $message = '<p class="error">Les mots de passe ne correspondent pas !<p>';
                                } else {
                                    // Vérification si l'utilsateur existe déjà
                                    $result = $SQLconn->query('SELECT user_login FROM users
                                                            WHERE user_login="' . $user_input_email . '"');
                                    $row = $result->fetch_array();

                                    if(isset($row['user_login'])) {
                                        $message = '<p class="error">Utilisateur déjà créé<p>';
                                    } else {
                                        // Insérer l'utilisateur dans la base de données 
                                        $sql = 'INSERT INTO users (user_firstname, user_lastname, user_login, user_password) 
                                                VALUES ("' . $user_input_firstname .'", 
                                                        "' . $user_input_lastname . '", 
                                                        "' . $user_input_email . '", 
                                                        "' . $hashed_password .'")'; 
                                        if ($SQLconn->query($sql) === TRUE) { 
                                            $message = '<p class="success">Compte créé avec succès</p>';
                                            // Récupérer le user_id assigné au nouveau compte
                                            $sql = "SELECT user_id FROM users WHERE user_login = '" . $user_input_email . "'";
                                            $result = $SQLconn->query($sql);
                                            $row = $result->fetch_array();
                                            if(isset($row['user_id'])) {
                                                // Ouverture de la session et redirection vers la page de recherche
                                                sesion_start();
                                                $_SESSION['user_id'] = $row['user_id'];
                                                $_SESSION['user_login'] = $user_input_email;
                                                $_SESSION['user_firstname'] = $user_input_firstname;
                                                header('location:index.php');
                                                exit();
                                            } else {
                                                $message = '<p class="error">Unexpected error: unable to get user_id</p>';
                                            }
                                        } else { 
                                            $message = '<p class="error">' . $conn->error . '</p>'; 
                                        } 
                                    }
                                } 
                            } 
                        } catch (Exception $e) { 
                            $message = '<p class="error">' . $e->getMessage() . '</p>'; 
                        } finally { 
                            if ($result) { $result->free(); }
                            // Fermer la connexion si elle a été établie 
                            if ($sqlConn) { $sqlConn->close(); }
                        }
                    ?>
                </form>
                <?php echo $message; ?>

            </div>
        </div>
    </body>
</html>