<?php
    if ($cart_dataset) { $cart_dataset->free(); }
    if ($count_dataset) { $count_dataset->free(); }
    if ($result) { $result->free(); }
    // Fermer la connexion si elle a été établie 
    if ($SQLconn) { $SQLconn->close(); }
?>