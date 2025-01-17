<!DOCTYPE html>
<html lang="fr" id="home">
    <!-- dev url: http://php.localhost/ecommerce/search.php -->
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
        <link rel="stylesheet" type="text/css" href="./css/search.css">
        <script> 
            function submitForm(row) { 
                var form = document.getElementById('myForm'); 
                var hiddenInput = document.getElementById('selectedRow'); 
                hiddenInput.value = row.dataset.value; 
                form.submit(); 
            } 
        </script>
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
            <?php
                if(isset($_GET['search'])) {
                    $keyword = $_GET['search'];
                    try {
                        $sql = "SELECT product_id, product_name, product_price, product_img FROM products WHERE product_name like '%" . $keyword . "%'";
                        debugLog($sql);
                        $result = $SQLconn->query($sql);
                    } catch (Exception $e) { 
                        debugLog('SQL SELECT failed');
                        debugLog($e->getMessage());
                        $message = '<p class="error">' . $e->getMessage() . '</p>'; 
                    }
                }
            ?>
            <h1>Produits</h1>
            <p>Cliquer sur le produit pour accéder aux détails.</p>
            <form id="myForm" action="/ecommerce/index.php" method="get">
                <input type="hidden" id="selectedRow" name="details" value="">
                <table class="search_table"> 
                    <tr><th></th><th>Nom</th><th>Prix</th></tr>            
                    <?php
                        $total_price = 0;
                        if(isset($result)) {
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $pid = $row['product_id'];
                                    $img_link = $row['product_img'];
                                    $pName = $row['product_name'];
                                    $price = $row['product_price'];
                                    echo '<tr data-value="' . $pid . '" onclick="submitForm(this)"><td><img class="product_icon" src="'.$img_link.'" alt="'.$pName.'"></td><td>' . $pName . '</td><td>' . $price . '€</td></tr>';
                                }
                            } else { echo '<tr><td></td><td>Aucun produit trouvé</td><td>0.00€</td></tr>'; }
                        } else { echo '<tr><td></td><td>Aucun produit trouvé</td><td>0.00€</td></tr>'; }
                    ?>
                </table>
                <!-- <button class="buttonClass btn_margin_top" type="submit" id="btn" name="pid">Ajouter au panier</button> -->
            </form>           
            
        </main>
        <footer>
                <a href="#about">À propos</a>
                <a href="#contact">Contact</a>
        </footer>
    </body>
    <?php   require './php/freeSrc.php'; ?>
</html>