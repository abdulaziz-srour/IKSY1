<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- plusOperator.php -->
    <title>+- und .-Operator in php</title>
</head>
<body>
    <?php
        $s1="ab";
        $s2="cd";
        $i=5;
        $j="6";
        $ergebnis=$s1+$s2; // Fehler!
        echo "ergebnis1: $ergebnis <br>";
        $ergebnis=$s1 . $s2;
        echo "ergebnis2: $ergebnis <br>";
        $ergebnis=$s1+$i;  // Fehler!
        echo "ergebnis3: $ergebnis <br>";
        $ergebnis=$s1 . $i;
        echo "ergebnis4: $ergebnis <br>";
        $ergebnis=$j . $i;
        echo "ergebnis5: $ergebnis <br>";
        $ergebnis=$j+$i; // kein Fehler
        echo "ergebnis6: $ergebnis <br>";
    ?>
</body>
</html>

