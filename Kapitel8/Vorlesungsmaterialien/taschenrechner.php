<?php
    //taschenrechner.php
    require_once("./includes/startTemplate.inc.php");
    $PHP_SELF=$_SERVER['PHP_SELF'];
    $REQUEST_METHOD=$_SERVER['REQUEST_METHOD'];
    // Wir pruefen zuerst ob die Anfrage ueber get oder post erfolgte
    if ($REQUEST_METHOD!="POST")
    {
        $smarty->assign('PHP_SELF', $PHP_SELF);
    }
    else
    {
        $ersterOperand=$_POST['ersterOperand'];
        $zweiterOperand=$_POST['zweiterOperand'];
        $operator=$_POST['operator'];
        if ($operator=="+")
        {
            $ergebnis=$ersterOperand+$zweiterOperand;
        }
        else
        {
            // war nicht +, vielleicht -
            if ($operator=="-")
            {
                $ergebnis=$ersterOperand-$zweiterOperand;
            }
            else
            {
                // auch nicht - vielleicht *
                if ($operator=="*")
                {
                    $ergebnis=$ersterOperand*$zweiterOperand;
                }
                else
                {
                    // auch nicht * vielleicht /
                    if ($operator=="/")
                    {
                        //Teilen durch 0 verhindern
                        if ($zweiterOperand!=0)
                        {
                            $ergebnis=$ersterOperand/$zweiterOperand;
                        }
                        else
                        {
                            $teilenDurchNull=true;
                            $smarty->assign('teilenDurchNull', $teilenDurchNull);
                            $smarty->display('taschenrechner.tpl');
                            exit();
                        }
                    }
                    else
                    {
                        // auch nicht /, Fehleingabe
                        $falscherOperator=true;
                        $smarty->assign('falscherOperator', $falscherOperator);
                        $smarty->display('taschenrechner.tpl');
                        exit();
                    } //schliesst else zu if /
                }//schliesst else zu if *
            }//schliesst else zu if -
        }//schliesst else zu if +
        $smarty->assign('ergebnis', $ergebnis);
    }//schliesst else zu if REQUEST_METHOD
    $smarty->display('taschenrechner.tpl');
?>
