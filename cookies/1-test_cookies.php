<?php
    // url de test: http://php.localhost/cookies/1-test_cookies.php
    $heure_visite = date('d m y h:i:s');
    setcookie('date_visite', $heure_visite, time()+604800);
    if(isset($_COOKIE['date_visite'])) {
        if(isset($_COOKIE['nb_visite'])) {
            $nombre_visite = $_COOKIE['nb_visite'];
            $nombre_visite += 1;
        } else {
            $nombre_visite = 1;

        }
        $message = 'Bonjour, vous avez visité cette page '. $nombre_visite . ' fois';
        setcookie('nb_visite', $nombre_visite, time()+604800);
        $message .= '<br>Date de votre dernière visite: ' . $_COOKIE['date_visite'];
    } else {
        $message = 'Bonjour<br>C\'est votre preière visite sur cette page';
    }
?>
<h1>Test cookies</h1>
<p>
<?php
    if(isset($message)) {
        echo $message;
    }
?>
</p>