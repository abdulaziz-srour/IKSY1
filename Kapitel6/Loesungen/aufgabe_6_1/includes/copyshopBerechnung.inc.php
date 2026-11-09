<?php
    /* 
     * Dateiname:copyshopBerechnung.inc.php
     * Zweck: Berechnet Kopierkosten, Bindung und Gesamtpreis
     * Autor: Abdulaziz Srour
     */
    $anzahlSeiten = $_POST["anzahlSeiten"];
    $anzahlExemplare = $_POST["anzahlExemplare"];
    
    // Kopierkosten: alle Seiten aller Exemplare mal Seitenpreis
    $gesamtKopierkosten = $preisProSeite * $anzahlSeiten * $anzahlExemplare;
    // Bindung: alle Exemplare mal Bindungspreis
    $gesamtBindung = $preisBindungProExemplar * $anzahlExemplare;
    // Gesamtpreis: Kopierkosten plus Bindung
    $gesamtpreis = $gesamtKopierkosten + $gesamtBindung;
?>