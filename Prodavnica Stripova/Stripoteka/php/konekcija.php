<?php 

	//konekcija sa bazom

$konekcija = new mysqli("localhost","root","","stripoteka");
			//izbaci gresku ako je neuspela konekcija
if ($konekcija->error) 
{

	die("Greška prilikom konekcije" . $konekcija->error);
}
?>