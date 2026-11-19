<?php
    define("TILGUNG_PROZENT", 1);
    define("MONATE_PRO_JAHR", 12);
    define("EIGENKAPITALQUOTE_GRENZE_HOCH", 60);
    define("EIGENKAPITALQUOTE_GRENZE_MITTEL", 50);
    define("EIGENKAPITAL_MINDESTQUOTE", 30);
    define("ZINSSATZ_PROZENT_QUOTE_HOCH", 4);
    define("ZINSSATZ_PROZENT_QUOTE_MITTEL", 4.5);
    define("ZINSSATZ_PROZENT_STANDARD", 5);
    define("MIN_IMMOBILIENPREIS", 1);
    define("MIN_EIGENKAPITAL", 0);
    
    require_once("./includes/startTemplate.inc.php");
    
    $PHP_SELF = $_SERVER['PHP_SELF'];
    $REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
    
    if($REQUEST_METHOD != "POST") {
        $smarty -> assign("PHP_SELF", $PHP_SELF);
        $smarty -> assign("minImmobilienpreis", MIN_IMMOBILIENPREIS);
        $smarty -> assign("minEigenkapital", MIN_EIGENKAPITAL);
    } else {
        $immobilienpreis = $_POST["immobilienpreis"];
        $eigenkapital = $_POST["eigenkapital"];
        
        $eingabeKorrekt = is_numeric($immobilienpreis);
        $eingabeKorrekt = $eingabeKorrekt && $immobilienpreis >= MIN_IMMOBILIENPREIS;
        $eingabeKorrekt = $eingabeKorrekt && is_numeric($eigenkapital);
        $eingabeKorrekt = $eingabeKorrekt && $eigenkapital >= MIN_EIGENKAPITAL;
        $eingabeKorrekt = $eingabeKorrekt && $eigenkapital <= $immobilienpreis;
        
        if(!$eingabeKorrekt) {
            $smarty->assign("fehler", true);
        } else {
            $eigenkapitalquote = $eigenkapital / $immobilienpreis * 100;
            $finanzierbar = true;
            
            if($eigenkapitalquote >= EIGENKAPITALQUOTE_GRENZE_HOCH) {
                $zinssatzProzent = ZINSSATZ_PROZENT_QUOTE_HOCH;
            } elseif($eigenkapitalquote >= EIGENKAPITALQUOTE_GRENZE_MITTEL) {
                $zinssatzProzent = ZINSSATZ_PROZENT_QUOTE_MITTEL;
            } elseif($eigenkapitalquote >= EIGENKAPITAL_MINDESTQUOTE) {
                $zinssatzProzent = ZINSSATZ_PROZENT_STANDARD;
            } else {
                $finanzierbar = false;
            }
            
            if(!$finanzierbar) {
                $smarty->assign("eigenkapitalquoteZuGering", true);
                $smarty->assign("eigenkapitalquote", $eigenkapitalquote);
                $smarty->assign("eigenkapitalMindestquote", EIGENKAPITAL_MINDESTQUOTE);
            } else {
                $darlehensbetrag = $immobilienpreis - $eigenkapital;
                $monatlicheBelastung = $darlehensbetrag * ($zinssatzProzent + TILGUNG_PROZENT) / 100 / MONATE_PRO_JAHR;
                
                $smarty->assign("immobilienpreis", $immobilienpreis);
                $smarty->assign("eigenkapital", $eigenkapital);
                $smarty->assign("eigenkapitalquote", $eigenkapitalquote);
                $smarty->assign("darlehensbetrag", $darlehensbetrag);
                $smarty->assign("monatlicheBelastung", $monatlicheBelastung);
                $smarty->assign("zinssatzProzent", $zinssatzProzent);
                $smarty->assign("tilgungProzent", TILGUNG_PROZENT);
            }
        }
    }
    $smarty -> display('loesung.tpl');
?>
