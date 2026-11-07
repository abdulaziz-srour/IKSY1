<?php
    // negativeSummeSchleife.inc.php
    $n = $_POST["n"];
    $summe = 0;
    for($i = 1; $i <= $n; $i++) {
        $summe -= $i;
    }
    echo ("<p>Die Summe der ersten $n negativen Zahlen ist: $summe</p>");
?>