<?php
require_once "php/konekcija.php"; 
$var=$_POST["prikaziPoruku"] ;
$idPor=$_POST["idPorukeSakriveno"];


if (isset($_POST["prikaziPoruku"])) 
{


	$stampa = fopen($var, "r");

	flock($stampa, LOCK_SH);
	if (!$stampa) 
	{
		echo "<p>Ne moze da se iscita korisnička poruka.</p>";
		exit;
	}
	while (!feof($stampa)) 
	{
		$poslali = fgets($stampa,999);
		echo $poslali . "<br>";

		$upitBrisanjePoruke = "DELETE  FROM poruke WHERE porukaID LIKE '".$idPor."'";

		$rezBrisi = $konekcija->query($upitBrisanjePoruke);

	}

	fclose($stampa);

}


	?>
