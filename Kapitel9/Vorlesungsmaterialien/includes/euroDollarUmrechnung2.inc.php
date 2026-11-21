<?php
    //euroDollarUmrechnung2.inc.php
    function euroDollarUmrechnung($zielwaehrung, $betrag, $kurs)
    {
        $zielwaehrung = trim(strtolower($zielwaehrung));
        if ($zielwaehrung=="dollar")
        {
            $ergebnis=$kurs*$betrag;
        }
        elseif ($zielwaehrung=="euro")
        {
            $ergebnis=(1/$kurs)*$betrag;
        }
        else
        {
            $ergebnis="Falsche Zielwährung";
        }
        return $ergebnis;
    }

?>