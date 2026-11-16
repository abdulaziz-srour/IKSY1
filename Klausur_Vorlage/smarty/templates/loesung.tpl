<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Klausur-Vorlage</title>
	<link rel="stylesheet" type="text/css" href="css/formular.css">
</head>
<body>
	<h2>{$ueberschrift}</h2>
	
	<form method="POST" action="loesung.php">
		<label for="i_zahl">Zahl:</label>
		<input id="i_zahl" type="number" name="zahl" min="0" max="{$maxGrenze}" required>
		<button type="submit">Abschicken</button>
	</form>
</body>
</html>