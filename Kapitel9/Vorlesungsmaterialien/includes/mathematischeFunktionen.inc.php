<?php
	//mathematischeFunktionen.inc.php
	function berechneMaximum($a, $b)
	{
		if ($a >= $b)
		{
			$max = $a;
		}
		else
		{
			$max = $b;
		}
		return $max;
	}

?>