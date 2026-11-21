<?php
    function istZahlImBereich($wert, $minimum, $maximum) {
        return is_numeric($wert) && $wert >= $minimum && $wert <= $maximum;
    }
    
    function istZahlAbMinimum($wert, $minimum) {
        return is_numeric($wert) && $wert >= $minimum;
    }
    
    function istGueltigesFormat($format) {
        return $format == "a3" || $format == "a4";
    }
?>