<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 6.2 Ternär</title>
</head>
<body>
<?php
    define("VOLLJAEHRIGKEITSALTER", 18);
    
    $i=2;
    $j=2;
    $k = ($i==$j ? $i : 6);
    
    echo("<p>k hat den Wert: $k</p>"); // k ist 2
    
    $alter=17;
    $status=($alter>=VOLLJAEHRIGKEITSALTER ? "volljährig" : "minderjährig");
    echo("<p>Mit $alter ist man $status</p>")
?>
</body>
</html>