<?php
    require_once("./includes/copyshopKonstanten.inc.php");
    require_once("./includes/startTemplate.inc.php");
    
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
        
        $eingabeKorrekt = is_numeric($anzahlSeiten);
        $eingabeKorrekt = $eingabeKorrekt && $anzahlSeiten >= MIN_ANZAHL && $anzahlSeiten <= MAX_ANZAHL_SEITEN;
        $eingabeKorrekt = $eingabeKorrekt && is_numeric($anzahlExemplare);
        $eingabeKorrekt = $eingabeKorrekt && $anzahlExemplare >= MIN_ANZAHL && $anzahlExemplare <= MAX_ANZAHL_EXEMPLARE;
        
        switch($papierformat) {
            case "a3":
                $preisProSeite = PREIS_PRO_A3_SEITE;
                break;
            case "a4":
                $preisProSeite = PREIS_PRO_A4_SEITE;
                break;
            default:
                $eingabeKorrekt = false;
        }
        
        if(!$eingabeKorrekt) {
            $smarty -> assign("fehler", true);
        } else {
            $anzahlKopien = $anzahlSeiten * $anzahlExemplare;
            $rabattGewaehrt = $anzahlKopien >= MENGENRABATT_KOPIEN;
            if($rabattGewaehrt) {
                $gesamtKopierkosten = $preisProSeite * $anzahlKopien * (100 - MENGENRABATT_PROZENT) / 100;
            } else {
                $gesamtKopierkosten = $preisProSeite * $anzahlKopien;
            }
            
            $gesamtBindung = 0;
            if($istBindung) {
                $gesamtBindung = PREIS_BINDUNG_PRO_EXEMPLAR * $anzahlExemplare;
            }
            
            $nettopreis = $gesamtKopierkosten + $gesamtBindung;
            $mehrwertsteuer = $nettopreis * (MEHRWERTSTEUER_PROZENT/100);
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