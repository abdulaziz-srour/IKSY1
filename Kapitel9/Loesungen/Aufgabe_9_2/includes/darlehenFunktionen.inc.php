<?php
    function berechneEigenkapitalquote($eigenkapital, $immobilienpreis) {
        return $eigenkapital / $immobilienpreis * 100;
    }
    
    function berechneDarlehensbetrag($immobilienpreis, $eigenkapital) {
        return $immobilienpreis - $eigenkapital;
    }
    
    function berechneMonatlicheBelastung($darlehensbetrag, $zinssatzProzent, $tilgungProzent) {
        return $darlehensbetrag * ($zinssatzProzent + $tilgungProzent) / 100 / MONATE_PRO_JAHR;
    }
?>