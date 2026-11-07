<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 4.5</title>
</head>
<body>
	<?php
	   $warenwert = $_POST["warenwert"];
	   $rabattProzent = 15;
	   $rabatt = $warenwert * ($rabattProzent / 100);
	   $zuZahlen = $warenwert - $rabatt;
	   
	   echo ("<p>Warenwert: $warenwert €, Rabatt: $rabatt €, zu zahlen: $zuZahlen €</p>");
    ?>
</body>
</html>