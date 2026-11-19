<?php
    //taschenrechner2.php
    require_once("./includes/startTemplate.inc.php");

    $PHP_SELF=$_SERVER['PHP_SELF'];
    $REQUEST_METHOD=$_SERVER['REQUEST_METHOD'];

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
        elseif ($operator=="-")
        {
            $ergebnis=$ersterOperand-$zweiterOperand;
        }
        elseif ($operator=="*")
        {
            $ergebnis=$ersterOperand*$zweiterOperand;
        }
        elseif ($operator=="/")
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
                $smarty->display('taschenrechner2.tpl');
                exit();
            }
        }
        else
        {
            $falscherOperator=true;
            $smarty->assign('falscherOperator', $falscherOperator);
            $smarty->display('taschenrechner2.tpl');
            exit();
        }
        $smarty->assign('ergebnis', $ergebnis);
    }//schliesst else zu if REQUEST_METHOD
    $smarty->display('taschenrechner2.tpl');
?>
</body>
</html>