<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 6.3 Wahrheitstabellen</title>
</head>
<body>
	<table>
		<caption>And</caption>
		<tr>
			<th></th>
			<th>true</th>
			<th>false</th>
		</tr>
		<tr>
			<th>true</th>
			<td><?= true && true ? "true" : "false"?></td>
			<td><?= true && false ? "true" : "false"?></td>
		</tr>
		<tr>
			<th>false</th>
			<td><?= false && true ? "true" : "false"?></td>
			<td><?= false && false ? "true" : "false"?></td>
		</tr>
	</table>
    
    <table>
		<caption>Or</caption>
		<tr>
			<th></th>
			<th>true</th>
			<th>false</th>
		</tr>
		<tr>
			<th>true</th>
			<td><?= true || true ? "true" : "false"?></td>
			<td><?= true || false ? "true" : "false"?></td>
		</tr>
		<tr>
			<th>false</th>
			<td><?= false || true ? "true" : "false"?></td>
			<td><?= false || false ? "true" : "false"?></td>
		</tr>
	</table>
	
	<table>
		<caption>Not</caption>
		<tr>
			<th></th>
			<th>a</th>
			<th>not a</th>
		</tr>
		<tr>
			<th>true</th>
			<td><?= true ? "true" : "false"?></td>
			<td><?= !true ? "true" : "false"?></td>
		</tr>
		<tr>
			<th>false</th>
			<td><?= false ? "true" : "false"?></td>
			<td><?= !false ? "true" : "false"?></td>
		</tr>
	</table>
	
	<table>
		<caption>Vergleich</caption>
		<tr>
			<th>Ausdruck</th>
			<th>Ergebnis</th>
		</tr>
		<tr>
			<td>"1"== 1</td>
			<td><?= "1"== 1 ? "true" : "false" ?></td>
		</tr>
		<tr>
			<td>"1" === 1</td>
			<td><?= "1" === 1 ? "true" : "false" ?></td>
		</tr>
		<tr>
			<td>5 != 5</td>
			<td><?= 5 != 5 ? "true" : "false" ?></td>
		</tr>
		<tr>
			<td>3 <= 3</td>
			<td><?= 3 <= 3 ? "true" : "false" ?></td>
		</tr>
		<tr>
			<td>true || false && false</td>
			<td><?= true || false && false ? "true" : "false" ?></td>
		</tr>
	</table>
</body>
</html>