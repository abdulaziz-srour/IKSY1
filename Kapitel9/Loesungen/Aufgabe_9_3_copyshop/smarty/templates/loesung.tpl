<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 9.3 Copyshop</title>
	<link rel="stylesheet" href="formular.css" type="text/css">
</head>
<body>
	{if isset($PHP_SELF)}
		<form method="POST" action="{$PHP_SELF}">
			<label for="i_anzahl_seiten">Anzahl Seiten:</label>
			<input id="i_anzahl_seiten" name="anzahlSeiten" type="number" min="{$minAnzahl}" max="{$maxAnzahlSeiten}" required>
			
			<label for="i_anzahl_exemplare">Anzahl Exemplare:</label>
			<input id="i_anzahl_exemplare" name="anzahlExemplare" type="number" min="{$minAnzahl}" max="{$maxAnzahlExemplare}" required>
			
			<label for="i_papierformat">Papierformat:</label>
			<select name="papierformat" id="i_papierformat" required>
			    <option value="a3">A3</option>
			    <option value="a4">A4</option>
			</select>
			
			<label for="i_istBindung">Bindung gewünscht?</label><input type="checkbox" name="istBindung" id="i_istBindung" value="ja">
			
			<button type="submit">Berechnen</button>
		</form>
	{else}
		{if isset($fehler)}
			<p>Unzulässige Eingabe.</p>
		{else}
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
			{if $rabattGewaehrt}
				<p>{$mengenrabattProzent} % Mengenrabatt auf die Kopierkosten gewährt (ab {$mengenrabattKopien|number_format:0:",":"."} Kopien).</p>
			{else}
				<p>Kein Mengenrabatt (erst ab {$mengenrabattKopien|number_format:0:",":"."} Kopien).</p>
			{/if}
		{/if}
		<a href="loesung.php">Neue Berechnung</a>
	{/if}
</body>
</html>