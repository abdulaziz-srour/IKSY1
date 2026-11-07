<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 4.4 mit Schleife</title>
</head>
<body>
	<h1>Summe der ersten n negativen Zahlen</h1>
	<?php
        $n = $_POST["n"];
        $summe = 0;
        for($i = 1; $i <= $n; $i++) {
            $summe -= $i;
        }
        echo ("<p>Die Summe der ersten $n negativen Zahlen ist: $summe</p>");
    ?>
</body>
</html>