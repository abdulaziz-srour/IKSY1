<?php
    //euro2.php
    require_once("./includes/startTemplate.inc.php");

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
        if (($zielwaehrung=="Dollar") || ($zielwaehrung=="dollar"))
        {
            $umrechnungsBetrag=$kurs*$betrag;
        }
        else
        {
            if (($zielwaehrung=="euro") || ($zielwaehrung=="Euro"))
            {
                $umrechnungsBetrag=(1/$kurs)*$betrag;
            }
            else
            {
                $waehrungFehler=true;
                $smarty->assign('waehrungFehler', $waehrungFehler);
                $smarty->display('euro2.tpl');
                exit();
            }
        }
        $smarty->assign('zielwaehrung', $zielwaehrung);
        $smarty->assign('betrag', $betrag);
        $smarty->assign('umrechnungsBetrag', $umrechnungsBetrag);
    }
    $smarty->display('euro2.tpl');
?>