<?php
    //euro1.php
    require_once("./includes/startTemplate.inc.php");
    
    $kurs=$_POST['kurs'];
    $eurobetrag=$_POST['eurobetrag'];
    
    $dollarbetrag=$kurs*$eurobetrag;
    
    $smarty->assign('kurs', $kurs);
    $smarty->assign('eurobetrag', $eurobetrag);
    $smarty->assign('dollarbetrag', $dollarbetrag);
    $smarty->display('euro1.tpl');
?>