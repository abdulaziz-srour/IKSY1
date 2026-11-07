<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- addition2php.php -->
    <title>Addition mit Eingabe in php (Teil 2)</title>
</head>
<body>
    <h2>
        Addition zweier Zahlen: Das Ergebnis
    </h2>
    <?php
        $ersterSummand=$_POST['ersterSummand'];
        $zweiterSummand=$_POST['zweiterSummand'];
        $summe=$ersterSummand+$zweiterSummand;
        echo("Die Summe von $ersterSummand und $zweiterSummand
                        ist: $summe");
    ?>
</body>
</html>