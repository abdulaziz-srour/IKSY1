<?php
    //produkte2.php
    require_once("./includes/startTemplate.inc.php");
    require_once("./includes/euroDollarUmrechnung2.inc.php");

    DEFINE('KURS', 1.1);
    $dollarpreisSeife=2;
    $dollarpreisZahnpasta=3.5;
    $dollarpreisZahnseide=4.5;

    $europreisSeife=euroDollarUmrechnung("Euro", $dollarpreisSeife, KURS);
    $europreisZahnpasta=euroDollarUmrechnung("Euro", $dollarpreisZahnpasta, KURS);
    $europreisZahnseide=euroDollarUmrechnung("Euro", $dollarpreisZahnseide, KURS);

    $smarty->assign('europreisSeife', $europreisSeife);
    $smarty->assign('europreisZahnpasta', $europreisZahnpasta);
    $smarty->assign('europreisZahnseide', $europreisZahnseide);
    $smarty->assign('dollarpreisSeife', $dollarpreisSeife);
    $smarty->assign('dollarpreisZahnpasta', $dollarpreisZahnpasta);
    $smarty->assign('dollarpreisZahnseide', $dollarpreisZahnseide);
    $smarty->display('produkte1.tpl');
?>