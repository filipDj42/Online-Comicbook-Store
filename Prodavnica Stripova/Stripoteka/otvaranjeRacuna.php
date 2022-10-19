<?php

$var=$_POST["prikaziRacun"] ;


if (isset($_POST["prikaziRacun"])) 
{


	$stampa = fopen($var, "r");

	flock($stampa, LOCK_SH);
	if (!$stampa) 
	{
		echo "<p>Ne moze da se iscita fajl sa porudzbinama</p>";
		exit;
	}
	while (!feof($stampa)) 
	{
		$narucili = fgets($stampa,999);
		echo $narucili . "<br>";
	}

	fclose($stampa);
}

?>
