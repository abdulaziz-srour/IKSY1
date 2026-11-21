<?php
    //euro3.php
    require_once("./includes/startTemplate.inc.php");
    require_once("./includes/euroDollarUmrechnung.inc.php");

    $PHP_SELF=$_SERVER['PHP_SELF'];
    $REQUEST_METHOD=$_SERVER['REQUEST_METHOD'];

    if ($REQUEST_METHOD!="POST")
    {
        $smarty->assign('PHP_SELF', $PHP_SELF);
    }
    else
    {
        $kurs=$_POST['kurs'];
        $zielwaehrung=$_POST['zielwaehrung'];
        $betrag=$_POST['betrag'];
        
        $umrechnungsBetrag=euroDollarUmrechnung($zielwaehrung, $betrag, $kurs);
        
        if (!is_numeric($umrechnungsBetrag))
        {
            $waehrungFehler=true;
            $smarty->assign('waehrungFehler', $waehrungFehler);
        }
        
        $smarty->assign('zielwaehrung', $zielwaehrung);
        $smarty->assign('betrag', $betrag);
        $smarty->assign('umrechnungsBetrag', $umrechnungsBetrag);
    }
    $smarty->display('euro2.tpl');
?>