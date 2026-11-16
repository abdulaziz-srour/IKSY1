<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 7.2 Copyshop</title>
</head>
<body>
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
            	<td>{$gesamtKopierkosten|number_format:2:",":"."} €</td>
            	<td>{$gesamtBindung|number_format:2:",":"."} €</td>
            	<td>{$nettopreis|number_format:2:",":"."} €</td>
            	<td>{$mehrwertsteuer|number_format:2:",":"."} €</td>
            	<td>{$bruttopreis|number_format:2:",":"."} €</td>
            </tr>
        </tbody>
	</table>
	<p>Preise: <br>{$preisProSeite|number_format:2:",":"."} € pro Seite,<br>
	{$preisBindungProExemplar|number_format:2:",":"."} € Bindung pro Exemplar,<br>
	{$mehrwertsteuerProzent|number_format:2:",":"."} % MwSt</p>
	<a href="index.php">Neue Berechnung</a>
</body>
</html>