<?php
    
    if(isset($_COOKIE['cart'])) {
        // Cookie exists
        $cookie_cart = $_COOKIE['cart'];
        $cookie_cart = unserialize($cookie_cart);
        $user_id = $cookie_cart['user_id'];
        $cart_id = $cookie_cart['cart_id']; 
        $p_count = $cookie_cart['product_count'];        
    } else {
        // cart cookie doesn't exist. let's create it.
        $cart_id = uniqid();
        $cookie_cart['cart_id'] = $cart_id;
    }
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }
    $user_id='0';
    debugLog('user_id='.$user_id);
    debugLog('cart_id='.$cart_id);

    if(isset($_GET['pid'])) {
        // User is adding a product to the cart
        $product_id = $_GET['pid'];
        try {
            $sql = "INSERT INTO cart (cart_id, user_id, product_id) VALUES ('" . $cart_id ."', '" . $user_id . "', '" . $product_id ."' )"; 
            debugLog($sql);
            if ($SQLconn->query($sql) === TRUE) { 
                $message = '<p class="success">Ajouté au panier.</p>';
            } else {
                $message = '<p class="error">Echec de l\'ajout au panier.</p>';
                debugLog('Echec de l\'ajout au panier.');
            }
        } catch (Exception $e) { 
            debugLog('SQL INSERT failed');
            debugLog($e->getMessage());
            $message = '<p class="error">' . $e->getMessage() . '</p>'; 
        } finally {
            # Avoid to add another product when refreshing web page
            header('location:index.php');
            exit();
        }
    }
    if(isset($_GET['empty'])) {
        // Empty the cart and delete cookie
        $sqlQuery = "DELETE * FROM cart where cart_id = " . $cart_id;
        setcookie('cart', '', time() - 3600);
    } else {
        # Update cookies and load data
        $pCount = 0;
        try {
            $sql = "SELECT COUNT(product_id) AS qte FROM cart WHERE cart_id = '" . $cart_id . "'";
            debugLog($sql);
            $count_dataset = $SQLconn->query($sql);
            if(isset($count_dataset)) {
                if ($count_dataset->num_rows > 0) {
                    while($row = $count_dataset->fetch_assoc()) {
                        $pCount = $row['qte'];
                    }
                } 
            }
        } catch (Exception $e) { 
            debugLog('Product count failed');
            debugLog($e->getMessage());
            $message = '<p class="error">' . $e->getMessage() . '</p>'; 
        }

        $cookie_cart['product_count'] = $pCount;
        $cookie_cart['user_id'] = $user_id;
        $cookie_cart = serialize($cookie_cart);
        setcookie('cart', $cookie_cart, time() + 1296000);    # 3600 * 24 * 15 = 1296000 = 15 days

        // Load cart dataset
        try {
            $sql = "SELECT pr.product_id, pr.product_name, pr.product_price, pr.product_img, COUNT(pr.product_id) AS qte FROM cart AS ct INNER JOIN products AS pr ON ct.product_id = pr.product_id WHERE ct.cart_id = '" . $cart_id . "' GROUP BY pr.product_id";
            debugLog($sql);
            $cart_dataset = $SQLconn->query($sql);
        } catch (Exception $e) { 
            debugLog('SQL SELECT failed');
            debugLog($e->getMessage());
            $message = '<p class="error">' . $e->getMessage() . '</p>'; 
        }
    }
?>