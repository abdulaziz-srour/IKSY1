<?php
    //division2_1.php
    require_once("./includes/startTemplate.inc.php");
    
    $zaehler=$_POST['zaehler'];
    $nenner=$_POST['nenner'];
    
    if ($nenner==0) {
        $teilenDurchNullFehler=true;
        $smarty->assign('teilenDurchNullFehler', $teilenDurchNullFehler);
    }
    else {
        $quotient=$zaehler/$nenner;
        $smarty->assign('zaehler', $zaehler);
        $smarty->assign('nenner', $nenner);
        $smarty->assign('quotient', $quotient);
    }
    
    $smarty->display('division2_1.tpl');
?>