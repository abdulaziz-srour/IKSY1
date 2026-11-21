<?php
#funktionUebergabeparameterNamen.php
#Nur die Reihenfolge innerhalb der Klammern ist wichtig.
function namenSindSchallUndRauch($ersterParameter, $zweiterParameter, $dritterParameter)
{
    $ergebnis1=$zweiterParameter/$ersterParameter;
    $ergebnis2=$dritterParameter/$ersterParameter;
    $resultat=$ergebnis1+$ergebnis2;
    return $resultat;
}

# Erster Aufruf der Funktion.
$ersterWert=10;
$zweiterWert=20;
$dritterWert=30;
$ergebnis=namenSindSchallUndRauch($ersterWert, $zweiterWert, $dritterWert);
echo "1-> $ergebnis<br>";

#und jetzt ändern wir die Namen der Variablen
$haus=10;
$boot=20;
$pferd=30;
$ergebnis=namenSindSchallUndRauch($haus, $boot, $pferd);
echo "2-> $ergebnis<br>";

##################################################################
# und jetzt vertauschen wir die Reihenfolge in den runden Klammern
# statt ($haus, $boot, $pferd) -->>> ($pferd, $boot, $haus)
$ergebnis=namenSindSchallUndRauch($pferd, $boot, $haus);
echo "3-> $ergebnis<br>";
?>