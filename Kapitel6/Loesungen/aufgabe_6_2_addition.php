<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 6.2 Addition</title>
</head>
<body>
	<?php
    	/*
    	 * Autor: Abdulaziz Srour
    	 * Zweck: Addition zweier Zahlen
    	 * Dateiname: aufgabe_6_2_addition.php
    	 */
        $ersterSummand = $_POST["ersterSummand"];
        $zweiterSummand = $_POST["zweiterSummand"];
        $ergebnis = $ersterSummand + $zweiterSummand;
        
        echo("<p>Die Summe von $ersterSummand und $zweiterSummand ist: $ergebnis</p>");
        echo("<p>Die Summe von " .$ersterSummand. " und " .$zweiterSummand. " ist: " .$ergebnis."</p>");
	?>
</body>
</html>