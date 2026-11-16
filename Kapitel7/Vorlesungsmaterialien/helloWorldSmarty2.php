<?php
    //helloWorldSmarty2.php
    require_once("./includes/startTemplate.inc.php");
    
    $ausgabe='Hello World';
    
    $smarty->assign('ausgabe', $ausgabe);
    $smarty->display('helloWorld.tpl');
?>