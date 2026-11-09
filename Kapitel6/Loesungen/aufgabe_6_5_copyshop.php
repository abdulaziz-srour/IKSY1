<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 6.5 Copyshop</title>
</head>
<body>
	<?php
        require_once ("./includes/copyshopKonstanten.inc.php");
	   
        
        $anzahlSeiten = $_POST["anzahlSeiten"];
        $anzahlExemplare = $_POST["anzahlExemplare"];
        
        $gesamtKopierkosten = PREIS_PRO_SEITE * $anzahlSeiten * $anzahlExemplare;
        $gesamtBindung = PREIS_BINDUNG_PRO_EXEMPLAR * $anzahlExemplare;
        $nettopreis = $gesamtKopierkosten + $gesamtBindung;
        $mehrwertsteuer = $nettopreis * (MEHRWERTSTEUER_PROZENT/100);
        $bruttopreis = $nettopreis + $mehrwertsteuer;
    ?>
	<table>
		<caption>Preise</caption>
		<thead>
			<tr>
				<th>Kopierkosten</th>
    			<th>Bindung</th>
    			<th>Nettopreis</th>
    			<th>Mehrwertsteuer</th>
    			<th>Bruttopreis</th>
			</tr>
		</thead>
		<tbody>
			<tr>
            	<td><?=number_format($gesamtKopierkosten, 2, ",", ".")?> €</td>
            	<td><?=number_format($gesamtBindung, 2, ",", ".")?> €</td>
            	<td><?=number_format($nettopreis, 2, ",", ".")?> €</td>
            	<td><?=number_format($mehrwertsteuer, 2, ",", ".")?> €</td>
            	<td><?=number_format($bruttopreis, 2, ",", ".")?> €</td>
            </tr>
        </tbody>
	</table>
	<?php 
	echo("<p>Preise: " . number_format(PREIS_PRO_SEITE, 2, ",", ".") . " € pro Seite, "
	    . number_format(PREIS_BINDUNG_PRO_EXEMPLAR, 2, ",", ".") .  " € Bindung pro Exemplar, " 
	    . number_format(MEHRWERTSTEUER_PROZENT, 2, ",", ".") . " % MwSt.");
	?>
	<?php require_once("./includes/fusszeile.inc.php");?>
</body>
</html>