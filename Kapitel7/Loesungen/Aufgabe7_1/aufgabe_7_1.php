<?php
    define("ZINSSATZ", 5);
    define("TILGUNG", 1);
    define("ZINSSATZ_ZEIT_EINHEIT", 12);
    
    require_once("./includes/startTemplate.inc.php");

    $immobilienpreis = $_POST["immobilienpreis"];
    $eigenkapital = $_POST["eigenkapital"];
    
    $darlehensbetrag = $immobilienpreis - $eigenkapital;
    $monatlicheBelastung = $darlehensbetrag * (ZINSSATZ  + TILGUNG) / (ZINSSATZ_ZEIT_EINHEIT * 100);
    
    $smarty->assign("immobilienpreis", $immobilienpreis);
    $smarty->assign("eigenkapital", $eigenkapital);
    $smarty->assign("darlehensbetrag", $darlehensbetrag);
    $smarty->assign("monatlicheBelastung", $monatlicheBelastung);
    $smarty->display("aufgabe_7_1.tpl");
?>