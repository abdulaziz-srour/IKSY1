<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<!-- aufgabe_6_1_copyshop.php, Tabellenausgabe mit Kostenwerten -->
	<title>Aufgabe 6.1 Copyshop</title>
</head>
<body>
	<?php
	   require_once("./includes/copyshopPreise.inc.php");
	   require_once("./includes/copyshopBerechnung.inc.php");
    ?>
	<table>
		<caption>Preise</caption>
		<thead>
			<tr>
				<th>Kopierkosten</th>
    			<th>Bindung</th>
    			<th>Gesamtpreis</th>
			</tr>
		</thead>
		<tbody>
			<tr>
            	<td><?=$gesamtKopierkosten?> €</td>
            	<td><?=$gesamtBindung?> €</td>
            	<td><?=$gesamtpreis?> €</td>
            </tr>
        </tbody>
	</table>
	<?php require_once("./includes/fusszeile.inc.php");?>
</body>
</html>