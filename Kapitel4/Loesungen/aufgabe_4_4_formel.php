<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 4.4 ohne Schleife</title>
</head>
<body>
	<h1>Summe der ersten n negativen Zahlen</h1>
	<?php
        $n = $_POST["n"];
        $summe = -($n * ($n + 1) / 2);
        echo ("<p>Die Summe der ersten $n negativen Zahlen ist: $summe</p>");
    ?>
</body>
</html>