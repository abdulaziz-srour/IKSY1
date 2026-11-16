<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<title>Darlehen mit Smarty</title>
</head>
<body>
	<table>
		<tr>
			<th>Immobilienpreis</th>
			<th>Eigenkapital</th>
			<th>Darlehensbetrag</th>
			<th>monatliche Belastung</th>
		</tr>
		<tr>
			<td>{$immobilienpreis|number_format:2:",":"."} €</td>
			<td>{$eigenkapital|number_format:2:",":"."} €</td>
			<td>{$darlehensbetrag|number_format:2:",":"."} €</td>
			<td>{$monatlicheBelastung|number_format:2:",":"."} €</td>
		</tr>
	</table>
	<p>Zinssatz: {ZINSSATZ|number_format:2:",":"."} %</p>
	<p>Tilgung: {TILGUNG|number_format:2:",":"."} %</p>
</body>
</html>