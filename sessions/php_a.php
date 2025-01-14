<?php
    session_start();
    echo 'Session id:' . session_id() . '<br>';
    $_SESSION['test'] = 'my valeur de test'
?>
<a href="php_b.php">Lien vers page B</a>