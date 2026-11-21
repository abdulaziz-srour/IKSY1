<?php
    define("ZINSSATZ_PROZENT", 5);
    define("TILGUNG_PROZENT", 1);
    define("MONATE_PRO_JAHR", 12);
    define("EIGENKAPITAL_MINDESTQUOTE", 30);
    define("MIN_IMMOBILIENPREIS", 1);
    define("MIN_EIGENKAPITAL", 0);
    
    require_once("./includes/startTemplate.inc.php");
    require_once("./includes/darlehenFunktionen.inc.php");
    require_once("./includes/pruefFunktionen.inc.php");
    
    $PHP_SELF = $_SERVER['PHP_SELF'];
    $REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
    
    if($REQUEST_METHOD != "POST") {
        $smarty -> assign("PHP_SELF", $PHP_SELF);
        $smarty -> assign("minImmobilienpreis", MIN_IMMOBILIENPREIS);
        $smarty -> assign("minEigenkapital", MIN_EIGENKAPITAL);
    } else {
        $immobilienpreis = $_POST["immobilienpreis"];
        $eigenkapital = $_POST["eigenkapital"];
        
        $eingabeKorrekt = istZahlAbMinimum($immobilienpreis, MIN_IMMOBILIENPREIS);
        $eingabeKorrekt = $eingabeKorrekt && istZahlImBereich($eigenkapital, MIN_EIGENKAPITAL, $immobilienpreis);
        
        if(!$eingabeKorrekt) {
            $smarty->assign("fehler", true);
        } else {
            $eigenkapitalquote = berechneEigenkapitalquote($eigenkapital, $immobilienpreis);
            
            if($eigenkapitalquote < EIGENKAPITAL_MINDESTQUOTE) {
                $smarty->assign("eigenkapitalquoteZuGering", true);
                $smarty->assign("eigenkapitalquote", $eigenkapitalquote);
                $smarty->assign("eigenkapitalMindestquote", EIGENKAPITAL_MINDESTQUOTE);
            } else {
                $darlehensbetrag = berechneDarlehensbetrag($immobilienpreis, $eigenkapital);
                $monatlicheBelastung = berechneMonatlicheBelastung($darlehensbetrag, ZINSSATZ_PROZENT, TILGUNG_PROZENT);
                
                $smarty->assign("immobilienpreis", $immobilienpreis);
                $smarty->assign("eigenkapital", $eigenkapital);
                $smarty->assign("darlehensbetrag", $darlehensbetrag);
                $smarty->assign("monatlicheBelastung", $monatlicheBelastung);
                $smarty->assign("eigenkapitalquote", $eigenkapitalquote);
                $smarty->assign("zinssatzProzent", ZINSSATZ_PROZENT);
                $smarty->assign("tilgungProzent", TILGUNG_PROZENT);
            }
        }
    }
    $smarty -> display('loesung.tpl');
?>
