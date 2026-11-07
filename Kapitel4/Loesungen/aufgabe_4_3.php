<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 4.3</title>
</head>
<body>
	<h1>Ergebnis</h1>
	<?php
        $minuend = $_POST["minuend"];
        $subtrahend = $_POST["subtrahend"];
        $ergebnis = $minuend - $subtrahend;
        
        echo ("<p>$minuend - $subtrahend = $ergebnis</p>");
    ?>
</body>
</html>
