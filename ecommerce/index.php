<!DOCTYPE html>
<html lang="fr" id="home">
    <!-- dev url: http://php.localhost/ecommerce/index.php -->
    <head>
        <title>Ma boutique préférée</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="gcadet">
        <meta name="description" content="Vente en ligne">
        <link rel="icon" type="img/x-icon" href="./img/logo-icon.png">
        <!-- <link rel="stylesheet" type="text/css" href="./css/default.css"> -->
        <link rel="stylesheet" type="text/css" href="./css/global.css">
        <link rel="stylesheet" type="text/css" href="./css/index.css">
    </head>
    <body>
        <?php   require './php/sqlConnection.php'; 
                require './php/debug.php'; 
                require './php/cookies.php';
                session_start();
        ?>
        <header>
            <nav class="nav_left">
                <a href="index.php">
                    <img src="img/logo-small.png" alt="logo" class="logo" href="index.php">
                </a>
                <form class='search' action="search.php" method="get">
                    <input class="search_input" type="text" id="search" name="search" placeholder="Rechercher...">
                    <button class="img_btn" type="submit" id="btn" name="btn"> 
                        <img src="img/search-3-48.png" alt="Rechercher"> 
                    </button>
                </form> 
            </nav>
            <nav class="nav_right">
                <img src="img/user-3-48.png" alt="User" class="usrIco">
                <?php if(isset($_SESSION['user_login'])) { 
                    echo '<a class="login" href="disconnect.php">Déconnexion</a>';
                    } else {
                        echo '<a class="login" href="login.php">Connexion</a>';
                    }
                ?>
                <form action="cart.php" method="get">
                    <button class="img_btn" type="submit" id="btn" name="cart">
                        <img src="img/cart-8-48.png" alt="User" class="usrIco">
                    </button>
                </form>
                <a href="cart.php">
                    <?php
                    echo $pCount;
                    ?>
                </a>
            </nav>
        </header>
        <main>
            <div class="img_container">
                <h1>Bienvenue dans la boutique du web</h1>
                <?php
                    $product_id = 1;
                    $product_name = '';
                    $img_link = '';
                    $price = 0;
                    $description = '';
                    if(isset($_GET['details'])) {
                        # Display details about the searched product
                        $product_id = $_GET['details'];
                        $sqlQuery = 'SELECT product_id, product_name, product_txt, product_img, product_price FROM products WHERE product_id = ' . $product_id;
                        echo '<p>Détails du produit recherché:</p>';  
                    } else {
                        # Select random product in catalog
                        $sqlQuery = 'SELECT product_id, product_name, product_txt, product_img, product_price FROM products ORDER BY RAND() LIMIT 1';
                        echo '<p>La proposition de la semaine:</p>';
                    }
                    try {
                        $product_name = '';
                        $img_link = '';
                        $result = $SQLconn->query($sqlQuery);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $product_id = $row['product_id'];
                                $product_name = $row['product_name'];
                                $img_link = $row['product_img'];
                                $price = $row['product_price'];
                                $description = $row['product_txt'];                                
                            }
                        }
                    } catch (Exception $e) { 
                        $message = '<p class="error">' . $e->getMessage() . '</p>'; 
                    } 
                    echo $message;
                ?>
                <figure class="img">
                    <?php echo '<img class="img_promo" src="'.$img_link.'" alt="'.$product_name.'">'; ?>                    
                </figure>
            </div>
            <form class="info_container" action="index.php" method="get">
                <div>
                    <!-- <h2>Description</h2> -->
                    <p><?php echo $description; ?></p>
                    <P>Prix: <?php echo $price; ?>€</p>
                    <input type="hidden" id="product_id" name="pid" value="<?php echo $product_id; ?>">
                    <button class="buttonClass btn_margin_top" type="submit" id="btn" name="add">Ajouter au panier</button>
                    <p><?php echo $message; ?></p>
                </div>
            </form>
            <div class="cart_container">
                <h2>Panier</h2>
                <table class="cart_table"> 
                    <tr><th></th><th>Qté</th><th>Prix</th></tr>            
                    <?php
                        if(isset($cart_dataset)) {
                            if ($cart_dataset->num_rows > 0) {
                                while($row = $cart_dataset->fetch_assoc()) {
                                    $pName = $row['product_name'];
                                    $pqte = $row['qte'];
                                    $price = $row['product_price'];
                                    echo '<tr><td>' . $pName . '</td><td>' . $pqte . '</td><td>' . $price . '€</td></tr>';
                                }
                            } else { echo '<tr><td>Panier vide</td><td>0.00€</td></tr>'; }
                        } else { echo '<tr><td>Panier vide</td><td>0.00€</td></tr>'; }
                    ?>
                </table>
                <form action='cart.php' method='post'>
                    <button class="buttonClass" id="btn" name="cart">Aller au panier</button>
                </form>
                <form action='index.php' method='get'>
                    <button class="buttonClass btn_margin_top" id="btn" name="empty">Vider le panier</button>
                </form>
                <!-- no action implemented for payement yet -->
                <button class="buttonClass btn_margin_top" id="btn" name="cart">Payer</button>
            </div>
        </main>
        <footer>
                <a href="#about">À propos</a>
                <a href="#contact">Contact</a>
        </footer>
        <?php   require './php/freeSrc.php'; ?>
    </body>
</html>