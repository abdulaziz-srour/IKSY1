<?php
//addition4.inc.php
    $bisZu=$_POST['bisZu'];
    $summe=0;
    for ($i=1; $i<=$bisZu; $i++)
    {
        $summe=$summe+$i;
    }
    echo("Die Summe der ersten $bisZu natürlichen
					Zahlen ist: $summe");
?>