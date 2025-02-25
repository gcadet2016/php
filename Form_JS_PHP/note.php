<?php
    // Définir le statut HTTP à 200 OK
    http_response_code(200);

    // Définir le type de contenu à HTML
    header('Content-Type: text/html; charset=utf-8');
    // Créer un dictionnaire
    $dictionnaire = array(
        "do" => "C",
        "ré" => "D",
        "mi" => "E",
        "fa" => "F",
        "sol" => "G",
        "la" => "A",
        "si" => "B"
    );
    if(isset($_GET['note'])) {
        $note = $_GET['note'];
    }
    echo $dictionnaire[$note];
?>
