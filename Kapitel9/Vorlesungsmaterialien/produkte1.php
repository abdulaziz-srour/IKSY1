<?php
    //produkte1.php
    require_once("./includes/startTemplate.inc.php");
    require_once("./includes/euroDollarUmrechnung.inc.php");

    DEFINE('KURS', 1.1);
    $europreisSeife=2;
    $europreisZahnpasta=3.5;
    $europreisZahnseide=4.5;

    $dollarpreisSeife=euroDollarUmrechnung("Dollar", $europreisSeife, KURS);
    $dollarpreisZahnpasta=euroDollarUmrechnung("Dollar", $europreisZahnpasta, KURS);
    $dollarpreisZahnseide=euroDollarUmrechnung("Dollar", $europreisZahnseide, KURS);

    $smarty->assign('europreisSeife', $europreisSeife);
    $smarty->assign('europreisZahnpasta', $europreisZahnpasta);
    $smarty->assign('europreisZahnseide', $europreisZahnseide);
    $smarty->assign('dollarpreisSeife', $dollarpreisSeife);
    $smarty->assign('dollarpreisZahnpasta', $dollarpreisZahnpasta);
    $smarty->assign('dollarpreisZahnseide', $dollarpreisZahnseide);
    $smarty->display('produkte1.tpl');
?>
