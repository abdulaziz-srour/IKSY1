<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 9.1 - Netto-Brutto-Funktionen</title>
	<link rel="stylesheet" href="formular.css" type="text/css">
</head>
<body>
	<table>
		<caption>Aufgabe 9.1 - Netto-Brutto-Funktionen</caption>
		<thead>
			<tr>
				<th>Netto vorher</th>
				<th>Funktion 1</th>
				<th>Funktion 2</th>
				<th>Funktion 3</th>
				<th>Funktion 4</th>
				<th>Funktion 4 (Vertauscht: Ergebnis)</th>
				<th>Funktion 4 (Vertauscht: Netto nachher)</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{$nettoVorher|number_format:2:",":"."} €</td>
				<td>{$ersterWert|number_format:2:",":"."} €</td>
				<td>{$zweiterWert|number_format:2:",":"."} €</td>
				<td>{$dritterWert|number_format:2:",":"."} €</td>
				<td>{$vierterWert|number_format:2:",":"."} €</td>
				<td>{$vertauschtesBruttoErgebnis|number_format:2:",":"."} €</td>
				<td>{$vertauschtesNettoErgebnis|number_format:2:",":"."} €</td>
			</tr>
		</tbody>
	</table>
</body>
</html>
