<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 4.6</title>
</head>
<body>
	<?php
        $preisProSeite = 0.05;
        $preisBindungProExemplar = 2.5;
        $anzahlSeiten = $_POST["anzahlSeiten"];
        $anzahlExemplare = $_POST["anzahlExemplare"];
        
        $gesamtKopierkosten = $preisProSeite * $anzahlSeiten * $anzahlExemplare;
        $gesamtBindung = $preisBindungProExemplar * $anzahlExemplare;
        $gesamtpreis = $gesamtKopierkosten + $gesamtBindung;
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
            	<?php echo ("<td>$gesamtKopierkosten €</td>");?>
            	<?php echo ("<td>$gesamtBindung €</td>");?>
            	<?php echo ("<td>$gesamtpreis €</td>");?>
            </tr>
        </tbody>
	</table>
</body>
</html>