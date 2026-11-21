<?php
    define("MIN_GRENZE", 1);
    define("MAX_GRENZE", 100);
    
    require_once("./includes/startTemplate.inc.php");
    require_once("./includes/pruefFunktionen.inc.php");
    require_once("./includes/berechnungsFunktionen.inc.php");
    
    $PHP_SELF = $_SERVER['PHP_SELF'];
    $REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
    
    $ueberschrift = "Klausur-Vorlage";
    $smarty -> assign("ueberschrift", $ueberschrift);
    
    if($REQUEST_METHOD != "POST") {
        $smarty -> assign("PHP_SELF", $PHP_SELF);
        $smarty -> assign("minGrenze", MIN_GRENZE);
        $smarty -> assign("maxGrenze", MAX_GRENZE);
    } else {
        $zahl = $_POST["zahl"];
        $eingabeKorrekt = istZahlImBereich($zahl, MIN_GRENZE, MAX_GRENZE);
        
        if(!$eingabeKorrekt) {
            $smarty -> assign("fehler", true);
        } else {
            $ergebnis = berechneErgebnis($zahl);
            $smarty -> assign("ergebnis", $ergebnis);
        }
    }
    $smarty -> display('loesung.tpl');
?>
