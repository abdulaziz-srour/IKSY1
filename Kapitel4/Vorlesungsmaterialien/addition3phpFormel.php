<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- addition3phpFormel.php -->
    <title>Addition mit Eingabe in php (Teil 2)</title>
</head>
<body>
    <h2>
        Aufsummierung nat√ºrlicher Zahlen: Das Ergebnis
    </h2>
    <?php
        $bisZu=$_POST['bisZu'];
        $summe=($bisZu*($bisZu+1))/2;
        echo("Die Summe der ersten $bisZu nat¸rlichen Zahlen ist: $summe");
    ?>
</body>
</html>