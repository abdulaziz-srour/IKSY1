<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 6.4 Fahrradverleih</title>
</head>
<body>
	<?php
        define("FAHRRAD_KOSTEN_PRO_TAG", 12);
        define("MINDESTMIETDAUER_FUER_RABATT", 3);
        define("RABATT_PROZENT", 10);
        define("REINIGUNGSPAUSCHALE_PRO_FAHRRAD", 5);
        
        $mietdauerInTage = $_POST['mietdauerInTage'];
        $anzahlFahrraeder = $_POST['anzahlFahrraeder'];
        
        $mietpreis = $mietdauerInTage * $anzahlFahrraeder * FAHRRAD_KOSTEN_PRO_TAG;
        $rabatt = ($mietdauerInTage >= MINDESTMIETDAUER_FUER_RABATT ? $mietpreis * (RABATT_PROZENT/100) : 0);
        $gesamteReinigungspauschale = REINIGUNGSPAUSCHALE_PRO_FAHRRAD * $anzahlFahrraeder;
        $gesamtkosten = $mietpreis - $rabatt + $gesamteReinigungspauschale;
    ?>
    
    <table>
    	<tr>
    		<th>Mietpreis</th>
    		<th>Rabatt</th>
    		<th>Reinigung</th>
    		<th>Gesamtpreis</th>
    	</tr>
    	<tr>
    		<td><?=$mietpreis?></td>
    		<td><?=$rabatt?></td>
    		<td><?=$gesamteReinigungspauschale?></td>
    		<td><?=$gesamtkosten?></td>
    	</tr>
    </table>
</body>
</html>