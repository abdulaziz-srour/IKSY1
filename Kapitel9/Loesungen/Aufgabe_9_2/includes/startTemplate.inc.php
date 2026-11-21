<?php
    //startTemplate.inc.php
    $ROOT_DIR='/var/www/html/iks/Kapitel9/Loesungen/Aufgabe_9_2';
    require_once("$ROOT_DIR/vendor/autoload.php");
    
    $smarty=new Smarty\Smarty();
    $smarty->setTemplateDir("$ROOT_DIR/smarty/templates/");
    $smarty->setCompileDir("$ROOT_DIR/smarty/templates_c/");
    $smarty->setConfigDir("$ROOT_DIR/smarty/configs/");
    $smarty->setCacheDir("$ROOT_DIR/smarty/cache/");
?>
