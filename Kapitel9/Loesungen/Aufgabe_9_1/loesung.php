<?php
    define("MEHRWERTSTEUERSATZ", 19);
    
    require_once("./includes/startTemplate.inc.php");
    require_once("./includes/bruttoFunktionen.inc.php");
    
    $netto = 1000;
    $smarty -> assign("nettoVorher", $netto);
    
    $ersterBruttoWert = berechneBrutto($netto);
    $smarty -> assign("ersterWert", $ersterBruttoWert);
    
    $zweiterBruttoWert = berechneBruttoMitAnderemParameter($netto);
    $smarty -> assign("zweiterWert", $zweiterBruttoWert);
    
    $brutto = 0;
    berechneBruttoOhneReferenz($netto, $brutto);
    $smarty -> assign("dritterWert", $brutto);
    
    berechneBruttoMitReferenz($netto, $brutto);
    $smarty -> assign("vierterWert", $brutto);
    
    $bruttoVertauscht = 0;
    berechneBruttoMitReferenz($bruttoVertauscht, $netto);
    $smarty -> assign("vertauschtesBruttoErgebnis", $bruttoVertauscht);
    $smarty -> assign("vertauschtesNettoErgebnis", $netto);
    
    
    $smarty -> display("loesung.tpl");
?>