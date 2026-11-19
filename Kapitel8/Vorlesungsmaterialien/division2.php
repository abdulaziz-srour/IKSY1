<?php
    //division2.php
    require_once("./includes/startTemplate.inc.php");

    $zaehler=$_POST['zaehler'];
    $nenner=$_POST['nenner'];

    if ($nenner==0)
    {
        $quotient="Versuch durch Null zu teilen!";
    }
    else
    {
        $quotient=$zaehler/$nenner;
    }

    $smarty->assign('zaehler', $zaehler);
    $smarty->assign('nenner', $nenner);
    $smarty->assign('quotient', $quotient);
    $smarty->display('division2.tpl');
?>