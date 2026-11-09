<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- konstante.php -->
    <title>Konstantendemonstration</title>
</head>
<body>
    <h2>
        Konstantendemonstration
    </h2>
    <?php
        // Konstanten: jeder feste Wert genau einmal, mit Namen
        define("MEHRWERTSTEUERSATZ", 1.19);
        define("GEWINNSPANNE", 1.19);

        // Eingabe aus dem Formular konstante.html
        $einkaufspreis = $_POST['einkaufspreis'];

        // Berechnung
        $nettoVerkaufspreis = GEWINNSPANNE * $einkaufspreis;
        $bruttoVerkaufspreis = MEHRWERTSTEUERSATZ * $nettoVerkaufspreis;

        // Ausgabe: Konstanten und Variablen
        echo "Netto-Verkaufspreis: $nettoVerkaufspreis<br>";
        echo "Brutto-Verkaufspreis: $bruttoVerkaufspreis<br>";
        echo "Gerechnet mit Mehrwertsteuerfaktor " . MEHRWERTSTEUERSATZ;
    ?>
</body>
</html>
