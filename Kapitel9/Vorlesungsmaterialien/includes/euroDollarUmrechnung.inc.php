<?php
    //euroDollarUmrechnung.inc.php
    function euroDollarUmrechnung($zielwaehrung, $betrag, $kurs)
    {
        if (($zielwaehrung=="Dollar") || ($zielwaehrung=="dollar"))
        {
            $ergebnis=$kurs*$betrag;
        }
        elseif (($zielwaehrung=="Euro") || ($zielwaehrung=="euro"))
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