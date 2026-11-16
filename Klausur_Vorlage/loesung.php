<?php
    define("MAX_GRENZE", 100);
    require_once("./includes/startTemplate.inc.php");
    $ueberschrift = "Klausur-Vorlage";
    
    $smarty -> assign("maxGrenze", MAX_GRENZE);
    $smarty -> assign("ueberschrift", $ueberschrift);
    
    $smarty -> display('loesung.tpl');
?>