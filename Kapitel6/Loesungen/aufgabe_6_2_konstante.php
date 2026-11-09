<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 6.2 Konstante</title>
</head>
<body>
<?php
    define("MEHRWERTSTEUER", 19);
    define("GEWINNSPANNE", 25);
    $einkaufspreis = $_POST["einkaufspreis"];
    $nettoVerkaufspreis= $einkaufspreis * (1 + GEWINNSPANNE/100);
    $bruttoVerkaufspreis= $nettoVerkaufspreis * (1 + MEHRWERTSTEUER/100);
    
    echo("<p>Netto-Verkaufspreis (Gewinnspanne ".GEWINNSPANNE."%): $nettoVerkaufspreis €</p>");
    echo("<p>Brutto-Verkaufspreis (Mehrwertsteuer ".MEHRWERTSTEUER."%): $bruttoVerkaufspreis €</p>");
?>
</body>
</html>