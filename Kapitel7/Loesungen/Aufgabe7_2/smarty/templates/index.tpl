<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="formular.css" type="text/css" >
	<title>Aufgabe 7.2 Copyshop</title>
</head>
<body>
	<form method="POST" action="loesung.php">
		<label for="i_anzahl_seiten">Anzahl Seiten:</label>
		<input id="i_anzahl_seiten" name="anzahlSeiten" type="number" min="{$minAnzahl}" max="{$maxAnzahlSeiten}" required>
		
		<label for="i_anzahl_exemplare">Anzahl Exemplare:</label>
		<input id="i_anzahl_exemplare" name="anzahlExemplare" type="number" min="{$minAnzahl}" max="{$maxAnzahlExemplare}" required>
		
		<button type="submit">Berechnen</button>
	</form>
</body>
</html>