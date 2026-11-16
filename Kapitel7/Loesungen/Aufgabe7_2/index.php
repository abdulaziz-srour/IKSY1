<?php
    require_once("./includes/copyshopKonstanten.inc.php");
    require_once("./includes/startTemplate.inc.php");
    
    $smarty -> assign("minAnzahl", MIN_ANZAHL);
    $smarty -> assign("maxAnzahlSeiten", MAX_ANZAHL_SEITEN);
    $smarty -> assign("maxAnzahlExemplare", MAX_ANZAHL_EXEMPLARE);
    
    $smarty -> display('index.tpl');
?>