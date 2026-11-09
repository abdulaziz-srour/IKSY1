<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- deklarationUndZuweisung.php -->
    <title>Deklaration von Variablen in php</title>
</head>
<body>
    <?php
        // keine Deklarationen, gibt es in php nicht
        $y=19;       // y deklariert, Wert 19 zugewiesen
        // y ist Integer-Variable mit Wert 19
        echo "Wert von y: $y <br>";
        // y wird ausgegeben
        // 19 erscheint im Browser
        $x=4.7;      // x den Wert 4.7 zugewiesen, x ist jetzt ein Float
        echo "Wert von x: $x <br>";
        // x wird ausgegeben
        // 4.7 erscheint im Browser
        $x="Datum";   // x ist jetzt String mit Wert "Datum"
        echo "Neuer Wert von x: $x <br>";
        // x wird ausgegeben
        // Datum erscheint im Browser
        $i="Test";   // i ist String mit Wert "Test"
        echo "Wert von i: $i <br>";
        // i wird ausgegeben
        // Test erscheint im Browser
        $z=4;       // ist Integer-Variable mit Wert 4
        echo "Wert von z:  $z <br>";
        // z wird ausgegeben
        // 4 erscheint im Browser
    ?>
</body>
</html>
