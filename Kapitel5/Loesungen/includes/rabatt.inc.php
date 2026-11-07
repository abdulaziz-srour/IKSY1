<?php
    // rabatt.inc.php
    $warenwert = $_POST["warenwert"];
    $rabattProzent = 15;
    $rabatt = $warenwert * ($rabattProzent / 100);
    $zuZahlen = $warenwert - $rabatt;
    
    echo ("<p>Warenwert: $warenwert €, Rabatt: $rabatt €, zu zahlen: $zuZahlen €</p>");
?>