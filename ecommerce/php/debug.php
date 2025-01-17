<?php 
    $DEBUG = True;
    // Attention à placer l'appel de cette fonction dans un endroit judicieux de la page HTML !
    function debugLog($msg) { 
        global $DEBUG;
        if ($DEBUG == 1) {
            echo '<script>console.log("' . $msg . '");</script>';
        }
    }
    function debugMsg($msg) { 
        global $DEBUG;
        if ($DEBUG) {
            echo '<script>alert("' . $msg . '");</script>';
        }
    }
?>