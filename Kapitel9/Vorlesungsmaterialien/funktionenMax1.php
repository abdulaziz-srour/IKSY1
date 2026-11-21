<?php
    //funktionenMax1.php
    require_once("./includes/startTemplate.inc.php");
    
    # Funktion deklarieren
    function berechneMaximum($a, $b)
    {
        if ($a>=$b)
        {
            $max=$a;
        }
        else
        {
            $max=$b;
        }
        return $max;
    }

    #Erster Funktionaufruf
    $ersteZahl=7;
    $zweiteZahl=10;
    $max1=berechneMaximum($ersteZahl, $zweiteZahl);

    #Zweiter Funktionsaufruf
    $a=1;
    $b=-4;
    $max2=berechneMaximum($a, $b);

    #Dritter Funktionsaufruf
    $a=1;
    $b=-4;
    $max3=berechneMaximum($b, $a);

    #Ergebnisse an Smarty übergeben und Ausgabe des templates
    $smarty->assign("max1", $max1);
    $smarty->assign("max2", $max2);
    $smarty->assign("max3", $max3);
    $smarty->display('funktionenMax1.tpl');
?>