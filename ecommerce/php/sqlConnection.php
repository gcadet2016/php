<?php
    // Informations de connexion à la base de données 
    $servername = "localhost"; 
    $username = "phpusr"; 
    $password = "FR@4m:We9!"; 
    $dbname = "projet_ecommerce"; 

    // Créer une connexion 
    try {
        $SQLconn = new mysqli($servername, $username, $password, $dbname); 
    } catch (Exception $e) { 
        $message = '<p class="error">' . $e->getMessage() . '</p>'; 
    } 
?>