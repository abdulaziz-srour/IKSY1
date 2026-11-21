<?php
    require_once("./includes/startTemplate.inc.php");
    require_once("./includes/copyshopKonstanten.inc.php");
    require_once("./includes/pruefFunktionen.inc.php");
    require_once("./includes/copyshopFunktionen.inc.php");
    
    $PHP_SELF = $_SERVER['PHP_SELF'];
    $REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
    
    if ($REQUEST_METHOD != "POST") {
        $smarty -> assign('PHP_SELF', $PHP_SELF);
        
        $smarty -> assign("minAnzahl", MIN_ANZAHL);
        $smarty -> assign("maxAnzahlSeiten", MAX_ANZAHL_SEITEN);
        $smarty -> assign("maxAnzahlExemplare", MAX_ANZAHL_EXEMPLARE);
    } else {
        $anzahlSeiten = $_POST["anzahlSeiten"];
        $anzahlExemplare = $_POST["anzahlExemplare"];
        $papierformat = $_POST["papierformat"];
        $istBindung = isset($_POST["istBindung"]);
        
        $eingabeKorrekt = istZahlImBereich($anzahlSeiten, MIN_ANZAHL, MAX_ANZAHL_SEITEN);
        $eingabeKorrekt = $eingabeKorrekt && istZahlImBereich($anzahlExemplare, MIN_ANZAHL, MAX_ANZAHL_EXEMPLARE);
        $eingabeKorrekt = $eingabeKorrekt && istGueltigesFormat($papierformat);
        
        if(!$eingabeKorrekt) {
            $smarty -> assign("fehler", true);
        } else {
            $preisProSeite = ermittlePreisProSeite($papierformat);
            
            $gesamtKopierkosten = berechneKopierkosten($anzahlSeiten, $anzahlExemplare, $preisProSeite);
            $rabattGewaehrt = istRabattGewaehrt($anzahlSeiten, $anzahlExemplare);
            $gesamtBindung = berechneBindungskosten($anzahlExemplare, $istBindung);
            
            $nettopreis = $gesamtKopierkosten + $gesamtBindung;
            $mehrwertsteuer = berechneMehrwertsteuer($nettopreis);
            $bruttopreis = $nettopreis + $mehrwertsteuer;
            
            $smarty -> assign("preisProSeite", $preisProSeite);
            $smarty -> assign("preisBindungProExemplar", PREIS_BINDUNG_PRO_EXEMPLAR);
            $smarty -> assign("mehrwertsteuerProzent", MEHRWERTSTEUER_PROZENT);
            $smarty -> assign("rabattGewaehrt", $rabattGewaehrt);
            $smarty -> assign("mengenrabattProzent", MENGENRABATT_PROZENT);
            $smarty -> assign("mengenrabattKopien", MENGENRABATT_KOPIEN);
            
            $smarty -> assign("gesamtKopierkosten", $gesamtKopierkosten);
            $smarty -> assign("gesamtBindung", $gesamtBindung);
            $smarty -> assign("nettopreis", $nettopreis);
            $smarty -> assign("mehrwertsteuer", $mehrwertsteuer);
            $smarty -> assign("bruttopreis", $bruttopreis);
        }
    }
    
    $smarty -> display('loesung.tpl');
?>