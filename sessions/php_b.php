<?php
    session_start();
    echo 'Session id:' . session_id() . '<br>';
    echo $_SESSION['test'];
?>
