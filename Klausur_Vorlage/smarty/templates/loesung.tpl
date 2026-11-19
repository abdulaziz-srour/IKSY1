<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Klausur-Vorlage</title>
	<link rel="stylesheet" type="text/css" href="css/formular.css">
</head>
<body>
	<h2>{$ueberschrift}</h2>
	{if isset($PHP_SELF)}
		<form method="POST" action="{$PHP_SELF}">
			<label for="i_zahl">Zahl:</label>
			<input id="i_zahl" type="number" name="zahl" min="{$minGrenze}" max="{$maxGrenze}" required>
			<button type="submit">Abschicken</button>
		</form>
	{else}
		{if isset($fehler)}
			<p>Unzulässige Eingabe.</p>
		{else}
			<p>Ergebnis: {$ergebnis}</p>
		{/if}
		<a href="loesung.php">Neue Berechnung</a>
	{/if}
</body>
</html>
