<?php
    // subtraktion.inc.php
    $minuend = $_POST["minuend"];
    $subtrahend = $_POST["subtrahend"];
    $ergebnis = $minuend - $subtrahend;
    
    echo ("<p>$minuend - $subtrahend = $ergebnis</p>");
?>