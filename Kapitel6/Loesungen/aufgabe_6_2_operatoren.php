<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Aufgabe 6.2 Operatoren</title>
</head>
<body>
<?php
    $i=2;
    $j=3;
    $r=2;
    $s=3;
    $l=$i+$j; // 5
    echo("<p>l1: $l<br></p>");
    $l=$i-$j; // -1
    echo("<p>l2: $l<br></p>");
    $l=$j%$i; // 1 (Modulo-Bildung)
    echo("<p>l3: $l<br></p>");
    $l=$i*$j; // 6
    echo("<p>l4: $l<br></p>");
    $t=$s/$r; // 1.5 Division
    echo("<p>t: $t<br></p>");
    $l=$r+$i*$j; // 8
    echo("<p>l5: $l<br></p>");
    $l=($r+$i)*$j;  // 12
    echo("<p>l6: $l<br><br></p>");
    
    $l+=$i; // 14
    echo("<p>l7: $l<br></p>");
    $l-=$i; // 12
    echo("<p>l8: $l<br></p>");
    $l%=$i; // 0 (Modulo-Bildung)
    echo("<p>l9: $l<br></p>");
    $l*=$i; // 0
    echo("<p>l10: $l<br></p>");
    $t=$s;
    $t/=$r;// 1.5 Division
    echo("<p>t2: $t<br></p>");
    $l++; // 1
    echo("<p>l11: $l<br></p>");
    $l--;  // 0
    echo("<p>l12: $l<br></p>");
    $l.=1;  // 01
    echo("<p>l12: $l<br></p>");
?>
</body>
</html>