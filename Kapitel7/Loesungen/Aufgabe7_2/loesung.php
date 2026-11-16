<?php
    require_once ("./includes/copyshopKonstanten.inc.php");
    require_once("./includes/startTemplate.inc.php");
    
    $anzahlSeiten = $_POST["anzahlSeiten"];
    $anzahlExemplare = $_POST["anzahlExemplare"];
    
    $gesamtKopierkosten = PREIS_PRO_SEITE * $anzahlSeiten * $anzahlExemplare;
    $gesamtBindung = PREIS_BINDUNG_PRO_EXEMPLAR * $anzahlExemplare;
    $nettopreis = $gesamtKopierkosten + $gesamtBindung;
    $mehrwertsteuer = $nettopreis * (MEHRWERTSTEUER_PROZENT/100);
    $bruttopreis = $nettopreis + $mehrwertsteuer;
    
    $smarty -> assign("preisProSeite", PREIS_PRO_SEITE);
    $smarty -> assign("preisBindungProExemplar", PREIS_BINDUNG_PRO_EXEMPLAR);
    $smarty -> assign("mehrwertsteuerProzent", MEHRWERTSTEUER_PROZENT);
    
    $smarty -> assign("gesamtKopierkosten", $gesamtKopierkosten);
    $smarty -> assign("gesamtBindung", $gesamtBindung);
    $smarty -> assign("nettopreis", $nettopreis);
    $smarty -> assign("mehrwertsteuer", $mehrwertsteuer);
    $smarty -> assign("bruttopreis", $bruttopreis);
    
    $smarty -> display('loesung.tpl');
?>