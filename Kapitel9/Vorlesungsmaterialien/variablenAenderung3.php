<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<!-- variablenAenderung2.php -->
<title>Variablen</title>
</head>
<body>
<?php
function variablenAenderung(&$a)
{
$a=2000;
}
$a=9;
variablenAenderung($a);
$b=21;
variablenAenderung($b);
echo("Der Wert von \$a: $a <br>");
echo("Der Wert von \$b: $b <br>");
?>
</body>
</html>
