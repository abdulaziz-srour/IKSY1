<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<title>Darlehen mit Zinsstaffel</title>
<link rel="stylesheet" href="formular.css" type="text/css">
</head>
<body>
	{if isset($PHP_SELF)}
		<form method="POST" action="{$PHP_SELF}">
			<label for="i_immobilienpreis">Immobilienpreis:</label>
			<input type="number" min="{$minImmobilienpreis}" step="0.01" id="i_immobilienpreis" name="immobilienpreis" required>
			
			<label for="i_eigenkapital">Eigenkapital:</label>
			<input type="number" min="{$minEigenkapital}" step="0.01" id="i_eigenkapital" name="eigenkapital" required>
			
			<button type="submit">Berechnen</button>
		</form>
	{else}
		{if isset($fehler)}
			<p>Unzulässige Eingabe.</p>
		{elseif isset($eigenkapitalquoteZuGering)}
			<p>Ihre Eigenkapitalquote von {$eigenkapitalquote|number_format:2:",":"."} % liegt unter {$eigenkapitalMindestquote} %.
			Die Bank finanziert Immobilienerwerb mit einer so geringen Eigenkapitalquote nicht.</p>
		{else}
			<table>
				<tr>
					<th>Immobilienpreis</th>
					<th>Eigenkapital</th>
					<th>Eigenkapitalquote</th>
					<th>Darlehensbetrag</th>
					<th>monatliche Belastung</th>
				</tr>
				<tr>
					<td>{$immobilienpreis|number_format:2:",":"."} €</td>
					<td>{$eigenkapital|number_format:2:",":"."} €</td>
					<td>{$eigenkapitalquote|number_format:2:",":"."} %</td>
					<td>{$darlehensbetrag|number_format:2:",":"."} €</td>
					<td>{$monatlicheBelastung|number_format:2:",":"."} €</td>
				</tr>
			</table>
			<p>Zinssatz: {$zinssatzProzent|number_format:2:",":"."} %</p>
			<p>Tilgung: {$tilgungProzent|number_format:2:",":"."} %</p>
		{/if}
		<a href="loesung.php">Neue Berechnung</a>
	{/if}
</body>
</html>
