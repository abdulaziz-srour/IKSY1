<?php
    function ermittlePreisProSeite($format) {
        switch($format) {
            case "a3":
                return PREIS_PRO_A3_SEITE;
            case "a4":
                return PREIS_PRO_A4_SEITE;
            default:
                return -1;
        }
    }
    
    function berechneKopierkosten($anzahlSeiten, $anzahlExemplare, $preisProSeite) {
        $anzahlKopien = $anzahlSeiten * $anzahlExemplare;
        $rabattGewaehrt = istRabattGewaehrt($anzahlSeiten, $anzahlExemplare);
        if($rabattGewaehrt) {
            return $preisProSeite * $anzahlKopien * (100 - MENGENRABATT_PROZENT) / 100;
        } else {
            return $preisProSeite * $anzahlKopien;
        }
    }
    
    function berechneBindungskosten($anzahlExemplare, $bindungGewuenscht) {
        return $bindungGewuenscht ? PREIS_BINDUNG_PRO_EXEMPLAR * $anzahlExemplare : 0;
    }
    
    function berechneMehrwertsteuer($nettobetrag) {
        return $nettobetrag * (MEHRWERTSTEUER_PROZENT/100);
    }
    
    function istRabattGewaehrt($anzahlSeiten, $anzahlExemplare) {
        return $anzahlSeiten * $anzahlExemplare >= MENGENRABATT_KOPIEN;
    }
?>