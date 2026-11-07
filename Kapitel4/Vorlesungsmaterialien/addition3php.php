<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- addition3php.php -->
    <title>Addition mit Eingabe in php (Teil 2)</title>
</head>
<body>
    <h2>
        Aufsummierung natürlicher Zahlen: Das Ergebnis
    </h2>
    <?php
        $bisZu=$_POST['bisZu'];
        $summe=0;
        for ($i=1; $i<=$bisZu; $i++)
        {
            $summe=$summe+$i;
        }
        echo("Die Summe der ersten $bisZu natürlichen Zahlen ist: $summe");
    ?>
</body>
</html>