<?php
    //funktionenMax2.php
    require_once("./includes/startTemplate.inc.php");
    require_once("./includes/mathematischeFunktionen.inc.php");

    $ersteZahl=7;
    $zweiteZahl=10;
    $max1=berechneMaximum($ersteZahl, $zweiteZahl);

    $a=1;
    $b=-4;
    $max2=berechneMaximum($a, $b);

    $a=1;
    $b=-4;
    $max3=berechneMaximum($b, $a);

    $smarty->assign("max1", $max1);
    $smarty->assign("max2", $max2);
    $smarty->assign("max3", $max3);
    $smarty->display('funktionenMax1.tpl');
?>