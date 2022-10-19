<?php //ovaj deo sam dodao da bi mi kupio podatke sa html forme apoteke
$telefon=$_POST["telefon"];
$adresaG=$_POST["adresaG"];
$adresaU=$_POST["adresaU"];
$korisnik=$_POST["korisnik"];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="author" content="Filip Djokovic">
	<meta name="description" content="Stripoteka je sajt namenjen za sve ljubitelje Dilan Dog stripa">
	<meta name="keywords" content="Stripoteka | Dilan | Dylan | Dog | strip | comicbook | shop | prodavnica | online | prodaja|">

	<title>Stripoteka</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/all.min.css" rel="stylesheet">
	<link href="css/mojIzgled.css" rel="stylesheet">
	<link id="idStila" href="css/mojstilLight.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<?php 
		
		include "php/header.php";
		include "php/navBar.php";
		require_once "php/konekcija.php";

		$upitSVI="SELECT * FROM korpe WHERE korisnikMail LIKE('".$korisnik."') ORDER BY idArtikla";
		$rezultatSVI = $konekcija ->query($upitSVI);
		$red= $rezultatSVI ->fetch_assoc();

		if (!$red) 
		{
			echo '<div class="col-md-12">

			<div class="jumbotron"><br><br>
			<h2>Poštovani,niste ništa poručili!</h2><br><br>
			<div class="col-md-3">
			<a class="btn btn-danger btn-lg btn-block" href="prodavnica.php" role="button">&larr; Nazad na prodavnicu</a>
			</div>
			</div>
			</div>';
		}
		else
		{
			$adresa=$adresaU . " , " . $adresaG;
						echo '<div class="col-md-12">
			<div class="panel panel-default">
			<div class="panel-heading"><h3><center>Uspešna porudžbina!</center></h3></div>
			<div class="panel-body">';
			$UKUPNO=500;
			echo '<table id="porudzbinaRACUN" class="table table-bordered" style="text-align: center;"><thead><tr>				
			<th style="text-align: center;">Ime</th>
			<th style="text-align: center;">Cena</th> 
			<th style="text-align: center;">Kolicina</th>
			</tr></thead>';
			do
			{

				echo '<tbody align="center">'. "<tr>" .
				"<td>" . $red["imeArtikla"] . "</td>".
				"<td>" . $red["cenaArtikla"] . "</td>" . 
				"<td>1</td>" ."</tr>";

				$UKUPNO+=$red["cenaArtikla"];



			}
			while($red = $rezultatSVI ->fetch_assoc());

			$upitKorisnika="SELECT * FROM users WHERE email LIKE('".$korisnik."')";
			$rezultatUser = $konekcija ->query($upitKorisnika);
			$rezKor= $rezultatUser ->fetch_assoc();

			echo '<tr><td>Poštarina</td><td colspan="1" align="center">500</td></tr></tbody></table>';

			echo '<table id="ukupnoRACUN" class="table">
			<tr>
			<td colspan="2" align="right"><h3><strong>Total</strong></h3></td>
			<td colspan="1" align="right"><h2>'.$UKUPNO.'<small style="color:black;">.00</small> dinara</h2></td>
			</tr>	
			</table>';

			$datum = date("d-m-Y");

			echo '

			<table id="podaciRACUN" class="table table-bordered">
			<tr><th colspan="2"><h3>Podaci za dostavu</h3></th></tr>
			<tr>				
			<td>Datum porudžbine</td><td>'.$datum .'</td>
			</tr>
			<tr>				
			<td>Ime poručioca</td><td>'.$rezKor["ime"].'</td>
			</tr>
			<tr>				
			<td>Prezime poručioca</td><td>'.$rezKor["prezime"].'</td>
			</tr>

			<tr>				
			<td>Adresa za dostavu</td><td>'.$adresa.'</td>
			</tr>

			<tr>				
			<td>Telefon poručioca</td><td>'.$telefon.'</td>
			</tr>
			</table></div></div>
			';



			//UPIS U FAJL
			$upitSTAMPA="SELECT * FROM korpe WHERE korisnikMail LIKE('".$korisnik."') ORDER BY idArtikla";
			$rezultatSTAMPA = $konekcija ->query($upitSTAMPA);
			$rezSTAMPA= $rezultatSTAMPA ->fetch_assoc();

			if (!$rezSTAMPA) 
			{
				echo 'greska';
			}
			else
			{
				$izlazArtikli="";
				do
				{
					$izlazArtikli =$izlazArtikli. "\nIme artikla: ".$rezSTAMPA["imeArtikla"] . "\nCena artikla: " . $rezSTAMPA["cenaArtikla"] .",00 dinara\n";
				}
				while($rezSTAMPA = $rezultatSTAMPA ->fetch_assoc());

				$i=0;

				do
				{
					$i++;
				}
				while(file_exists("Racuni/".$i.".txt")==true);

				$IZLAZ="ARTIKLI:\n". $izlazArtikli ."\n\nUKUPNO ZA PLACANJE: ". $UKUPNO .",00 dinara". "\n\nRoba porucena dana: ". $datum . "\n\n" . "PODACI PORUCIOCA: " . $rezKor["ime"] ." , " . $rezKor["prezime"] . "\n\n" . "ADRESA ZA DOSTAVU: " . $adresa . "\n\n" . "TELEFON: " . $telefon. "\n"  ;

				$stampa = fopen("racuni/".$i.".txt", "w");

				flock($stampa, LOCK_EX);
				fwrite($stampa, $IZLAZ, strlen($IZLAZ));
				flock($stampa, LOCK_UN);
				fclose($stampa);
				


				//UPIS FAJLOVA U BAZU RACUNI
				$putanjaRacuna="racuni/".$i.".txt";
				$datumRacuna = date('Y-m-d H:i:s');

				$upitINSERTracun = "INSERT INTO racuni (datumRacuna, lokacijaRacuna, korisnikMail) VALUES ('" .$datumRacuna . "','" . $putanjaRacuna . "','". $korisnik ."')" ;

				if (!$rezINSracuna = $konekcija ->query($upitINSERTracun)) 
				{

					echo "Greska!";
				}
				else
				{
					//BRISANJE IZ KORPE
					$upitDELkorpa = "DELETE  FROM korpe WHERE korisnikMail LIKE '".$korisnik."'";
					$rezDELkorpa = $konekcija->query($upitDELkorpa);



				}
			}



			echo '<div class="col-md-12">
			<div class="col-md-3">
			<p><a class="btn btn-danger btn-lg btn-block" href="prodavnica.php" role="button">&larr;  Nazad na prodavnicu</a></p>
			</div>';
		}




		echo '<img style="justify-content: center; width: 100%" id="donjaSlika" src="img/Sajt/dilanDonjaStrana.png" alt="Dogoteka| Dilan Dog Logo">';
		include "php/footer.php";
		?>


	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/citati.js" ></script>
	<script src="js/promenaModa.js"></script>
</body>
</html>