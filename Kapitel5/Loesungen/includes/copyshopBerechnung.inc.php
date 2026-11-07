<?php
    // copyshopBerechnung.inc.php
    $anzahlSeiten = $_POST["anzahlSeiten"];
    $anzahlExemplare = $_POST["anzahlExemplare"];
    
    $gesamtKopierkosten = $preisProSeite * $anzahlSeiten * $anzahlExemplare;
    $gesamtBindung = $preisBindungProExemplar * $anzahlExemplare;
    $gesamtpreis = $gesamtKopierkosten + $gesamtBindung;
?>