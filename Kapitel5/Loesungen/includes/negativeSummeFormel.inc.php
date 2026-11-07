<?php
    // negativeSummeFormel.inc.php
    $n = $_POST["n"];
    $summe = -($n * ($n + 1) / 2);
    echo ("<p>Die Summe der ersten $n negativen Zahlen ist: $summe</p>");
?>