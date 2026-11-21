<?php
    function berechneBrutto($netto) {
        return $netto * (100 + MEHRWERTSTEUERSATZ) / 100;
    }
    
    
    function berechneBruttoMitAnderemParameter($nettobetrag) {
        return $nettobetrag * (100 + MEHRWERTSTEUERSATZ) / 100;
    }
    
    
    function berechneBruttoOhneReferenz($netto, $brutto) {
        $brutto = $netto * (100 + MEHRWERTSTEUERSATZ) / 100;
    }
    
    function berechneBruttoMitReferenz($netto, &$brutto) {
        $brutto = $netto * (100 + MEHRWERTSTEUERSATZ) / 100;
    }
?>