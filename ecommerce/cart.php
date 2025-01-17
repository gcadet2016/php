<!DOCTYPE html>
<html lang="fr" id="home">
    <!-- dev url: http://php.localhost/ecommerce/cart.php -->
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
        <link rel="stylesheet" type="text/css" href="./css/cart.css">
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
                <img src="img/cart-8-48.png" alt="User" class="usrIco">
                <a href="cart.php">
                    <?php
                    echo $pCount;
                    ?>
                </a>
            </nav>
        </header>
        <main>
            <h1>Panier</h1>
            <table class="cart_table"> 
                <tr><th></th><th>Nom</th><th>Qté</th><th>Prix</th></tr>            
                <?php
                    $total_price = 0;
                    if(isset($cart_dataset)) {
                        if ($cart_dataset->num_rows > 0) {
                            while($row = $cart_dataset->fetch_assoc()) {
                                $img_link = $row['product_img'];
                                $pName = $row['product_name'];
                                $pqte = $row['qte'];
                                $price = $row['product_price'];
                                $total_price += $pqte * $price;
                                echo '<tr><td><img class="product_icon" src="'.$img_link.'" alt="'.$pName.'"></td><td>' . $pName . '</td><td>' . $pqte . '</td><td>' . $price . '€</td></tr>';
                            }
                        } else { echo '<tr><td></td><td>Panier vide</td><td>0</td><td>0.00€</td></tr>'; }
                    } else { echo '<tr><td></td><td>Panier vide</td><td>0</td><td>0.00€</td></tr>'; }
                    echo '<tr><td></td><td></td><td>Total</td><td>'. $total_price .'€</td></tr>';
                ?>
            </table>

            <!-- no action implemented for payement yet -->
            <button class="buttonClass btn_margin_top" id="btn" name="cart">Payer</button>
        </main>
        <footer>
                <a href="#about">À propos</a>
                <a href="#contact">Contact</a>
        </footer>
    </body>
    <?php   require './php/freeSrc.php'; ?>
</html>