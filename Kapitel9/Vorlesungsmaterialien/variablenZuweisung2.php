<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<!-- variablenZuweisung2.php -->
<title> Variablen und ihr Geltungsbereich 1</title>
<?php
require_once("./includes/variablenZuweisung1.inc.php");
?>
</head>
<body>
<?php
function variablenGeltung()
{
$tester5="Hier ein Wert!";
echo "tester1: $tester1 <br>";
echo "tester2: $tester2 <br>";
echo "tester3: $tester3 <br>";
echo "tester4: $tester4 <br>";
}
$tester3=67;
$tester4="Auch ein Test!";
variablenGeltung();
echo "tester5: $tester5 <br>";
?>
</body>
</html>
